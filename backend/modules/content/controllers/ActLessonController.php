<?php

namespace app\modules\content\controllers;

use Yii;
use common\models\ActLessons;
use app\models\search\ActLessonSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use common\models\ActLess;
use yii\base\BaseObject;

/**
 * ActLessonController implements the CRUD actions for ActLessons model.
 */
class ActLessonController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'common\widgets\file_upload\UploadAction',
                'config' => [
                    'imagePathFormat' => '/image/activity/{yyyy}{mm}{dd}/{time}{rand:6}',
                ]
            ],
            'ueditor'=>[
                'class' => 'common\widgets\ueditor\UeditorAction',
                'config'=>[
                    //上传图片配置
                    'imageUrlPrefix' => \Yii::$app->params['resourceUrl'], /* 图片访问路径前缀 */
                    'imagePathFormat' => "/image/activity/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
                ]
            ]
        ];
    }
    
    /**
     * Lists all ActLessons models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActLessonSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ActLessons model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ActLessons model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ActLessons();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ActLessons model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ActLessons model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ActLessons model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActLessons the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActLessons::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    /**
     * 设置讲座的课程，只需要两个动作，一个添加，一个删除
     * @return:
     */
    public function actionSettings()
    {
        $request = new Yii\web\Request();
        $id = $request->get('id');
    
        //活动信息
        $actinfo = (new \yii\db\Query())
        ->select(['id', 'topical'])
        ->from('zq_activity')
        ->where('id=:id', [':id' => $id])
        ->one();
        //是否已经有设置
        $less = (new \yii\db\Query())
        ->select(['id', 'act_id','title','sort'])
        ->from('zq_act_less')
        ->where('act_id=:act_id', [':act_id' => $id])
        ->orderBy('sort asc, id asc')
        ->all();
    
        //资源库
        $source = (new \yii\db\Query())
        ->select(['id', 'file','file_name'])
        ->from('files')
        ->where('uid = '.Yii::$app->user->getId())
        ->all();
         
        return $this->render('settings', ['actinfo' => $actinfo,'less'=>$less,'id'=>$id,'source'=>$source]);
    }
    
    public function actionLess()
    {
    
        $request = new Yii\web\Request();
        $action = $request->post('action');
        \Yii::$app->response->format=Response::FORMAT_JSON;
    
        if ($action == 'add') { //添加
    
            $act_id = $request->post('act_id');
            $addr = $request->post('less');
            $sort = $request->post('sort',1);
            $title = $request->post('title');
            $time_len = $request->post('time_len');
    
            $less = new ActLess();
            $less->act_id = $act_id;
            $less->addr = $addr;
            $less->sort = $sort;
            $less->title = $title;
            $less->time_len = $time_len;
            $less->created_at = time();
    
            if ($less->save()) {
                return ['code'=>200,'reason'=>'添加成功','data'=>['id'=>$less->id,'title'=>$less->title,'sort'=>$less->sort]];
            } else {
                return ['code'=>400,'reason'=>'添加失败',];
            }
    
    
        } else if ($action == 'del') {
    
            $id = $request->post('id');
            $less = ActLess::findOne($id);
            if ($less->delete()) {
                return ['code'=>200,'reason'=>'删除成功'];
            } else {
                return ['code'=>400,'reason'=>'删除失败'];
            }
        }
    
    
    }
    
    
    
    
    
    
    
    
    
    
}
