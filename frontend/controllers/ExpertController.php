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
use common\models\Expert;
use yii\data\Pagination;
use yii\web\Response;

/**
 * Site controller
 */
class ExpertController extends Controller
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
        ];
    }

    /**
     * 列表
     */
    public function actionIndex()
    {
        
        $query = Expert::find()->where(['status' => 1]);

        $count = $query->count();
        
        // 使用总数来创建一个分页对象
        $pagination = new Pagination(['totalCount' => $count]);
        
        //设置每页数量
        $pagination->setPageSize(5);
        
        $list = $query->orderBy('id')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
 
        return $this->render('index',['list'=>$list,'pagination'=>$pagination]);
    }
    
    /**
    * 详情
    */
    public function actionView($id)
    {
        $info = Expert::find()
        ->where(['id' => $id])
        ->one();
        
        //阅读量加一
        if (!empty($info)) {
            $info->read_num += 1;
            $info->save();
        }
        
        //推荐文章
        $recommend = (new \yii\db\Query())
        ->select(['id', 'title','img','viewpoint','read_num','praise_num'])
        ->from('zq_special')
        ->where('expert_id = :id',[':id' => $id])
        ->orderBy(['read_num' => SORT_DESC])
        ->limit(5)
        ->all();
        
        return $this->render('view',['info'=>$info,'recommend'=>$recommend]);
    }
    
    
    
    /**
     * 点赞
     */
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
        
        $info = Expert::find()
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
