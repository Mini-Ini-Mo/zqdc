<?php
     
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->registerCssFile('css/lessons.css');

Yii::$app->name = '专题讲座';
?>
<div class="block">
    <div class="text-center"><?php echo $info['topical'];?></div>
    <div style="margin:10px 0px 15px;">
        <img src="https://v3.bootcss.com/assets/img/coding.jpeg" style="width:100%;height:200px;">
    </div>

    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 text-center" style="border-right:1px solid #CCCC33"><a href="<?= Url::toRoute(['view','id'=>3])?>">简介</a></div>
        <div class="col-xs-4 col-sm-4 col-md-4 text-center" style="border-right:1px solid #CCCC33"><a href="">PPT</a></div>
        <div class="col-xs-4 col-sm-4 col-md-4 text-center"><a href="">音频</a></div>
    </div>
</div>

<div class="block" style="margin-top:15px;">

<?php 














?>



</div>
