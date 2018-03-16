<?php
namespace common\components;

use yii\base\Action;
use common\widgets\SMS\SendSMS;
use common\models\Smslog;
use yii\web\Response;


class Sms extends Action
{
    
    public $mobile;
    public $sms_type;
    public $expires_in;
    
    public function init()
    {
        
    }
    
    public function run()
    {
        
        \Yii::$app->response->format=Response::FORMAT_JSON;
        /* $request = Yii::$app->getRequest();
        
        if (!$request->getIsPost()) {
            return ['code'=>403,'reason'=>'请求有误'];
        }
        
        $mobile = $request->post('mobile'); */
        
        $mobile = $this->mobile;
        $sms_type = $this->sms_type;
        $expires_in = $this->expires_in;
        
        //验证一下手机号码
        $mobre='/^(133|153|180|181|189|130|131|132|145|155|156|185|186|134|135|136|137|138|139|147|150|151|152|157|158|159|170|173|177|182|183|184|187|188)\d{8}$/';
        
        if (!empty($mobile) && !preg_match($mobre,$mobile)) {
            return ['code'=>402,'reason'=>'请输入正确的手机号码'];
        }
        
        $record = (new \yii\db\Query())
        ->select(['id', 'sendtime'])
        ->from('zq_smslog')
        ->where(['mobile' => $mobile,'sms_type'=>$sms_type,'isuse'=>0])
        ->orderBy('id desc')
        ->one();
        
        if (!empty($record)) {  //已经发送了
            if(time() <= ($record['sendtime']+$expires_in) ) {//发送的验证码还有效
                return ['code'=>402,'reason'=>'当前验证码有效。'];
            }
        }
        
        $code = mt_rand(100000, 999999);
        $content = '您的短信验证码：' .$code. '，30分钟内有效';
        
        $sms = new SendSMS();
        $res = $sms->send($mobile, $content);
        
        if ($res) {
            $smslog = new Smslog();
            $smslog->mobile = $mobile;
            $smslog->code = "$code";
            $smslog->ipaddr = \Yii::$app->request->userIP;
            $smslog->sms_type = $sms_type;
            $smslog->sendtime = time();
            $res = $smslog->save();
            if(!$res) {
                Yii::error($mobile."的验证码".$code."未记录到数据库");
            }
            return ['code'=>200,'reason'=>'验证码已经发送'];
        } else {
            return ['code'=>400,'reason'=>'验证码已经失败'];
        }  
    } 
}