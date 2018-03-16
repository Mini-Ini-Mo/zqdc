<?php
     
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->registerCssFile('css/lessons.css');

Yii::$app->name = '专题讲座';
?>

<?php 
    if (!empty($list)) :
?>
<div class="block-head">
    <p><strong>--课程预告--</strong></p>
</div>

<div class="list-box">
    <?php 
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
                <?php echo $val->intro;?>
            </div>
            <div class="lessons-status">
                <p>开课时间：<?php echo $val->act_end_time;?></p>
            </div>
        </div> 
        
    </div>
    <?php 
        endforeach;
    ?>
</div>
<?php 
    endif;
?>

<nav aria-label="Page navigation" class="text-center">
<?php
echo LinkPager::widget([
    'pagination' => $pagination,
    'options' => ['class' => 'pagination pagination-sm'],
]);
?>
</nav>

<div class="relevance-block">
    <?php 
        if (!empty($history)) :
    ?>
    <div class="block-head">
        <p><strong>--往期回顾--</strong></p>
    </div>
    
    <div class="list-box">
    <?php 
        foreach($history as $key => $val):
    ?>

    <div class="row forum-item">
        <a href="<?php echo Url::toRoute(['view', 'id' => $val['id']]);?>">
            <div class="col-xs-5 col-sm-5 headimgurl">
                <img src="<?php echo \Yii::$app->params['resourceUrl'].$val['thumb'];?>">
            </div>
        </a>
        <div class="col-xs-7 col-sm-7 forum-item-desc">
            <div class="forum-topical">
                <?php echo $val['topical'];?>
            </div>
            <div class="forum-intro">
                <?php echo $val['intro'];?>
            </div>
            <div class="lessons-status">
                <p>发布时间：<?php echo date('Y-m-d H:00',$val['created_at']);?></p>
            </div>
        </div> 
        
    </div>
    <?php 
        endforeach;
    ?>
</div>
<?php 
    endif;
?>
</div>


