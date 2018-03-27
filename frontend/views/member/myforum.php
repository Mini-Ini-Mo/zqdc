<?php
     
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->registerCssFile('css/forum.css');

Yii::$app->name = '我的论坛';
?>

<!-- 精英论坛 -->
<div class="list-box">
    <?php 
        if (!empty($actbminfo)) :
        foreach($actbminfo as $key => $val):
    ?>

    <div class="row forum-item">
        <div class="col-xs-5 col-sm-5 headimgurl">
            <img src="<?php echo \Yii::$app->params['resourceUrl'].$val->activity['thumb'];?>">
        </div>
        <div class="col-xs-7 col-sm-7 forum-item-desc">
            <div class="forum-topical">
                <?php echo $val->activity['topical'];?>
            </div>
            <div class="forum-intro">
                <?php echo mb_substr($val->activity['intro'],0,45,'utf-8');?>
            </div>
        </div> 
        
    </div>
    <?php 
        endforeach;
        endif; 
    ?>

</div>

<nav aria-label="Page navigation" class="text-center">

<?php
echo LinkPager::widget([
    'pagination' => $pagination,
    'options' => ['class' => 'pagination pagination-sm'],
]);
?>
</nav>