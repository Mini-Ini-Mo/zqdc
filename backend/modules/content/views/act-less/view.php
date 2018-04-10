<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ActLessons */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Act Lessons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="act-lessons-view">

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
            'topical',
            'less_cate',
            'thumb',
            'intro',
            'content:ntext',
            'expert_id',
            'act_begin_time',
            'act_end_time',
            'created_at',
            'status',
            'less_mode',
            'source_type',
            'addr',
            'cost',
        ],
    ]) ?>

</div>
