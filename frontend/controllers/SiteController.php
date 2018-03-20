<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\widgets\SMS\Sms;
use common\widgets\SMS\SendSMS;
use common\models\Smslog;
use yii\web\Response;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    
    
    public function actionSms()
    {
        \Yii::$app->response->format=Response::FORMAT_JSON;
        $request = Yii::$app->getRequest();
    
        if (!$request->getIsPost()) {
            return ['code'=>403,'reason'=>'请求有误'];
        }
    
        $mobile = $request->post('mobile');
    
        //验证一下手机号码
        $mobre='/^(133|153|180|181|189|130|131|132|145|155|156|185|186|134|135|136|137|138|139|147|150|151|152|157|158|159|170|173|177|182|183|184|187|188)\d{8}$/';
    
        if (!empty($mobile) && !preg_match($mobre,$mobile)) {
            return ['code'=>402,'reason'=>'请输入正确的手机号码'];
        }
    
        $record = (new \yii\db\Query())
        ->select(['id', 'sendtime'])
        ->from('zq_smslog')
        ->where(['mobile' => $mobile,'sms_type'=>1,'isuse'=>0])
        ->orderBy('id desc')
        ->one();
    
        if (!empty($record)) {  //已经发送了
            if(time() <= ($record['sendtime']+120) ) {//发送的验证码还有效
                return ['code'=>402,'reason'=>'当前验证码有效。'];
            }
        }
    
        $code = mt_rand(100000, 999999);
        $content = '您的短信验证码：' .$code. '，30分钟内有效';
    
        $sms = new SendSMS();
        $res = $sms->send($mobile, $content);
    
        if ($res) {
            $smslog = new Smslog();
            $smslog->mobile = $mobile;
            $smslog->code = "$code";
            $smslog->ipaddr = Yii::$app->request->userIP;
            $smslog->sms_type = 1;
            $smslog->sendtime = time();
            $res = $smslog->save();
            if(!$res) {
                Yii::error($mobile."的验证码".$code."未记录到数据库");
            }
            return ['code'=>200,'reason'=>'验证码已经发送'];
        } else {
            return ['code'=>400,'reason'=>'验证码已经失败'];
        }
    
    }
    
    
    
    
}
