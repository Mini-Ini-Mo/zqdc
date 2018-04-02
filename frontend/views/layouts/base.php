<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

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
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $menuItems = [
        ['label' => '首页', 'url' => Yii::$app->homeUrl],
        [
            'label' => '中清商学',
            'items' => [
                ['label' => '中清筑道', 'url' => ['/lessons/index']],
                ['label' => '中清博纳', 'url' => ['/lessons/offline']],
                ['label' => '中清游学', 'url' => ['/study-abroad/index']],
                ['label' => '中清论坛', 'url' => ['/forum/index']],
    
            ],
        ],
        ['label' => '新领袖', 'url' => ['/expert/index']],
        //['label' => '专题', 'url' => ['/special/index']],
        [
            'label' => '中清智库',
            'items' => [
                ['label' => '智库案例', 'url' => ['/special/index']],
                ['label' => '智库创新营', 'url' => ['/special/index']],
            ],
        ],
    ];
    
    if (!Yii::$app->user->isGuest) {
        array_unshift($menuItems,['label' => '个人中心', 'url' => ['/member/index']]);
    }else{
        array_push($menuItems,['label' => '注册', 'url' => ['/site/signup']],['label' => '登录', 'url' => ['/site/login']]);
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
        <p class="pull-left">&copy; 中清地产 <?= date('Y') ?></p>  
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
