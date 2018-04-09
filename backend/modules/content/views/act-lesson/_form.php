<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ActLessons */
/* @var $form yii\widgets\ActiveForm */

$this->title = '中清助道';

?>

<div class="act-lessons-form row">
    <div class="col-md-6">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'topical')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'less_cate')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\ActLessCate::category(1),'id','name'),['prompt'=>'请选择']) ?>

    <?= $form->field($model, 'thumb')->widget('common\widgets\file_upload\FileUpload',['config'=>['suggest'=>"仅支持文件格式为jpg、jpeg、png以及gif<br>大小在1MB以下的文件<br/>建议尺寸：160*100px"]]); ?>
    
    <?= $form->field($model, 'intro')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor',[
        'options' => [
            'initialFrameWidth' => 960,
            'initialFrameHeight' => 300,
        ]
    ]);  ?>

    <?= $form->field($model, 'expert_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Expert::find()->all(),'id','name'),['prompt'=>'请选择']) ?>
    
    <?= $form->field($model, 'status')->radioList(['1'=>'公开','0'=>'不公开']) ?>

    <?= $form->field($model, 'less_mode')->hiddenInput(['value'=>'1'])->label(false) ?>
    
    <?= $form->field($model, 'cost')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'source_type')->radioList(['1'=>'视频','2'=>'音频'])?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    </div>
</div>
