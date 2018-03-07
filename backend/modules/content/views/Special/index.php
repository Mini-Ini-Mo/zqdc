<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Cate;
use common\models\Expert;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\SpecialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '专题';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="special-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建专题', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            [
            'attribute' => 'expert_id',
            'label' => '专家',
            'value' => function($model) {
                    $expert = Expert::find()->where(['id' => $model->expert_id])->one();
                    return $expert->name;
                },
            'headerOptions' => ['width' => '150']
            ],
            //'viewpoint:ntext',
            //'analysis:ntext',
            'praise_num',
            'read_num',
            //'status',
            //'created_at',
            [
            'attribute' => 'cate_id',
            'label' => '分类',
            'value' => function($model) {
                    $cate = Cate::find()->where(['id' => $model->cate_id])->one();
                    return $cate->name;
                },
            'headerOptions' => ['width' => '150']
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
