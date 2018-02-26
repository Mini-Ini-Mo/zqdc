<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Special */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="special-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expert_id')->textInput() ?>

    <?= $form->field($model, 'viewpoint')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'analysis')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'praise_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'read_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'cate_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
