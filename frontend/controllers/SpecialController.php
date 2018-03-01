<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Special;
use yii\data\Pagination;
use yii\web\Response;


class SpecialController extends Controller{
    
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
        ];
    }
    
    
    public function actionIndex()
    {
        $query = Special::find()->where(['cate_id' => 1]);
        
        $count = $query->count();
        
        // 使用总数来创建一个分页对象
        $pagination = new Pagination(['totalCount' => $count]);
        
        //设置每页数量
        $pagination->setPageSize(2);
        
        $list = $query->orderBy('id')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        
        return $this->render('index',['list'=>$list,'pagination'=>$pagination]);
    }
    
    public function actionView($id)
    {   
        $info = Special::findOne(['id' => $id]);
        $info->read_num += 1;
        $info->save();
        
        return $this->render('view',['info'=>$info]);
    }
    
    /**
     * 点赞
     */
    public function actionPraise()
    {
        $request = \Yii::$app->request;
    
        $id = $request->get('id',0);
    
        $info = Special::find()
        ->where(['id' => $id])
        ->one();
    
        \Yii::$app->response->format=Response::FORMAT_JSON;
    
        if (empty($info)) {
            return ['code'=>402,'reason'=>'参数有误'];
        }
    
        $info->praise_num += 1;
        $info->save();
        return ['code'=>200,'reason'=>'操作成功'];
    }
}