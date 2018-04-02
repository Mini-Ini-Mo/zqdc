<?php
namespace common\widgets\yii2_wechat\src;
use common\widgets\yii2_wechat\src\Base;
/**
 * 统一下单类
 * User: cuik
 * Date: 2018/3/16
 * Time: 11:32
 */
class UnifiedOrder extends Base
{
    const UNIFIEDORDERURL = 'https://api.mch.weixin.qq.com/pay/unifiedorder';

    /*
     * 'appid','mch_id','nonce_str','body','sign',
     * 'out_trade_no','total_fee','
     * spbill_create_ip'=>'123.12.12.123',
     * 'notify_url','trade_type' => 'JSAPI',//JSAPI 公众号支付 NATIVE 扫码支付APP APP支付
     */
    public $data = array();

    public function __construct()
    {
        $this->setAppID();
        $this->setMchID();
        $this->setNonceStr();
        $this->setTradeType();
    }

    //构建json参数
    /*
     * "appId":"wx2421b1c4370ec43b",//公众号名称，由商户传入
     * "timeStamp":"1395712654",//时间戳，自1970年以来的秒数
     * "nonceStr":"e61463f8efa94090b1f366cccfbbb444", //随机串
     * "package":"prepay_id=u802345jgfjsdfgsdg888",
     * "signType":"MD5",//微信签名方式：
     * "paySign":"70EA570631E4BB79628FBCA90534C63FF7FADD89" //微信签名
     */
    public function getJsonParams()
    {
        if($this->getPrepayID())
        {
            $arr = array(
                'appId' => self::APPID,
                'nonceStr' => md5(time()),
            	'timeStamp' => '"'.time().'"',
                'pageage' => 'prepay_id='.$this->getPrepayID(),
                'signType' => 'MD5'
            );
			
            $arr['paySign'] = $this->getSign($arr);
            return json_encode($arr);
        }
    }

    //获取预付款ID
    public function getPrepayID()
    {
        if($order = $this->order())
        {
            if($order['result_code'] == 'SUCCESS')
            {
                return $order['prepay_id'];
            }
        }
        return;
    }

    /*
     * 统一下单
     */
    public function order()
    {
        if(!$this->chekData())
        {
            return;
        }

        $this->data['sign'] = $this->getSign($this->data);

        $xml = $this->arrayToXml($this->data);

        $res = $this->postCurl(self::UNIFIEDORDERURL, $xml);

        $arr = $this->xmlToArray($res);

        if($arr['return_code'] != 'SUCCESS')
        {
            $this->setLogs('unifiedorder.txt',json_encode($arr).$arr['return_msg']);
            return;
        }
        if($arr['result_code'] != 'SUCCESS')
        {
        	$this->setLogs('unifiedorder.txt', json_encode($arr).$arr['err_code_des']);
        	return;
        }
        if(!$this->chekSign($arr))
        {
            $this->setLogs('unifiedorder.txt','校验签名错误');
            return;
        }
        return $arr;
    }

    //检查数组
    public function chekData()
    {
        $file = 'unifiedorder.txt';
        if(!$this->isAppIDSet())
        {
            $this->setLogs($file,'请填写APPID');
            return;
        }else if(!$this->isMchIDSet())
        {
            $this->setLogs($file,'请填写MCHID');
            return;
        }else if(!$this->isBodySet())
        {
            $this->setLogs($file,'请填写BODY');
            return;
        }else if(!$this->isNotifyUrlSet())
        {
            $this->setLogs($file,'请填写NOTIFYURL');
            return;
        }else if(!$this->isOutTradeNoSet())
        {
            $this->setLogs($file,'请填写TRADENO');
            return;
        }else if(!$this->isTotalFeeSet())
        {
            $this->setLogs($file,'请填写TOTALFEE');
            return;
        }

        if($this->data['trade_type'] == 'JSAPI')
        {
            if(!$this->isOpenIDSet())
            {
                $this->setLogs($file,'请填写OPENID');
                return;
            }
        }

        return true;
    }

    public function setOpenID($value)
    {
        $this->data['openid'] = $value;
    }

    public function isOpenIDSet()
    {
        return array_key_exists('openid',$this->data);
    }

    public function setTradeType($value = 'JSAPI')
    {
        $this->data['trade_type'] = $value;
    }

    //检测数组中是否设置了TRADE_TYPE
    public function isTradeTypeSet()
    {
        return array_key_exists('trade_type',$this->data);
    }

    public function setNotifyUrl($value)
    {
        $this->data['notify_url'] = $value;
    }

    //检测数组中是否设置了NOTIFY_URL
    public function isNotifyUrlSet()
    {
        return array_key_exists('notify_url',$this->data);
    }

    public function setTotalFee($value)
    {
        $this->data['total_fee'] = $value;
    }

    //检测数组中是否设置了TOTAL_FEE
    public function isTotalFeeSet()
    {
        return array_key_exists('total_fee',$this->data);
    }

    public function setOutTradeNo($value)
    {
        $this->data['out_trade_no'] = $value;
    }

    //检测数组中是否设置了OUT_TRADE_NO
    public function isOutTradeNoSet()
    {
        return array_key_exists('out_trade_no',$this->data);
    }

    public function setBody($value)
    {
        $this->data['body'] = $value;
    }

    //检测数组中是否设置了BODY
    public function isBodySet()
    {
        return array_key_exists('body',$this->data);
    }

    private function setNonceStr()
    {
        $this->data['nonce_str'] = md5(time());
    }

    private function setMchID()
    {
        $this->data['mch_id'] = self::MCHID;
    }

    //检测数组中是否设置了MCH_ID
    public function isMchIDSet()
    {
        return array_key_exists('mch_id',$this->data);
    }

    private function setAppID()
    {
        $this->data['appid'] = self::APPID;
    }

    public function isAppIDSet()
    {
        return array_key_exists('appid',$this->data);
    }
}