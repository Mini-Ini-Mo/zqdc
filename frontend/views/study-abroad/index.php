<?php
     
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->registerCssFile('css/lessons_2.css');

Yii::$app->name = '中清游学';
?>



<!-- 课程列表 -->
<div class="row lessons-item" style="margin:0px;">
    
    <?php 
        if (!empty($list)) {
            foreach ($list as $val) {
    ?>
    <div class="col-xs-12 col-sm-6 col-md-4" style="margin-bottom:15px;padding:0px 0px 6px;border-radius:6px;display:inline-block;border:1px solid #ccc;">
        <a href="<?php echo Url::toRoute(['view','id'=>$val->id]);?>"><img src="<?php echo \Yii::$app->params['resourceUrl'].$val->thumb;?>" alt="" class="img-rounded" style="width:100%;height:120px;"></a>
        <div style="margin-top:10px;">
            <span style="margin-left:10px;"><span class="glyphicon glyphicon-plane" aria-hidden="true"></span>&nbsp;<?php echo $val->destination?>游学</span>
            <span style="margin-left:10px;"><span class="glyphicon glyphicon-time" aria-hidden="true"></span>&nbsp;<?php echo date('Y-m-d',strtotime($val->begin_time))?></span>
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

