<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StudyAbroad */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Study Abroads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="study-abroad-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'destination',
            'begin_time',
            'cost',
            'status',
            'intro',
            'content:ntext',
        ],
    ]) ?>

</div>
