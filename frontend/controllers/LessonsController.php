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
use common\models\Activity;
use yii\data\Pagination;
use yii\web\Response;
use common\models\ActBaoming;
use frontend\models\LessonsForm;

/**
 * Site controller
 */
class LessonsController extends Controller
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
                'sms_type'=>2,
                'expires_in'=>Yii::$app->params['bm_expires_in'],
            ],
        ];
    }

    /**
     * 列表
     */
    public function actionIndex()
    {
        
        $query = Activity::find()->where(['status' => 1,'act_type'=>2]);

        $count = $query->count();
        
        // 使用总数来创建一个分页对象
        $pagination = new Pagination(['totalCount' => $count]);
        
        //设置每页数量
        $pagination->setPageSize(5);
        
        $list = $query->andWhere(['>', 'act_end_time', date("Y-m-d H:i:s")])
        ->orderBy('id')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        
        //往期回顾
        $history = (new \yii\db\Query())
        ->select(['id', 'topical','thumb','intro','created_at'])
        ->from('zq_activity')
        ->where(['status' => 1,'act_type'=>2])
        ->andWhere(['<', 'act_end_time', date("Y-m-d H:i:s")])
        ->limit(5)
        ->all();

        return $this->render('index',['list'=>$list,'pagination'=>$pagination,'history'=>$history]);
    }
    
    /**
    * 详情
    */
    public function actionView($id)
    {
        $info = Activity::find()
        ->where(['id' => $id,'status' => 1])
        ->one();
        
        if (empty($info)) {  //请求有误,重定向
            $this->redirect(['forum/index']);
        }
        
        //专家信息
        $expert = (new \yii\db\Query())
        ->select(['id', 'name','head_img','introduction'])
        ->from('zq_expert')
        ->where('id = :expert_id',[':expert_id' => $info->expert_id])
        ->one();

        return $this->render('view',['info'=>$info,'expert'=>$expert]);
    }
    
    /**
     * 报名
     * 
     */
    public function actionBaoming()
    {
        $request = \Yii::$app->request;

        $id = intval($request->get('id',0));
        if (empty($id)) {
            return $this->redirect(['lessons/index']);
        }
        
        $model = new LessonsForm();
        if ($model->load($request->post())) {
            if ($baoming = $model->baoming()) {
                Yii::$app->getSession()->setFlash('bmresult', ['status'=>'success','msg'=>'报名成功！']);
            } else {
                Yii::$app->getSession()->setFlash('bmresult', ['status'=>'error','msg'=>'报名失败！']);
            }
            return $this->redirect(['lessons/baoming','id'=>$id]);
        }

        return $this->render('baoming', [
            'model' => $model,
            'act_id'=>$id
        ]);
        
    }
 
}
