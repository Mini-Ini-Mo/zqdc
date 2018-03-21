<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ActBaoming */
/* @var $form ActiveForm */
?>
<div class="lessons-lessons">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'company') ?>
        <?= $form->field($model, 'contacts') ?>
        <?= $form->field($model, 'position') ?>
        <?= $form->field($model, 'phone') ?>
        <?= $form->field($model, 'join_num') ?>
        <?= $form->field($model, 'act_id') ?>
        <?= $form->field($model, 'created_at') ?>
        <?= $form->field($model, 'remark') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- lessons-lessons -->
