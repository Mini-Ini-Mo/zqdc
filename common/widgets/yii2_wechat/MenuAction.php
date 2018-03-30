<?php
namespace common\widgets\yii2_wechat;
use yii\base\Action;
use common\widgets\yii2_wechat\src\Official;

/**
 * Created by PhpStorm.
 * User: cuik
 * Date: 2018/3/29
 * Time: 14:07
 */
class MenuAction extends Action
{
    const CREATEURL = "https://api.weixin.qq.com/cgi-bin/menu/create?";

    public $data = array();

    public function run()
    {
        $official = new Official();
        $access_token = $official->getAccessToken();
        $url = self::CREATEURL."access_token=".$access_token;
        $json = json_encode($this->data, JSON_UNESCAPED_UNICODE);
        $data = json_decode($official->postCurl($url,$json),true);

        if($data['errcode'] !=0 )
        {
            $official->setLogs('menu.txt', json_encode($data));
            return;
        }
        return true;
        \Yii::$app->end();
    }
}