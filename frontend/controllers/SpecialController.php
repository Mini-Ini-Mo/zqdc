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
use common\models\Cate;


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
    
    
    public function actionIndex($cate_id=1)
    {
        $query = Special::find()->where(['cate_id' => $cate_id]);
        
        $count = $query->count();
        
        // 使用总数来创建一个分页对象
        $pagination = new Pagination(['totalCount' => $count]);
        
        //设置每页数量
        $pagination->setPageSize(2);
        
        $list = $query->orderBy('id')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        $cates = Cate::getCates();
        
        return $this->render('index',['list'=>$list,'pagination'=>$pagination,'cates'=>$cates]);
    }
    
    public function actionView($id)
    {   
        $info = Special::find()->where(['id' => $id])->one();
        
        $info->updateCounters(['read_num' => 1]);
        return $this->render('view',['info'=>$info]);
    }
    
    /**
     * 点赞
     */
    /*public function actionPraise()
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
        
        $info->updateCounters(['praise_num' => 1]);
        return ['code'=>200,'reason'=>'操作成功'];
    }*/
    
public function actionPraise()
    {
        \Yii::$app->response->format=Response::FORMAT_JSON;
        
        $request = \Yii::$app->request;
        $cookies = Yii::$app->request->cookies;
        
        $id = $request->get('id',0);

        if (($cookie = $cookies->get('expert_id')) !== null) {
            $cookie = json_decode($cookie,true);
            if (in_array($id,$cookie)) {
                return ['code'=>100,'reason'=>'您已经点赞。'];
            }
        }
        
        $info = Special::find()
        ->where(['id' => $id])
        ->one();

        if (empty($info)) {
            return ['code'=>402,'reason'=>'参数有误'];
        }

        $info->praise_num += 1;
        $info->save();
       
       $cookie[] = $id;
       Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => 'expert_id',
            'value'=>json_encode($cookie),
        ]));
        
        return ['code'=>200,'reason'=>'操作成功','data'=>['praise'=>$info->praise_num]];
    }
}