<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\ActLessonSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="act-lessons-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'topical') ?>

    <?= $form->field($model, 'less_cate') ?>

    <?= $form->field($model, 'thumb') ?>

    <?= $form->field($model, 'intro') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'expert_id') ?>

    <?php // echo $form->field($model, 'act_begin_time') ?>

    <?php // echo $form->field($model, 'act_end_time') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'less_mode') ?>

    <?php // echo $form->field($model, 'source_type') ?>

    <?php // echo $form->field($model, 'addr') ?>

    <?php // echo $form->field($model, 'cost') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
