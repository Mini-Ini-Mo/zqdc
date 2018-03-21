<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Files */
/* @var $form ActiveForm */
$this->title = 'Create Files';
$this->params['breadcrumbs'][] = ['label' => 'Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="files-create">
        <?php if(Yii::$app->session->hasFlash('success')):?>
            <?=Yii::$app->session->getFlash('success')?>
        <?php endif ?>
        <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

        <?= $form->field($model, 'file[]')->fileInput(['multiple' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>