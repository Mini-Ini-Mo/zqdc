<?php
     
use yii\helpers\Url;
use yii\widgets\LinkPager;

Yii::$app->name = '个人资料';
?>
<h5 class="text-center">个人资料</h5>
<!-- <div class="page-header">
  <h6> 头像：
    <span class="pull-right">
        111
    </span>
  </h6>
</div>
<div class="page-header">
  <h6> 微信：
    <span class="pull-right">
        111
    </span>
  </h6>
</div>
<div class="page-header">
  <h6> 行业：
    <span class="pull-right">
        111
    </span>
  </h6>
</div>
<div class="page-header">
  <h6> 职位：
    <span class="pull-right">
        111
    </span>
  </h6>
</div> -->
<?php if($info):?>
<div class="page-header">
  <h6> 手机号：
    <span class="pull-right">
        <?= $info->username;?>
    </span>
  </h6>
</div>
<div class="page-header">
  <h6> 公司名称：
    <span class="pull-right">
        <?= $info->com_name;?>
    </span>
  </h6>
</div>
<div class="page-header">
  <h6> 联系人：
    <span class="pull-right">
        <?= $info->contacts;?>
    </span>
  </h6>
</div>
<?php endif;?>