<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\StudyAbroadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '中清游学';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="study-abroad-index">

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
            'title',
            ['attribute'=>'destination','value'=>function($model){
                $res = \yii\helpers\ArrayHelper::map(\common\models\ActLessCate::category(3),'id','name');
                return $res[$model->destination];
            }],
            ['attribute'=>'begin_time','value'=>function($model){
                return date('Y-m-d',strtotime($model->begin_time));
            }],
            'cost',
            ['attribute'=>'status','value'=>function($model){
                $res = [1=>'公开',2=>'不公开'];
                return $res[$model->status];
            }],
            //'intro',
            //'content:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
