<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StudyAbroad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="study-abroad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])?>
    
    <?= $form->field($model, 'destination')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\ActLessCate::category(3),'id','name'),['prompt'=>'请选择']) ?>
    
    <?=$form->field($model, 'thumb')->widget('common\widgets\file_upload\FileUpload',['config'=>['suggest'=>"仅支持文件格式为jpg、jpeg、png以及gif<br>大小在1MB以下的文件<br/>"]]); ?>
	
	
    <?= $form->field($model, 'begin_time')->widget(\kartik\datetime\DateTimePicker::className(),['value'=>0,
        'pluginOptions'=>[
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd',
            'minuteStep'=>30,
            'minView'=>2
        ]])->hint('游学开始时间') ?>
    
    <?= $form->field($model, 'days')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'cost')->textInput(['maxlength' => true])->hint('如：100元/人') ?>

    <?= $form->field($model, 'status')->radioList(['1'=>'公开','0'=>'不公开']) ?>

    <?= $form->field($model, 'intro')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor',[
        'options' => [
            'initialFrameWidth' => 960,
            'initialFrameHeight' => 300,
        ]
    ]);  ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
