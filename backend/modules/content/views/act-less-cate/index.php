<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ActLessCateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商学类目';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="act-less-cate-index">

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
            'name',
            ['attribute'=>'type','value'=>function($model){
                $res = \common\models\ActLessCate::cate();
                return $res[$model->type];
            }],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
