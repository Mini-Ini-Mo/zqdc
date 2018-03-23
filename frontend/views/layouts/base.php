<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <?php
    \yii\bootstrap\NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => '#',
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top text-center',
        ],
    ]);

    if (!Yii::$app->user->isGuest) {
        $menuItems = [
            ['label' => '个人中心', 'url' => ['/member/index']],
            ['label' => '精英论坛', 'url' => ['/forum/index']],
            ['label' => '专题讲座', 'url' => ['/lessons/index']],
            ['label' => '新领袖', 'url' => ['/expert/index']],
            ['label' => '专题', 'url' => ['/special/index']],
        ];
    }else{
        $menuItems = [
            ['label' => '首页', 'url' => Yii::$app->homeUrl],
            ['label' => '精英论坛', 'url' => ['/forum/index']],
            ['label' => '专题讲座', 'url' => ['/lessons/index']],
            ['label' => '新领袖', 'url' => ['/expert/index']],
            ['label' => '专题', 'url' => ['/special/index']],
        ];
    }
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    \yii\bootstrap\NavBar::end();
    ?>
    
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
