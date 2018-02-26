<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\SpecialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Specials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="special-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Special', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'expert_id',
            'viewpoint:ntext',
            'analysis:ntext',
            //'praise_num',
            //'read_num',
            //'status',
            //'created_at',
            //'cate_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
