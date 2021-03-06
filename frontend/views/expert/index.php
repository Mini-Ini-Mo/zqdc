<?php
     
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->registerCssFile('css/expert.css');

Yii::$app->name = '新领袖';
?>

<!-- 新领袖 -->
<div class="expert">
    
    <?php 
        if (!empty($list)) :
        foreach($list as $key => $val):
    ?>

    <div class="row expert-item">
        <a href="<?php echo Url::toRoute(['view', 'id' => $val->id]);?>">
            <div class="col-xs-5 col-sm-5 headimgurl">
                <img src="<?php echo \Yii::$app->params['resourceUrl'].$val->head_img;?>">
            </div>
        </a>
        <div class="col-xs-7 col-sm-7 expert-item-desc">
            <div class="row-1">
                <p class="pull-left"><h4><?php echo $val->name;?></h4></p>
                <p class="pull-left"><?php echo $val->position;?></p>
                <div class="clearfix"></div>
            </div>
            <div class="row-2">
                <p class="tags">阅读 <?php echo $val->read_num;?></p>
                <p class="tags" style="width:30%;">发文   <?php echo $val->post_num;?></p>
                <p class="tags" style="width:34%;"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>   <?php echo $val->praise_num;?></p>
                <div class="clearfix"></div>
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


