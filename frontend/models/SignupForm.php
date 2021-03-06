<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
//use common\models\User;
use common\models\Member;
use common\models\Smslog;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $com_name;
    public $contacts;
    public $password;
    public $captcha;
    public $confirmpd;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\Member', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

//             ['email', 'trim'],
//             ['email', 'required'],
//             ['email', 'email'],
//             ['email', 'string', 'max' => 255],
//             ['email', 'unique', 'targetClass' => '\common\models\Member', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            
            ['confirmpd', 'required'],
            ['confirmpd', 'string', 'min' => 6],
            ['confirmpd', 'compare','compareAttribute'=>'password'],
            
            ['captcha', 'required'],
            //['captcha', 'captcha'],
            ['captcha','checkCaptcha'],
            
            ['com_name', 'trim'],
            ['com_name', 'required'],
            
            ['contacts', 'trim'],
            ['contacts', 'required'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'auth_key' => 'Auth Key',
            'password' => '密码',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'com_name' => '企业名称',
            'contacts' => '联系人',
            'rememberMe' => '记住我',
            'captcha' => '验证码',
            'confirmpd' => '确认密码',
        ];
    }
    

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        //$user = new User();
        $user = new Member();
        $user->username = $this->username;
        //$user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
    
    //验证码验证
    public function checkCaptcha($attribute,$params)
    {
        $record = Smslog::find()
        ->where(['mobile' => $this->username,'sms_type'=>1,'isuse'=>0])
        ->orderBy('id desc')
        ->one();

        if (!empty($record)) {  //已经发送了
//             if(time() <= ($record['sendtime']+(\Yii::$app->params['bm_expires_in'])) ) {//发送的验证码还有效
                if ($this->$attribute == $record['code']){
                    $record->isuse = 1;
                    $record->save();
                    return true;
                } else {
                    $this->addError($attribute, "验证码有误");
                } 
//             } else {
//                 $this->addError($attribute, "验证码有误");
//             } 
        }else {
            $this->addError($attribute, "验证码有误");
        }
    }
    
}
