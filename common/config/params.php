<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    
    'sms_config'=>[
        'soap_server_url'=>'http://sms.glodon.com/SMSService.asmx?wsdl',//服务地址
        'namespace'=>'http://www.glodon.com/',//命名空间
        'soap_action'=>'http://www.glodon.com/SendSms',//SOAPAction
        'soap_defencoding'=>'UTF-8',//编码
        'wsdl'=>'wsdl',//wsdl
        'username'=>'zfxc',//账户名
        'passwoed'=>'zfxc20130807',//密码
        'soap_request_action'=>'SendSms',//接口方法
    ],
];
