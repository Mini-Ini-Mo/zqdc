<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Cate;
use common\models\Expert;

/* @var $this yii\web\View */
/* @var $model common\models\Special */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Specials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="special-view">

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
            'viewpoint:ntext',
            ['attribute'=>'analysis','format'=>'raw'],
            'praise_num',
            'read_num',
            [
                'label'=>'创建时间',
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            [
            'attribute' => 'cate_id',
            'label' => '分类',
            'value' => function($model) {
                    $cate = Cate::find()->where(['id' => $model->cate_id])->one();
                    return $cate->name;
                },
            'headerOptions' => ['width' => '150']
            ],
            [
            'attribute' => 'img',
            'label' => '图片',
            'value' => function($model) {
                $url = \Yii::$app->params['resourceUrl'].$model->img;
                return "<img src=$url>";
            },
            'headerOptions' => ['width' => '150'],
            'format'=>'raw'
            ],
        ],
    ]) ?>

</div>
