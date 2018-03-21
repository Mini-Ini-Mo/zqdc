<?php 
namespace common\widgets\SMS;

class Sms {
        private $conf=array();
        private $base_url='http://dx.ipyy.net/';
        private $int_conf=array();
        private $hardKEY='';
        public function __construct($conf_file)
        {
            $this->conf=include($conf_file);
            $this->hardKEY=$this->conf['public_vars']['hardKEY'];
            $this->int_conf['sendMessage']=array(
                'url'=>'smsJson.aspx',
                'params'=>'account,password',
            );   
        }
        
        public function call($int_name,$params=array())
        {
            return $this->$int_name($params);
        }
        
        private function register()
        {
            return $url=$this->_packurl('register');
        }   

        private function sendMessage($params)
        {
            $phone=$params['phone'];
            $content=$params['content'];
            $default_params="action=send&mobile={$phone}&content=".$content.'【旺材电商】';
            $default_params.="&sendTime=&extno=";
            $url=$this->_packurl('sendMessage',$default_params);
            return $this->_netExec($url);
        }
        
        private function getBalance()
        {
            $url=$this->_packurl('getBalance');
            return $this->_netExec($url);
        }
        
        
        private function _packurl($int_name,$paramsString='')
        {       
            $params=array();
            $keys=explode(',',$this->int_conf[$int_name]['params']);
            foreach($keys as $k)
            {
                $params[]=sprintf('%s=%s',$k,$this->conf['public_vars'][$k]);
            }
            $url=sprintf('%s%s?%s&%s',$this->base_url,$this->int_conf[$int_name]['url'],implode('&',$params),$paramsString);
            $url.='&hardKEY=' . $this->hardKEY;
            return $url;
        }
        
        private function _netExec($url)
        {
            $options = array(
                CURLOPT_RETURNTRANSFER => true,         // return web page
                CURLOPT_HEADER         => false,        // don't return headers
            );
            $ch = curl_init($url);
            curl_setopt_array($ch,$options);
            $content = curl_exec($ch);
            curl_close($ch);
            return $content;
        }
    }
?>