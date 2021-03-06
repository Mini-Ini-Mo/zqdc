<?php
     
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->registerCssFile('css/lessons.css');

Yii::$app->name = '我的课程';
?>

<h5 class="text-center">我的课程</h5>

<div class="list-box">

    <?php if (!empty($xs_actinfo)) :?>
    <h4 class="title">线上筑道 
        <a href="<?php echo Url::toRoute(['lessonslist', 'type' => 3]);?>">
            <small class="pull-right glyphicon glyphicon-option-horizontal"></small>
        </a>
    </h4>
    <?php foreach($xs_actinfo as $key => $val):?>
    <div class="row forum-item">
        <div class="col-xs-5 col-sm-5 headimgurl">
            <a href="<?php echo Url::toRoute(['lessonsview', 'id' => $val->activity['id']]);?>">
                <img src="<?php echo \Yii::$app->params['resourceUrl'].$val->activity['thumb'];?>">
            </a>
        </div>
        <div class="col-xs-7 col-sm-7 forum-item-desc">
            <div class="forum-topical">
                <?php echo $val->activity['topical'];?>
            </div>
            <div class="forum-intro">
                <?php echo $val->activity['intro'];?>
            </div>
            <div class="lessons-status">
                <p>开课时间：<?php echo $val->activity['act_end_time'];?></p>
            </div>
        </div> 
        
    </div>
    <?php endforeach;?>
    <?php endif;?>
    
    <?php if (!empty($xx_actinfo)) :?>
    <h4 class="title">线下博纳 
        <a href="<?php echo Url::toRoute(['lessonslist', 'type' => 4]);?>">
            <small class="pull-right glyphicon glyphicon-option-horizontal"></small>
        </a>
    </h4>
    <?php foreach($xx_actinfo as $key => $val):?>
    <div class="row forum-item">
        <div class="col-xs-5 col-sm-5 headimgurl">
            <a href="<?php echo Url::toRoute(['lessonsview', 'id' => $val->activity['id']]);?>">
                <img src="<?php echo \Yii::$app->params['resourceUrl'].$val->activity['thumb'];?>">
            </a>
        </div>
        <div class="col-xs-7 col-sm-7 forum-item-desc">
            <div class="forum-topical">
                <?php echo $val->activity['topical'];?>
            </div>
            <div class="forum-intro">
                <?php echo $val->activity['intro'];?>
            </div>
            <div class="lessons-status">
                <p>开课时间：<?php echo $val->activity['act_end_time'];?></p>
            </div>
        </div> 
        
    </div>
    <?php endforeach;?>
    <?php endif;?>
    
    <?php if (!empty($kc_actinfo)) :?>
    <h4 class="title">游学课程 
        <a href="<?php echo Url::toRoute(['lessonslist', 'act_type' => 2]);?>">
            <small class="pull-right glyphicon glyphicon-option-horizontal"></small>
        </a>
    </h4>
    <?php foreach($kc_actinfo as $key => $val):?>
    <div class="row forum-item">
        <div class="col-xs-5 col-sm-5 headimgurl">
            <a href="<?php echo Url::toRoute(['lessonsview', 'id' => $val->activity['id']]);?>">
                <img src="<?php echo \Yii::$app->params['resourceUrl'].$val->activity['thumb'];?>">
            </a>
        </div>
        <div class="col-xs-7 col-sm-7 forum-item-desc">
            <div class="forum-topical">
                <?php echo $val->activity['topical'];?>
            </div>
            <div class="forum-intro">
                <?php echo $val->activity['intro'];?>
            </div>
            <div class="lessons-status">
                <p>开课时间：<?php echo $val->activity['act_end_time'];?></p>
            </div>
        </div> 
        
    </div>
    <?php endforeach;?>
    <?php endif;?>
    
    <?php if (!empty($lt_actinfo)) :?>
    <h4 class="title">论坛课程 
        <a href="<?php echo Url::toRoute(['lessonslist', 'act_type' => 1]);?>">
            <small class="pull-right glyphicon glyphicon-option-horizontal"></small>
        </a>
    </h4>
    <?php foreach($lt_actinfo as $key => $val):?>
    <div class="row forum-item">
        <div class="col-xs-5 col-sm-5 headimgurl">
            <a href="<?php echo Url::toRoute(['lessonsview', 'id' => $val->activity['id']]);?>">
                <img src="<?php echo \Yii::$app->params['resourceUrl'].$val->activity['thumb'];?>">
            </a>
        </div>
        <div class="col-xs-7 col-sm-7 forum-item-desc">
            <div class="forum-topical">
                <?php echo $val->activity['topical'];?>
            </div>
            <div class="forum-intro">
                <?php echo $val->activity['intro'];?>
            </div>
            <div class="lessons-status">
                <p>开课时间：<?php echo $val->activity['act_end_time'];?></p>
            </div>
        </div> 
        
    </div>
    <?php endforeach;?>
    <?php endif;?>
</div>

<!-- <nav aria-label="Page navigation" class="text-center">
<?php
/*echo LinkPager::widget([
    'pagination' => $pagination,
    'options' => ['class' => 'pagination pagination-sm'],
]);*/
?>
</nav> -->