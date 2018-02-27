<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Expert */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expert-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'head_img')->widget('common\widgets\file_upload\FileUpload')?>
				
	<?=$form->field($model, 'introduction')->widget('common\widgets\ueditor\Ueditor',[
		'options' => [
			'initialFrameWidth' => 850,
		    'initialFrameHeight' => 300,
		]
	])?>
	
    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
