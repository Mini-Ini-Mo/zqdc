<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StudyAbroad */

$this->title = 'Update Study Abroad: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Study Abroads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="study-abroad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
