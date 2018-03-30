<?php
namespace common\widgets\yii2_wechat;
use yii\base\Action;

/**
 * Created by PhpStorm.
 * User: cuik
 * Date: 2018/3/30
 * Time: 15:44
 */

class SignatureAction extends Action
{
    public $token = 'wangcai';

    public function run()
    {
        $signature = isset($_GET['signature'])?$_GET['signature']:null;
        $timestamp = isset($_GET['timestamp'])?$_GET['timestamp']:null;
        $nonce = isset($_GET['nonce'])?$_GET['nonce']:null;
        $echo = isset($_GET['echostr'])?$_GET['echostr']:null;

        if($signature) {
            $arr = [$this->token, $timestamp, $nonce];

            sort($arr);

            $str = implode($arr);

            $str = sha1($str);

            if ($signature == $str) {
                echo $echo;
            }
        }
        \Yii::$app->end();
    }
}