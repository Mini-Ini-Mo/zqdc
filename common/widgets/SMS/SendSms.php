<?php
namespace common\widgets\SMS;


class SendSMS {

    public $config_file;
    private $sms;

    public function init() {
        if ($this->sms == null) {
            Yii::import('ext.Sms');
            $this->sms = new Sms($this->config_file);
        }
    }

    /*public function send($phone, $content) {
        $data['phone'] = $phone;
        $data['content'] = $content;
        $return_msg = $this->sms->call('sendMessage', $data);  #发送信息
        $return_msg = json_decode($return_msg);
        if($return_msg->returnstatus!='Success'){
            return false;
        }else{
            return true;  
        }
      
    }*/

    public function getBalance() {
        return $this->sms->call('getBalance'); #查询余额
    }
    
    
    
    /**
	  *@mobiles 手机列表，可以是数组可以是逗号分离的手机号列表
	  *@content 发送的内容
	  *@mobCount 接收手机的数量 注意和参数mobiles中的数量相等
	  *@returnFormat 返回数据的格式 array,json
	  *rerurn array
	  		$result=array(
			'error'=>'no', //存在错误的标记
			'message'=>array(), //发生错误的信息列表
			'data'=>array(
				'bad_mobiles_list'=>$bad_mobiles_list, //不合格手机号列表
				'good_mobiles_list'=>$good_mobiles_list,//合格手机号列表
				'sent_mobiles_list'=>$sent_mobiles_list,//信息已经发出的信息的列表
			),
			);	
			
		调用实例:Sms::model()->send('18600399165','hello',1,'json');
	  */
	
	public function send($mobiles,$content,$mobCount=1,$returnFormat='array')
	{
		$good_mobiles_list=array();
		$bad_mobiles_list=array();
		$sent_mobiles_list=array();
		//初始化返回结果			
		$result=array(
			'error'=>'no',
			'message'=>array(),
			'data'=>array(
				'bad_mobiles_list'=>$bad_mobiles_list,
				'good_mobiles_list'=>$good_mobiles_list,
				'sent_mobiles_list'=>$sent_mobiles_list,
			),
		);	
		//初步提取出11位手机号
		if(!is_array($mobiles))
		{	
			if(is_string($mobiles))
			{
				$mobiles_list=explode(',',$mobiles);
			}
			else
			{
				$mobiles_list=array();
			}
		}
		else
		{
			$mobiles_list=&$mobiles;
		}
		if(empty($mobiles_list) || count($mobiles_list)!=$mobCount)
		{
            $result['error']='yes';
            $result['message'][]=array('bad_mobile_list');	
		}
		else
		{
			//过滤无效手机号码
			$mobre='/^(133|153|180|181|189|130|131|132|145|155|156|185|186|134|135|136|137|138|139|147|150|151|152|157|158|159|170|173|177|182|183|184|187|188)\d{8}$/';
			foreach($mobiles_list as $mo)
			{
				if(preg_match($mobre,$mo))
				{
					$good_mobiles_list[]=$mo;
				}
				else
				{
					$bad_mobiles_list[]=$mo;;
				}
			}
			//加载基础配置，实例化对象
          
			//require_once(Yii::app()->basePath  . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'nusoap' . DIRECTORY_SEPARATOR .'nusoap.php');

			//$client = new nusoap_client($soap_config['soap_server_url'],$soap_config['wsdl']);
			//$client->setDebugLevel(3);	
			
			$soap_config = \Yii::$app->params['sms_config'];
			$client = new \nusoap_client($soap_config['soap_server_url'],$soap_config['wsdl']);
			
			
			
			$client->soap_defencoding=$soap_config['soap_defencoding'];
			foreach($good_mobiles_list as $mo){
				$data=$client->call($soap_config['soap_request_action'],array(
					'mobile'=>$mo,
					'text'=>$content,
					'username'=>$soap_config['username'],
					'password'=>$soap_config['passwoed']
				),$soap_config['namespace'],$soap_config['soap_action']);

				if ($client->fault) {
					$result['error']='yes';
					$result['message'][]=array($mo=>'fault');
				} else {
					$err = $client->getError();
					if ($err) {
						$result['error']='yes';
						$result['message'][]=array($mo=>$err);
					} else {
						if($data['SendSmsResult']==1){
							$params['server_response']=$result;
							$result['error']='no';
							$result['data']['sent_mobiles_list'][]=$params;
						}
						else
						{
							$result['error']='yes';
							$result['message'][]='send_error';
						}
					}
				}
			}
           
		}
      
		$result_data=$returnFormat=='array'?$result:($returnFormat=='json'?json_encode($result):$result);
        if($result_data['error']=='yes'){
            return false; 
        }else{
            return true;  
        }
		//return $result_data;
	}

}
