<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Member;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\models\ActBaoming;
use yii\data\Pagination;
use common\models\Activity;

class MemberController extends Controller{    
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
    
    public function actionIndex()
    {
        $username = Yii::$app->user->identity->username;
        $model = Member::find()->select('username,com_name,contacts')->where(['username' => $username])->one();
        return $this->render('index',['model'=>$model]);
    }
    
    /**
     * {我的论坛}
     */
    public function actionMyforum()
    {
        $username = Yii::$app->user->identity->username;
        $query = ActBaoming::find()->where(['phone' => $username])->joinwith([
            'activity'=>function($q){
                $q->where(['act_type'=>1]);
            }
        ]);
        
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $pagination->setPageSize(5);
        
        $actbminfo = $query->orderBy('id')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        return $this->render('myforum',['actbminfo'=>$actbminfo,'pagination'=>$pagination]);
    }
    
    /**
     * {我的课程}
     */
    public function actionMylessons()
    {
        $username = Yii::$app->user->identity->username;
        $query = ActBaoming::find()->where(['phone' => $username])->joinwith([
            'activity'=>function($q){
                $q->where(['act_type'=>2]);
            }
        ]);
        
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $pagination->setPageSize(5);
        
        $actbminfo = $query->orderBy('id')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        return $this->render('mylessons',['actbminfo'=>$actbminfo,'pagination'=>$pagination]);
    }
}