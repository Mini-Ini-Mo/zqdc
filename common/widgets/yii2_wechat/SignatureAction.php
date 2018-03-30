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
        $signature = $_GET['signature'];
        $timestamp = $_GET['timestamp'];
        $nonce = $_GET['nonce'];
        $echo = $_GET['echostr'];

        if($signature) {
            $arr = [$this->token, $timestamp, $nonce];

            sort($arr);

            $str = explode($arr);

            $str = sha1($str);

            if ($signature == $str) {
                echo $echo;
            }
        }
    }
}