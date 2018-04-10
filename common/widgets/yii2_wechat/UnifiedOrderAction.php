<?php
namespace common\widgets\yii2_wechat;

use common\widgets\yii2_wechat\src\Authorization;
use common\widgets\yii2_wechat\src\UnifiedOrder;
use yii\base\Action;

/**
 * Created by PhpStorm.
 * User: cuik
 * Date: 2018/3/29
 * Time: 17:05
 */
class UnifiedOrderAction extends Action
{

    //支付总金额 单位（分）
    public $totalFee = 0;

    //订单号
    public $outTradeNo;

    //回调地址
    public $notifyUrl;

    //显示内容
    public $body;

    public $tradeType = 'JSAPI';

    public function run()
    {
        if(\Yii::$app->user->isGuest){
            return Url::toRoute(['site/login']);
        }
    	$authorization = new Authorization();
    	$openID = $authorization->getOpenID();
    	if(!$openID)
    		return;
    	
        $unified = new UnifiedOrder();
        $unified->setTradeType($this->tradeType);
        if($this->tradeType == 'JSAPI'){
        	$unified->setOpenID($openID);
        }
        $unified->setTotalFee($this->totalFee);
        $unified->setOutTradeNo($this->outTradeNo);
        $unified->setNotifyUrl($this->notifyUrl);
        $unified->setBody($this->body);
        $json = $unified->getJsonParams();

        $model = new \common\widgets\yii2_wechat\models\Order();

        $model->attributes = [
            'uid' => \Yii::$app()->user->getId(),
            'trade_type' => $this->tradeType,
            'total_fee' => $this->totalFee,
            'out_trade_no' => $this->outTradeNo,
            'created_at' => time(),
        ];

        $model->save();

        return $this->controller->renderPartial('order',['json'=>$json]);
    }

    public function init()
    {
        $this->outTradeNo = date('YmdHis',time()).rand(0,999);
    }
}