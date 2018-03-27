<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ActLessons */

$this->title = 'Update Act Lessons: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Act Lessons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="act-lessons-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
