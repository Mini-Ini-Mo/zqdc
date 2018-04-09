<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ActLessons */

$this->title = 'Create Act Lessons';
$this->params['breadcrumbs'][] = ['label' => 'Act Lessons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="act-lessons-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
