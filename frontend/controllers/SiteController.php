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
                            'name'=>'总裁课程',
                            'sub_button'=>array(
                                array(
                                    'name'=>'文旅地产',
                                    'type'=>'view',
                                    'url'=>'http://online.zqbs.org/index.php/video/index?type=1',
                                ),
                                array(
                                    'name'=>'财税',
                                    'type'=>'view',
                                    'url'=>'http://online.zqbs.org/index.php/video/index?type=2',
                                ),
                                array(
                                    'name'=>'去库存',
                                    'type'=>'view',
                                    'url'=>'http://online.zqbs.org/index.php/video/index?type=3',
                                ),
                            ),
                        ),
                        array(
                            'name'=>'中清学院',
                            'sub_button'=>array(
                                array(
                                    'name'=>'项目合作',
                                    'type'=>'view',
                                    'url'=>'http://online.zqbs.org/index.php/ProjectCase/index',
                                ),
                                array(
                                    'name'=>'线下课程',
                                    'type'=>'view',
                                    'url'=>'http://online.zqbs.org/index.php/course/index?type=1',
                                ),
                                array(
                                    'name'=>'学院简介',
                                    'type'=>'view',
                                    'url'=>'http://online.zqbs.org/index.php/course/index?type=1',
                                ),
                                array(
                                    'name'=>'我的',
                                    'type'=>'view',
                                    'url'=>'http://online.zqbs.org/index.php/Member/index',
                                ),
                            ),
                        ),
                    )
                )
            ],
            'unified-order' => [
                'class' => 'common\widgets\yii2_wechat\UnifiedOrderAction',
                'totalFee' => 1,
                'outTradeNo' => '2323232',
                'notifyUrl' => 'http://f.zqdc.com/index.php?r=site/notify',
                'body' => '商品'
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
