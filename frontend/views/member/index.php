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

<div class="page-header">
  <h5><img src="<?= Yii::$app->params['frontendUrl'] ?>/images/lt.png" class="img-circle" width="20" height="20"> 我的论坛 <small class="pull-right"><span class="glyphicon glyphicon-menu-right"></span></small></h5>
</div>

<div class="page-header">
  <h5><img src="<?= Yii::$app->params['frontendUrl'] ?>/images/kc.png" class="img-circle" width="20" height="20"> 我的课程 <small class="pull-right"><span class="glyphicon glyphicon-menu-right"></span></small></h5>
</div>

<div class="page-header">
  <h5><img src="<?= Yii::$app->params['frontendUrl'] ?>/images/fp.png" class="img-circle" width="20" height="20"> 我的发票 <small class="pull-right"><span class="glyphicon glyphicon-menu-right"></span></small></h5>
</div>