<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\StudyAbroadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="study-abroad-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'destination') ?>

    <?= $form->field($model, 'begin_time') ?>

    <?= $form->field($model, 'cost') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'intro') ?>

    <?php // echo $form->field($model, 'content') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
