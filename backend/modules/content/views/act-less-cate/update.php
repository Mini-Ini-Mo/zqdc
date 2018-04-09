<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ActLessCate */

$this->title = 'Update Act Less Cate: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Act Less Cates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="act-less-cate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
