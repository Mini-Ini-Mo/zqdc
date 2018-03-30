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
use yii\data\Pagination;
use yii\web\Response;
use common\models\ActLessons;
use yii\web\Request;
use common\models\StudyAbroad;
use frontend\models\LessonsForm;

/**
 * Site controller
 */
class StudyAbroadController extends Controller
{
    public $layout = 'base';
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [];
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
                'sms_type'=>3,
                'expires_in'=>Yii::$app->params['bm_expires_in'],
            ],
        ];
    }

    /**
     * 列表
     */
    public function actionIndex()
    {
        $query = StudyAbroad::find()->where(['status' => 1]);
 
        $count = $query->count();
        
        // 使用总数来创建一个分页对象
        $pagination = new Pagination(['totalCount' => $count]);
        
        //设置每页数量
        $pagination->setPageSize(4);
        $list = $query->orderBy('id desc')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        return $this->render('index',['list'=>$list,'pagination'=>$pagination,]);
    }
    
    public function actionView($id)
    {
        $info = (new \yii\db\Query())
        ->select(['id', 'destination','thumb','begin_time' ,'cost','intro','content','days'])
        ->from('zq_study_abroad')
        ->where('id = :id and status = 1',[':id' => $id])
        ->one();

        if (empty($info)) {  //请求有误,重定向
            return $this->redirect(['index']);
        }
        
        return $this->render('view',['info'=>$info]);
    }
    
    public function actionBaoming()
    {
        $request = \Yii::$app->request;
        $id = intval($request->get('id',0));
        
        if (empty($id)) {
            return $this->redirect(['study-abroad/index']);
        }

        $model = new LessonsForm();
        
        if ($model->load($request->post())) {
            //酌情处理啊
            $model->act_type = 'study';
        
            if ($baoming = $model->baoming()) {
                Yii::$app->getSession()->setFlash('bmresult', ['status'=>'success','msg'=>'报名成功！']);
            } else {
                Yii::$app->getSession()->setFlash('bmresult', ['status'=>'error','msg'=>'报名失败！']);
            }
            return $this->redirect(['study-abroad/baoming','id'=>$id]);
        }
        
        return $this->render('baoming', [
            'model' => $model,
            'act_id'=>$id
        ]);
    }
    
    
    
    

}
