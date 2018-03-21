<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\components\helper\StringHelper;

$this->registerCssFile('css/lessons.css');

Yii::$app->name = '专题讲座';
    
?>
<!-- 论坛信息-->
<div class="forum-box">
    <div class="forum-info-header"><?php echo $info->topical;?></div>
    <div class="forum-info-body"><?php echo $info->content;?></div>
</div>

<!-- 关联信息 -->
<div class="relevance-block">
    <div class="block-head">
        <p><strong>--授课老师简介--</strong></p>
    </div>
    <div class="block-body">
        <?php 
            if (!empty($expert)) :
        ?>
        <div class="row relevance-special">
            <a href="<?php echo Url::toRoute(['expert/view', 'id' => $expert['id']]);?>">
                <div class="col-xs-5 col-sm-5 headimgurl">
                    <img src="<?= \Yii::$app->params['resourceUrl'].$expert['head_img']?>">
                </div>
            </a>
            <div class="col-xs-7 col-sm-7">
                <div><?php echo $expert['introduction'];?></div>
            </div>
        </div> 
        <?php 
            endif;
        ?> 
    </div>
</div>

<?php 
    //判断活动是否结束
    $act_begin_time = strtotime($info->act_begin_time); 
    $act_end_time = strtotime($info->act_end_time);
    $now = time();
    if ($now < $act_end_time) {
?>
<!-- 我要报名 -->
<div class="row forum-baoming">
    <div class="col-xs-3 col-md-3"></div>
    <div class="col-xs-6 col-md-6" style="text-align:center;margin-top:20px;">
        <a class="btn btn-baoming"  href="<?php echo Url::toRoute(['lessons/baoming', 'id' => $info->id]);?>">我要报名</a>
    </div>
</div>
<?php 
    }
?>


