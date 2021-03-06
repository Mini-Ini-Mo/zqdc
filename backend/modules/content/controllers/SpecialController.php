<?php

namespace app\modules\content\controllers;

use Yii;
use common\models\Special;
use common\models\Expert;
use app\models\search\SpecialSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SpecialController implements the CRUD actions for Special model.
 */
class SpecialController extends Controller
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
                    'imagePathFormat' => '/image/special/headerimg/{yyyy}{mm}{dd}/{time}{rand:6}',
                ]
            ],
            'ueditor'=>[
                'class' => 'common\widgets\ueditor\UeditorAction',
                'config'=>[
                    //上传图片配置
                    'imageUrlPrefix' => \Yii::$app->params['resourceUrl'], /* 图片访问路径前缀 */
                    'imagePathFormat' => "/image/special/intro/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */

                    'videoUrlPrefix'=>\Yii::$app->params['resourceUrl'],
                    'videoPathFormat' => "/file/video/{yyyy}{mm}{dd}/{time}{rand:6}",
                    'videoMaxSize'=>'102400000',
                    'videoAllowFiles'=> [
                         ".ogg", ".mp4",
                    ],
                    'fileUrlPrefix' => \Yii::$app->params['resourceUrl'],
                    'filePathFormat' => '/file/aat/{yyyy}{mm}{dd}/{time}{rand:6}',
                ],

            ]
        ];
    }

    /**
     * Lists all Special models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SpecialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Special model.
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
     * Creates a new Special model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Special();
        $model->created_at = time();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //计算发文数量
            if($model->expert_id){
                $postnum = Special::find()->where(['expert_id'=>$model->expert_id])->count();
                Expert::updateAll(['post_num' => $postnum], ['id'=>$model->expert_id]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Special model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->created_at = time();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //计算发文数量
            if($model->expert_id){
                $postnum = Special::find()->where(['expert_id'=>$model->expert_id])->count();
                Expert::updateAll(['post_num' => $postnum], ['id'=>$model->expert_id]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Special model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        //计算发文数量
        if($id){
            $expert_id = Special::find()->where(['id'=>$id])->one();
            $postnum = Special::find()->where(['expert_id'=>$expert_id['expert_id']])->count();
            Expert::updateAll(['post_num' => $postnum], ['id'=>$expert_id]);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Special model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Special the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Special::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
