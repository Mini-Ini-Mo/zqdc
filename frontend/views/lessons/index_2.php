<?php
     
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->registerCssFile('css/lessons_2.css');

Yii::$app->name = '中清筑道';
?>

<!-- 课程分类 -->
<div class="block">
    <div class="row lessons-class">
    <?php 
        foreach ($cate as $val) {
    ?>
    <div class="col-xs-4 col-sm-4 lesson-cate"><a href="<?php echo Url::toRoute(['index','less_cate'=>$val['id']])?>"><span class="lessons-icon"></span><?php echo $val['name'];?></a></div>
    <?php 
        }
    ?>
    <div class="col-xs-4 col-sm-4 lesson-cate"><a href="<?php echo Url::toRoute(['index'])?>"><span class="lessons-icon"></span>全部</a></div>
    </div> 
</div>

<!-- 课程列表 -->
<div class="row lessons-item">
    
    <?php 
        if (!empty($list)) {
            foreach ($list as $val) {
    ?>
    <div class="col-xs-12 col-sm-6 col-md-4" style="margin-bottom:15px;">
        <a href="<?php echo Url::toRoute(['lessons/view','id'=>$val->id]);?>"><img src="<?php echo \Yii::$app->params['resourceUrl'].$val->thumb;?>" alt="" class="img-rounded" style="width:100%;height:200px;"></a>
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

