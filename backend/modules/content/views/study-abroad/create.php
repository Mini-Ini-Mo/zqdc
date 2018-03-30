<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\StudyAbroad */

$this->title = 'Create Study Abroad';
$this->params['breadcrumbs'][] = ['label' => 'Study Abroads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="study-abroad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
