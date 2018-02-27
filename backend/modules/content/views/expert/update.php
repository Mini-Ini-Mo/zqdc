<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Expert */

$this->title = '编辑专家';
$this->params['breadcrumbs'][] = ['label' => '专家管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="expert-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
