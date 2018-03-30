<?php
namespace common\widgets\yii2_wechat\src;
use common\widgets\yii2_wechat\src\Base;
/**
 * 公众号接口基类
 * Created by PhpStorm.
 * User: cuik
 * Date: 2018/3/29
 * Time: 14:14
 */
class Official extends Base
{
    const ACCESSTOKENURL = "https://api.weixin.qq.com/cgi-bin/token?";

    public function getAccessToken()
    {
        $session = \Yii::$app->session;
        if($session->get('accessToken.expires') < time() ) {
            $res = $this->requestAccessToken();
            if (isset($res['errcode']) != 0) {
                $this->setLogs('accessToken.txt', json_encode($res));
                return;
            }
            $session->set('accessToken.value', $res['access_token']);
            $session->set('accessToken.expires', $res['expires_in'] + time());
        }
        return $session->get('accessToken.value');
    }

    //请求获取ACCESSTOKEN
    public function requestAccessToken()
    {
        $url = self::ACCESSTOKENURL."grant_type=client_credential&appid=".self::APPID."&secret=".self::APPSECRET;
        $content = file_get_contents($url);
        return json_decode($content,true);
    }
}