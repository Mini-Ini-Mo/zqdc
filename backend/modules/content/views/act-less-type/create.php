<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ActLessType */

$this->title = 'Create Act Less Type';
$this->params['breadcrumbs'][] = ['label' => 'Act Less Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="act-less-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
