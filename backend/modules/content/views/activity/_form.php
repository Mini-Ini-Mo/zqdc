<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Activity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'act_type')->hiddenInput(['value'=>'1'])->label(false) ?>
    
    <?= $form->field($model, 'topical')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'thumb')->widget('common\widgets\file_upload\FileUpload',['config'=>['suggest'=>"仅支持文件格式为jpg、jpeg、png以及gif<br>大小在1MB以下的文件<br/>建议尺寸：160*100px"]]); ?>

    <?= $form->field($model, 'expert_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Expert::find()->all(),'id','name'),['prompt'=>'请选择']) ?>

    <?= $form->field($model, 'intro')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor',[
        'options' => [
            'initialFrameWidth' => 960,
            'initialFrameHeight' => 300,
        ]
    ]);  ?>

    <div class="row">
        <div class="col-md-4">
        <?= $form->field($model, 'act_begin_time')->widget(\kartik\datetime\DateTimePicker::className(),['value'=>0,
        'pluginOptions'=>[
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd HH:ii:00',
            'minuteStep'=>30
        ]]) ?>
        </div>
        <div class="col-md-4">
        <?= $form->field($model, 'act_end_time')->widget(\kartik\datetime\DateTimePicker::className(),['value'=>0,
            'pluginOptions'=>[
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd HH:ii:00',
                'minuteStep'=>30
            ]]) ?>
        </div>
    </div>



    <?= $form->field($model, 'created_at')->hiddenInput(['maxlength' => true,'value'=>time()])->label(false) ?>

    <?= $form->field($model, 'status')->hiddenInput(['value'=>1])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
