<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\components\helper\StringHelper;
use yii\web\Request;

$this->registerCssFile('css/lessons_2.css');

$request = Yii::$app->getRequest();
$lessID = $request->get('id',0);
$vid = $request->get('vid',1);

$resourceUrl = \Yii::$app->params['resourceUrl'];

$js = <<<JS
    player= document.getElementById('audio');
    
    $(".video-one-a").click(function(){
    
        player.src = "$resourceUrl"+$(this).data('src');
        $(".video-one-a").removeClass('video-active');
        $(this).addClass('video-active');
        player.play();
    
    });
    
    $(".video-one-a:first").click();
    
   
JS;

$this->registerJs($js);

Yii::$app->name = '专题讲座';
    
?>
<div class="block">
    <div class="text-center"><?php echo $info['topical'];?></div>
    <div style="margin:10px 0px 15px;">
        <img src="<?php echo \Yii::$app->params['resourceUrl'].$info['thumb']?>" style="width:100%;height:200px;">
    </div>

    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 text-center" style="border-right:1px solid #CCCC33"><a href="<?= Url::toRoute(['view','id'=>$info['id']])?>">简介</a></div>
        <div class="col-xs-4 col-sm-4 col-md-4 text-center" style="border-right:1px solid #CCCC33"><a href="">PPT</a></div>
        <div class="col-xs-4 col-sm-4 col-md-4 text-center"><a href="<?= Url::toRoute(['voice','id'=>$info['id']])?>">音频</a></div>
    </div>
</div>

<div class="block" style="margin-top:15px;">
    
    <div class="base-info" style="">
        <audio src="song.ogg" controls="controls" style="width:100%;" id="audio">
                    您的浏览器不支持播放音频
        </audio>
    </div>
    
    <div class="video-info" style="margin:10px 0px 20px;">
        <div class="video-info-title" style="margin:10px 0px;">
            <p class="" style="font-size:16px;color:#222;border-left:2px #cc3 solid;padding-left:5px;">播放列表</p>
        </div>

        <div class="video-info-lib">
            <?php 
                if (!empty($less)) {
                    foreach ($less as $val) {
            ?>
            <a class="video-one-a" href="javascript:void(0);" data-src="<?php echo $val['addr'];?>" style="height:30px;padding:5px;background:#fafafa;display:inline-block;width:100%;height:100%;">
                <span class="pull-left"><?php echo $val['title'];?></span>
                <span class="pull-right"><?php echo $val['time_len'];?>分钟</span>
                <div class="clearfix"></div>
            </a>
            
            <?php 
                }
            }
            ?>

        </div>
        
    </div>
    
</div>

