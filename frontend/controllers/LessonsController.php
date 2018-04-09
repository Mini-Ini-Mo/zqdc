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

use common\models\ActLessons;
use yii\web\Request;

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
        $request = new Request();

        $query = ActLessons::find()->where(['status' => 1,'less_mode'=>1]);
        
        $less_cate = $request->get('less_cate');
        
        if (!empty($less_cate)) {
            $query->andWhere(['less_cate' => $less_cate]);
        }

        $count = $query->count();
        
        // 使用总数来创建一个分页对象
        $pagination = new Pagination(['totalCount' => $count]);
        
        //设置每页数量
        $pagination->setPageSize(3);
        $list = $query->orderBy('id')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        
        $cate = (new \yii\db\Query())
        ->select(['id','name'])
        ->from('zq_act_less_cate')
        ->where(['type'=>1])
        ->all();

        return $this->render('index_2',['list'=>$list,'pagination'=>$pagination,'cate'=>$cate]);
    }
    
    //线下课程
    public function actionOffline()
    {
        $request = new Request();
        $query = ActLessons::find()->where(['status' => 1,'less_mode'=>2]);
        
        $less_cate = $request->get('less_cate');
        
        if (!empty($less_cate)) {
            $query->andWhere(['less_cate' => $less_cate]);
        }
        
        $count = $query->count();
        
        // 使用总数来创建一个分页对象
        $pagination = new Pagination(['totalCount' => $count]);
        
        //设置每页数量
        $pagination->setPageSize(6);
        
        //->andWhere(['>', 'act_end_time', date("Y-m-d H:i:s")])
        $list = $query->orderBy('id')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        
        $cate = (new \yii\db\Query())
        ->select(['id','name'])
        ->from('zq_act_less_cate')
        ->where(['type'=>2])
        ->all();
        
        return $this->render('offline',['list'=>$list,'pagination'=>$pagination,'cate'=>$cate]);
        
    }
    
    public function actionVoffline($id)
    {
        //讲座信息和专家信息
        $info = (new \yii\db\Query())
        ->select(['act.id', 'act.topical','act.expert_id','act.thumb','act.addr','act.cost','act.content','act.act_begin_time','act.act_end_time'])
        ->from('zq_act_lessons as act')
        ->where('act.id = :id and act.status = 1',[':id' => $id])
        ->one();
        
        if (empty($info)) {  //请求有误,重定向
            $this->redirect(['lessons/offline']);
        }
        
        //计算上一篇和下一篇
        $point = (new \yii\db\Query())
        ->select(['act.id', 'act.topical','act.expert_id','act.thumb','act.addr','act.cost','act.content','act.act_begin_time','act.act_end_time'])
        ->from('zq_act_lessons as act')
        ->where('act.id = :id and act.status = 1',[':id' => $id])
        ->one();
        
        
        $plist['prev'] = (new \yii\db\Query())
        ->select("id, topical")
        ->from('zq_act_lessons')
        ->where(['and', 'less_mode=2',['<', 'id', $id]])
        ->orderBy('id desc')
        ->limit(1)
        ->one();
        
        $plist['next'] = (new \yii\db\Query())
        ->select("id, topical")
        ->from('zq_act_lessons')
        ->where(['and', 'less_mode=2',['>', 'id', $id]])
        ->orderBy('id asc')
        ->limit(1)
        ->one();

        return $this->render('voffline',['info'=>$info,'plist'=>$plist]);
        
    }
    
    
    
    /**
    * 详情
    */
    public function actionView($id)
    {
        //讲座信息和专家信息
        $info = (new \yii\db\Query())
        ->select(['act.id', 'act.topical','act.expert_id','act.thumb','act.source_type' ,'exp.name','exp.position'])
        ->from('zq_act_lessons as act')
        ->leftJoin('zq_expert as exp', 'exp.id = act.expert_id')
        ->where('act.id = :id and act.status = 1',[':id' => $id])
        ->one();
        
        if (empty($info)) {  //请求有误,重定向
            $this->redirect(['lessons/index']);
        }

        //讲座课程
        $less = [];
        if ($info['source_type'] == 1) {
            $less = (new \yii\db\Query())
            ->select(['id', 'addr','sort','title','time_len'])
            ->from('zq_act_less')
            ->where('act_id = :act_id',[':act_id' => $id])
            ->orderBy('sort asc,id asc')
            ->all();
        }
        
        
        //推荐喜爱
        $recommend = (new \yii\db\Query())
        ->select(['id', 'topical','thumb'])
        ->from('zq_act_lessons')
        ->where(['status'=>'1','less_mode'=>'1'])
        ->andWhere('id != '.$id)
        ->orderBy('id desc')
        ->limit(2)
        ->all();
        
        return $this->render('view_2',['info'=>$info,'less'=>$less,'recommend'=>$recommend]);
        
        //return $this->render('view',['info'=>$info,'expert'=>$expert]);
    }
    
    public function actionVoice($id)
    {
        //讲座信息和专家信息
        $info = (new \yii\db\Query())
        ->select(['act.id', 'act.topical','act.expert_id','act.thumb', 'act.source_type' ,'exp.name','exp.position'])
        ->from('zq_act_lessons as act')
        ->leftJoin('zq_expert as exp', 'exp.id = act.expert_id')
        ->where('act.id = :id and act.status = 1',[':id' => $id])
        ->one();

        if (empty($info)) {  //请求有误,重定向
            $this->redirect(['lessons/index']);
        }
        
        //讲座课程
        $less = [];
        if ($info['source_type'] == 2) {
            $less = (new \yii\db\Query())
            ->select(['id', 'addr','sort','title','time_len'])
            ->from('zq_act_less')
            ->where('act_id = :act_id',[':act_id' => $id])
            ->orderBy('sort asc,id asc')
            ->all();
        }
        return $this->render('view_3',['info'=>$info,'less'=>$less]);
    
        //return $this->render('view',['info'=>$info,'expert'=>$expert]);
    }
    
    public function actionPpt($id)
    {
        //讲座信息和专家信息
        $info = (new \yii\db\Query())
        ->select(['act.id', 'act.topical','act.expert_id', 'exp.name','exp.position'])
        ->from('zq_activity as act')
        ->leftJoin('zq_expert as exp', 'exp.id = act.expert_id')
        ->where('act.id = :id and act.status = 1',[':id' => $id])
        ->one();
        
        if (empty($info)) {  //请求有误,重定向
            $this->redirect(['lessons/index']);
        }
        
        return $this->render('ppt',['info'=>$info,'ppt'=>'upload/abc.pptx']);
    }

    /**
     * 报名
     * 线下课程
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
            //酌情处理啊 
            $model->act_type = 'offline';
            
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
