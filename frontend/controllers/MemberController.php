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
        $lt_actinfo = ActBaoming::find()
                        ->where(['phone' => $username])
                        ->joinwith([
                            'activity'=>function($q){
                                $q->where(['act_type'=>1]);
                            }
                        ])
                        ->orderBy('id')
                        ->limit(2)
                        ->all();
        $kc_actinfo = ActBaoming::find()
                        ->where(['phone' => $username])
                        ->joinwith([
                            'activity'=>function($q){
                                $q->where(['act_type'=>2]);
                            }
                        ])
                        ->orderBy('id')
                        ->limit(2)
                        ->all();
        $xs_actinfo = ActBaoming::find()
                        ->where(['phone' => $username])
                        ->joinwith([
                            'activity'=>function($q){
                                $q->where(['act_type'=>3]);
                            }
                        ])
                        ->orderBy('id')
                        ->limit(2)
                        ->all();
        
        $xx_actinfo = ActBaoming::find()
                        ->where(['phone' => $username])
                        ->joinwith([
                            'activity'=>function($q){
                                $q->where(['act_type'=>4]);
                            }
                        ])
                        ->orderBy('id')
                        ->limit(2)
                        ->all();
        
        return $this->render('mylessons',['lt_actinfo'=>$lt_actinfo,
                                          'kc_actinfo'=>$kc_actinfo,
                                          'xs_actinfo'=>$xs_actinfo,
                                          'xx_actinfo'=>$xx_actinfo]);
    }
    
    /**
     * {我的课程列表}
     */
    public function actionLessonslist($act_type)
    {
        $username = Yii::$app->user->identity->username;
        /*$query = ActBaoming::find()
        ->where(['phone' => $username])
        ->joinwith([
            'activity'=>function($q){
                $q->andwhere(['act_type'=>$act_type]);
            }
        ]);
        
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $pagination->setPageSize(5);
        
        $list = $query->orderBy('id')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();*/
        $query = (new \yii\db\Query())
        ->select('*')
        ->from('zq_activity AS a')
        ->leftJoin('zq_act_baoming AS ab','ab.act_id = a.id')
        ->where(['a.act_type'=>$act_type])
        ->andWhere(['ab.phone'=>$username]);
        
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $pagination->setPageSize(5);
        
        $list = $query->orderBy('a.id DESC')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->All();
        
        return $this->render('lessonslist',['list'=>$list,'pagination'=>$pagination]);
    }
    
    /**
     * {详情}
     */
    public function actionLessonsview($id)
    {
        $info = Activity::find()
        ->where(['id' => $id,'status' => 1])
        ->one();
    
        if (empty($info)) {  //请求有误,重定向
            $this->redirect(['member/mylessons']);
        }
    
        //专家信息
        $expert = (new \yii\db\Query())
        ->select(['id', 'name','head_img','introduction'])
        ->from('zq_expert')
        ->where('id = :expert_id',[':expert_id' => $info->expert_id])
        ->one();
    
        return $this->render('lessonsview',['info'=>$info,'expert'=>$expert]);
    }
    
    /**
     * {个人资料}
     */
    public function actionMyinfo()
    {
        $username = Yii::$app->user->identity->username;
        $info = Member::find()->where(['username'=>$username])->one();
        return $this->render('myinfo',['info'=>$info]);
    }
    
    /**
     * {联系我们}
     */
    public function actionContact()
    {
        return $this->render('contact');
    }
}