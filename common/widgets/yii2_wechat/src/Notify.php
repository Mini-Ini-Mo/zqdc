<?php
namespace common\widgets\yii2_wechat\src;
/**
 * Created by PhpStorm.
 * User: cuik
 * Date: 2018/3/30
 * Time: 14:25
 */
class Notify extends Base
{
    public function receive()
    {
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        if($xml) {
            $data = $this->xmlToArray($xml);
            if($data['return_code'] == 'SUCCESS')
            {
                if($data['result_code'] == 'SUCCESS')
                {
                    if($this->chekSign($data))
                    {
                        $msg = [
                            'out_trade_no' => $data['out_trade_no'],
                            'transaction_id' => $data['transaction_id'],
                            'total_fee' => $data['total_fee'],
                        ];
                        return $msg;
                    }
                }else{
                    $msg = array($data['err_code'],$data['err_code_des']);
                    $this->setLogs('notify.txt',json_encode($msg));
                }
            }else{
                $this->setLogs('notify.txt',json_encode($data));
                return;
            }
        }
    }
}