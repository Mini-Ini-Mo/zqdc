<?php
namespace common\widgets\yii2_wechat\src;
use common\widgets\yii2_wechat\src\Base;

/**
 * 网页授权类.
 * User: cuik
 * Date: 2018/3/16
 * Time: 11:50
 */

class Authorization extends Base
{
    //获取CODE请求地址
    const CODEURL = 'https://open.weixin.qq.com/connect/oauth2/authorize?';

    //获取Access_token地址
    const AUTHORIAZATIONACCESSTOKENURL = 'https://api.weixin.qq.com/sns/oauth2/access_token?';

    public $scope;

    public function __construct($scope='snsapi_base')
    {
        $this->scope = $scope;
    }

    public function getOpenID()
    {
        $res = $this->getAccessToken();

        return isset($res['openid'])?$res['openid']:null;
    }

    //获取ACCESS_TOKEN
    public function getAccessToken()
    {
        $code = $this->getCode();
			
        $url = self::AUTHORIAZATIONACCESSTOKENURL.'appid='.self::APPID.'&secret='.self::APPSECRET.'&code='.$code.'&grant_type=authorization_code';
        $content = file_get_contents($url);
        return json_decode($content,true);
    }


    //获取CODE
    public function getCode()
    {
        if(!isset($_GET['code']))
        {
            $redirect_uri = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $url = self::CODEURL.'appid='.self::APPID.'&redirect_uri='.$redirect_uri.'&response_type=code&scope='.$this->scope.'&state=STATE#wechat_redirect';
            header('location:'.$url);
        }else{
            return $_GET['code'];
        }
    }
}
