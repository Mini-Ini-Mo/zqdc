<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Activity */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
            [
                'attribute' => 'thumb',
                'label' => '图片',
                'value' => function($model) {
                    $url = \Yii::$app->params['resourceUrl'].$model->thumb;
                    return "<img src=$url>";
                },
                'headerOptions' => ['width' => '150'],
                'format'=>'raw'
            ],
            ['attribute'=>'intro','format'=>'raw'],
            ['attribute'=>'content','format'=>'raw'],
            'expert_id',
            'act_begin_time',
            'act_end_time',
            'created_at',
            ['attribute'=>'status','value'=>function($model){
                $res = [0=>'删除',1=>'显示'];
                return $res[$model->status];
            }],
            ['attribute'=>'act_type','value'=>function($model){
                $res = [1=>'论坛',2=>'讲座'];
                return $res[$model->status];
            }],
        ],
    ]) ?>

</div>
