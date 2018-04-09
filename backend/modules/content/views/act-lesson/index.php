<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ActLessonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '中清助道';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="act-lessons-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            /* ['class' => 'yii\grid\SerialColumn'], */

            'id',
            'topical',
            //'less_cate',

            ['attribute'=>'less_cate','value'=>function($model){
                $res = \yii\helpers\ArrayHelper::map(\common\models\ActLessCate::category(1),'id','name');
                return $res[$model->less_cate];
            }],
            
            //'thumb',
            //'intro',
            //'content:ntext',
            //'expert_id',
            'act_begin_time',
            'act_end_time',
            //'created_at',
            ['attribute'=>'status','value'=>function($model){
                $res = [1=>'公开',2=>'不公开'];
                return $res[$model->status];
            }],
            //'less_mode',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {update_offline} {delete} {settings}',
                
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                    
                        if ($model->less_mode == 1) {
                            return  Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['title' => '设置','style'=>'margin:0px 6px;'] ) ;
                        }
                    },
                    'update_offline' => function ($url, $model, $key) {
                    
                        if ($model->less_mode == 2) {
                            return  Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['title' => '设置','style'=>'margin:0px 6px;'] ) ;
                        }
                    },
                    
                    'settings' => function ($url, $model, $key) {
                        return  Html::a('<span class="glyphicon glyphicon-log-in"></span>', $url, ['title' => '设置','style'=>'margin:0px 6px;'] ) ;
                    },
                    ],
                    'headerOptions' => ['width' => '180']
            ],
        ],
    ]); ?>
</div>
