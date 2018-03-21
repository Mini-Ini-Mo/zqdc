<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Files */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="files-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'file[]')->fileInput(['maxlength' => true,'class'=>'form-control','multiple' => true, 'accept' => 'image/*']) ?>

    <?= $form->field($model, 'size')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'type')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'uid')->hiddenInput(['value'=>Yii::$app->user->getId()])->label(false) ?>

    <?= $form->field($model, 'status')->dropDownList(['usable'=>'可用','forbidden'=>'禁用'],['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->hiddenInput(['value'=>time()])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
