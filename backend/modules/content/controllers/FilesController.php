<?php

namespace app\modules\content\controllers;

use app\models\form\UploadForm;
use common\widgets\file_upload\Uploader;
use Yii;
use common\models\Files;
use backend\models\search\FilesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * FilesController implements the CRUD actions for Files model.
 */
class FilesController extends Controller
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

    /**
     * Lists all Files models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FilesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Files model.
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
     * Creates a new Files model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new UploadForm();
        if (\Yii::$app->request->isPost)
        {
            $form->load(\Yii::$app->request->post());
            
            $form->file = UploadedFile::getInstances($form,'file');

            if($form->file && $form->validate())
            {
                foreach ($form->file as $file) {
                    $new_name = date('YmdHis', time()) . rand(0, 999). '.' . $file->getExtension();
                    $new_path = 'upload/' . $new_name;
                    if ($file->saveAs($new_path)) {
                        $model = new Files();
                        $model->attributes = [
                            'name' => $new_name,
                            'file' => $new_path,
                            'size' => $file->size,
                            'type' => $file->type,
                            'created_at' => time(),
                            'uid' => Yii::$app->user->getId(),
                            'file_name'=>$form->file_name,
                        ];
                        
                        if ($model->save()) {
                            Yii::$app->session->setFlash('success','上传成功！');
                            return $this->redirect(['create']);
                        } else {
                            unlink($new_path);
                        }
                    }
                }
            }
        }

        return $this->render('upload', [
            'model' => $form,
        ]);
    }

    /**
     * Updates an existing Files model.
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
     * Deletes an existing Files model.
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
     * Finds the Files model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Files the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Files::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
