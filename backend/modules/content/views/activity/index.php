<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Activities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Activity', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'topical',
            //'thumb',
            //'intro',
            //'content:ntext',
            ['attribute'=>'expert_id','value'=>function($model){
                $res = \yii\helpers\ArrayHelper::map(\common\models\Expert::find()->all(),'id','name');
                return $res[$model->expert_id];
            }],
            'act_begin_time',
            'act_end_time',
            //'created_at',
            //'status',
            ['attribute'=>'act_type','value'=>function($model){
                $res = [1=>'论坛',2=>'讲座'];
                return $res[$model->act_type];
            }],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {settings}',
                'buttons' => [
                    'settings' => function ($url, $model, $key) {
                        return  Html::a('<span class="glyphicon glyphicon-log-in"></span>', $url, ['title' => '设置','style'=>'margin:0px 6px;'] ) ;
                    },
                    ],
                    'headerOptions' => ['width' => '180']
            ],
        ],
    ]); ?>
</div>
