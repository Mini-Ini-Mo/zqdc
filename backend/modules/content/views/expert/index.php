<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ExpertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '专家管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expert-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增专家', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            //'introduction:ntext',
            //'head_img',
            'read_num',
            'praise_num',
            //'created_at',
            'post_num',

            [
                'class' => 'yii\grid\ActionColumn',
                "header" => "操作",
            ],
        ],
    ]); ?>
</div>
