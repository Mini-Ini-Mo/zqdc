<?php
     
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->registerCssFile('css/lessons_2.css');

Yii::$app->name = '中清博纳';
?>

<!-- 课程分类 -->
<div class="block">
    <div class="row lessons-class">
    <?php 
        foreach ($cate as $val) {
    ?>
    <div class="col-xs-4 col-sm-4 lesson-cate"><a href="<?php echo Url::toRoute(['offline','less_cate'=>$val['id']])?>"><span class="lessons-icon"></span><?php echo $val['name'];?></a></div>
    <?php 
        }
    ?>
    <div class="col-xs-4 col-sm-4 lesson-cate"><a href="<?php echo Url::toRoute(['offline'])?>"><span class="lessons-icon"></span>全部</a></div>
    </div> 
</div>

<div>
    <p style="height:40px;line-height:40px;">热门课程</p>
</div>


<!-- 课程列表 -->
<div class="row lessons-item">
    
    <?php 
        if (!empty($list)) {
            foreach ($list as $val) {
    ?>
    <div class="col-xs-6 col-sm-6 col-md-4" style="padding-left:8px;padding-right:8px;margin-bottom:15px;">
        <a href="<?php echo Url::toRoute(['lessons/voffline','id'=>$val->id]);?>"><img src="<?php echo \Yii::$app->params['resourceUrl'].$val->thumb;?>" alt="" class="img-rounded" style="width:100%;height:100px;"></a>
        <p style="height:30px;line-height:30px;"><?php echo $val->topical;?></p>
        <div>
            <p class="pull-left"><?php echo $val->addr;?></p>
            <p class="pull-right"><?php echo date('Y-m-d',strtotime($val->act_begin_time));?></p>
            <div class="clearfix"></div>
        </div>
        
    </div>
    <?php 
        }
    }
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

