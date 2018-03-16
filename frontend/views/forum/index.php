<?php
     
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->registerCssFile('css/forum.css');

Yii::$app->name = '精英论坛';
?>

<!-- 精英论坛 -->
<div class="list-box">
    <?php 
        if (!empty($list)) :
        foreach($list as $key => $val):
    ?>

    <div class="row forum-item">
        <a href="<?php echo Url::toRoute(['view', 'id' => $val->id]);?>">
            <div class="col-xs-5 col-sm-5 headimgurl">
                <img src="<?php echo \Yii::$app->params['resourceUrl'].$val->thumb;?>">
            </div>
        </a>
        <div class="col-xs-7 col-sm-7 forum-item-desc">
            <div class="forum-topical">
                <?php echo $val->topical;?>
            </div>
            <div class="forum-intro">
                <?php echo mb_substr($val->intro,0,45,'utf-8');?>
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


