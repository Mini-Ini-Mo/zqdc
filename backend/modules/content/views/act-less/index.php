<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ActLessonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '中清博纳';
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
           /*  ['class' => 'yii\grid\SerialColumn'], */

            'id',
            'topical',
            
            ['attribute'=>'less_cate','value'=>function($model){
                $res = \yii\helpers\ArrayHelper::map(\common\models\ActLessCate::category(2),'id','name');
                return $res[$model->less_cate];
            }],
            
            //'thumb',
            //'intro',
            //'content:ntext',
            //'expert_id',
            'act_begin_time',
            'act_end_time',
            //'created_at',
            //'status',
            //'less_mode',
            //'source_type',
            //'addr',
            //'cost',
            ['attribute'=>'status','value'=>function($model){
                $res = [1=>'公开',2=>'不公开'];
                return $res[$model->status];
            }],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
