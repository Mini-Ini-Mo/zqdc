<?php
namespace frontend\controllers;


use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
//use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\LoginFormF;
use yii\web\Response;
/**
 * Site controller
 */
class SiteController extends Controller
{
    public $layout = 'base';
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
            'sms' => [
                'class' => 'common\components\Sms',
                'mobile'=>Yii::$app->getRequest()->post('mobile'),
                'sms_type'=>1,
                'expires_in'=>Yii::$app->params['bm_expires_in'],
            ],
            'menu' => [
                'class' => 'common\widgets\yii2_wechat\MenuAction',
                'data' =>  array(
                    'button'=>array(
                        array(
                            'name'=>'中清商学',
                            'sub_button'=>array(
                                array(
                                    'name'=>'中清筑道',
                                    'type'=>'view',
                                    'url'=>'http://frontend.xuncaiwangcai.com/index.php?r=lessons/index',
                                ),
                                array(
                                    'name'=>'中清博纳',
                                    'type'=>'view',
                                    'url'=>'http://frontend.xuncaiwangcai.com/index.php?r=lessons/offline',
                                ),
                                array(
                                    'name'=>'中清游学',
                                    'type'=>'view',
                                    'url'=>'http://frontend.xuncaiwangcai.com/index.php?r=study-abroad/index',
                                ),
                                array(
                                    'name'=>'中清论坛',
                                    'type'=>'view',
                                    'url'=>'http://frontend.xuncaiwangcai.com/index.php?r=forum/index',
                                ),
                            ),
                        ),
                    array(
                        'name'=>'中清智库',
                        'sub_button'=>array(
                            array(
                                'name'=>'项目合作',
                                'type'=>'view',
                                'url'=>'http://frontend.xuncaiwangcai.com/index.php?r=special/index',
                            ),

                        ),
                    ),
                    array(
                        'name'=>'我的中清',
                        'sub_button'=>array(
                            array(
                                'name'=>'项目合作',
                                'type'=>'view',
                                'url'=>'http://frontend.xuncaiwangcai.com/index.php?r=expert/index',
                            ),
                            array(
                                'name'=>'注册',
                                'type'=>'view',
                                'url'=>'http://frontend.xuncaiwangcai.com/index.php?r=site/signup',
                            ),
                            array(
                                'name'=>'登录',
                                'type'=>'view',
                                'url'=>'http://frontend.xuncaiwangcai.com/index.php?r=site/login',
                            ),
                        ),
                    ),
                )
            ],
            'unified-order' => [
                'class' => 'common\widgets\yii2_wechat\UnifiedOrderAction',
                'totalFee' => 1,
                'outTradeNo' => '2323232',
                'notifyUrl' => 'http://frontend.xuncaiwangcai.com/index.php?r=site/notify',
                'body' => '商品'
            ],
            'signature' => [
                'class' => 'common\widgets\yii2_wechat\SignatureAction',
                'token' => 'wangcai',
            ]

        ];
    }

    public function actionNotify()
    {


        return $this->render('notify');
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

        //$model = new LoginForm();
        $model = new LoginFormF();
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
    
}

/*class LoginForm
{
}*/
