<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ActLessCate */

$this->title = 'Create Act Less Cate';
$this->params['breadcrumbs'][] = ['label' => 'Act Less Cates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="act-less-cate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
