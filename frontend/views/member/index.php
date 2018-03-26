<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->registerCssFile('css/expert.css');

$this->title = '个人中心';
?>

<div class="row row-box ptop">
	<div class="col-xs-5">
		<img src="" class="img-circle" width="80" height="80">
	</div>
	<div class="col-xs-5">
		<p><?php echo $model->com_name?></p>
		<p><?php echo $model->username?></p>
	</div>
</div>

<ul>
    <li class="page-header">
        <h5> 个人资料
            <small class="pull-right">
                <a href="<?=Yii::$app->params['frontendUrl']?>?r=member/myinfo">
                    <span class="glyphicon glyphicon-menu-right"></span>
                </a>
            </small>
        </h5>
    </li>
    <li class="page-header">
        <h5> 我的课程
            <small class="pull-right">
                <a href="<?=Yii::$app->params['frontendUrl']?>?r=member/mylessons">
                    <span class="glyphicon glyphicon-menu-right"></span>
                </a>
            </small>
        </h5>
    </li>
    <li class="page-header">
        <h5> 我的智库
            <small class="pull-right">
                <a href="<?=Yii::$app->params['frontendUrl']?>?r=member">
                    <span class="glyphicon glyphicon-menu-right"></span>
                </a>
            </small>
        </h5>
    </li>
    <li class="page-header">
        <h5> 我的推广
            <small class="pull-right">
                <a href="<?=Yii::$app->params['frontendUrl']?>?r=member">
                    <span class="glyphicon glyphicon-menu-right"></span>
                </a>
            </small>
        </h5>
    </li>
    <li class="page-header">
        <h5> 我的发票
            <small class="pull-right">
                <a href="<?=Yii::$app->params['frontendUrl']?>?r=member">
                    <span class="glyphicon glyphicon-menu-right"></span>
                </a>
            </small>
        </h5>
    </li>
    <li class="page-header">
        <h5> 联系我们
            <small class="pull-right">
                <a href="<?=Yii::$app->params['frontendUrl']?>?r=member">
                    <span class="glyphicon glyphicon-menu-right"></span>
                </a>
            </small>
        </h5>
    </li>
    <li class="page-header">
        <h5> 加入我们
            <small class="pull-right">
                <a href="<?=Yii::$app->params['frontendUrl']?>?r=site/signup">
                    <span class="glyphicon glyphicon-menu-right"></span>
                </a>
            </small>
        </h5>
    </li>
</ul>
<!-- <div class="page-header">
  <h5>
    <img src="<?= Yii::$app->params['frontendUrl'] ?>/images/lt.png" class="img-circle" width="20" height="20"> 个人资料
    <small class="pull-right">
        <a href="<?=Yii::$app->params['frontendUrl']?>?r=member/myforum">
            <span class="glyphicon glyphicon-menu-right"></span>
        </a>
    </small>
  </h5>
</div>

<div class="page-header">
  <h5>
    <img src="<?= Yii::$app->params['frontendUrl'] ?>/images/lt.png" class="img-circle" width="20" height="20"> 我的课程
    <small class="pull-right">
        <a href="<?=Yii::$app->params['frontendUrl']?>?r=member/myforum">
            <span class="glyphicon glyphicon-menu-right"></span>
        </a>
    </small>
  </h5>
</div>

<div class="page-header">
  <h5>
    <img src="<?= Yii::$app->params['frontendUrl'] ?>/images/kc.png" class="img-circle" width="20" height="20"> 我的智库 
    <small class="pull-right">
        <a href="<?=Yii::$app->params['frontendUrl']?>?r=member/mylessons">
            <span class="glyphicon glyphicon-menu-right"></span>
        </a>
    </small>
  </h5>
</div>

<div class="page-header">
  <h5>
    <img src="<?= Yii::$app->params['frontendUrl'] ?>/images/lt.png" class="img-circle" width="20" height="20"> 我的推广 
    <small class="pull-right"><span class="glyphicon glyphicon-menu-right"></span></small>
  </h5>
</div>

<div class="page-header">
  <h5>
    <img src="<?= Yii::$app->params['frontendUrl'] ?>/images/fp.png" class="img-circle" width="20" height="20"> 我的发票
    <small class="pull-right">
        <a href="<?=Yii::$app->params['frontendUrl']?>?r=member/myforum">
            <span class="glyphicon glyphicon-menu-right"></span>
        </a>
    </small>
  </h5>
</div>

<div class="page-header">
  <h5>
    <img src="<?= Yii::$app->params['frontendUrl'] ?>/images/lt.png" class="img-circle" width="20" height="20"> 我的需求
    <small class="pull-right">
        <a href="<?=Yii::$app->params['frontendUrl']?>?r=member/myforum">
            <span class="glyphicon glyphicon-menu-right"></span>
        </a>
    </small>
  </h5>
</div>

<div class="page-header">
  <h5>
    <img src="<?= Yii::$app->params['frontendUrl'] ?>/images/lt.png" class="img-circle" width="20" height="20"> 加入我们
    <small class="pull-right">
        <a href="<?=Yii::$app->params['frontendUrl']?>?r=site/login">
            <span class="glyphicon glyphicon-menu-right"></span>
        </a>
    </small>
  </h5>
</div>

<div class="page-header">
  <h5>
    <img src="<?= Yii::$app->params['frontendUrl'] ?>/images/lt.png" class="img-circle" width="20" height="20"> 联系我们
    <small class="pull-right">
        <a href="<?=Yii::$app->params['frontendUrl']?>?r=member/myforum">
            <span class="glyphicon glyphicon-menu-right"></span>
        </a>
    </small>
  </h5>
</div> -->