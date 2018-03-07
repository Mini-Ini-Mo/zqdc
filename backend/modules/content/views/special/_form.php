<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Cate;
use common\models\Expert;

/* @var $this yii\web\View */
/* @var $model common\models\Special */
/* @var $form yii\widgets\ActiveForm */

/* = $form->field($model, 'viewpoint')->textarea(['rows' => 6])
   = $form->field($model, 'analysis')->textarea(['rows' => 6]) 
   = $form->field($model, 'cate_id')->textInput()
   = $form->field($model, 'expert_id')->textInput()
   = $form->field($model, 'created_at')->textInput()
   = $form->field($model, 'status')->textInput()
   <?= $form->field($model, 'praise_num')->textInput(['maxlength' => true]) ?>
   <?= $form->field($model, 'read_num')->textInput(['maxlength' => true]) ?>*/
?>



<div class="special-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <label>分类：</label>
        <?= Html::activeDropDownList($model, 'cate_id', Cate::getCates(),['class'=>'form-control']) ?>
    </div>
    <div class="form-group">
        <label>专家：</label>
        <?= Html::activeDropDownList($model, 'expert_id', Expert::getExpertName(),['class'=>'form-control']) ?>
    </div>

    <?=$form->field($model, 'img')->widget('common\widgets\file_upload\FileUpload',['config'=>['suggest'=>"仅支持文件格式为jpg、jpeg、png以及gif<br>大小在1MB以下的文件<br/>建议尺寸：160*100px"]]); ?>
	
    <?=$form->field($model, 'viewpoint')->widget('common\widgets\ueditor\Ueditor',[
		'options' => [
			'initialFrameWidth' => 850,
		    'initialFrameHeight' => 300,
		]
	]); ?>
	
	<?=$form->field($model, 'analysis')->widget('common\widgets\ueditor\Ueditor',[
		'options' => [
			'initialFrameWidth' => 850,
		    'initialFrameHeight' => 300,
		]
	]); ?>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
