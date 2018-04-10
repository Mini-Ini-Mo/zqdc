<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\components\helper\StringHelper;
use yii\web\Request;

$this->registerCssFile('css/lessons_2.css');

$this->registerCssFile('status/swiper/dist/css/swiper.min.css',['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('status/swiper/dist/js/swiper.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$resourceUrl = \Yii::$app->params['resourceUrl'];

$js = <<<JS

    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 3,
        spaceBetween: 10,
    });

    var player = document.getElementById("player");
    
    $(".video-one-a").click(function(){
    
        player.src = "$resourceUrl"+$(this).data('src');
        $(".video-one-a").removeClass('video-active');
        $(this).addClass('video-active');
        player.play();
    
    });
    
    //初始化
    function PlayInit()
    {
        player.src = "$resourceUrl"+$(".video-one-a:first").data('src');
        $(".video-one-a:first").addClass('video-active');
        player.autoplay=false;
        /*   
        player.oncanplay = function (){
            player.play();
        };
        */
    }
            
    if ($(".video-one-a").length > 0) {
         PlayInit();   
    }
    

JS;

$this->registerJs($js);

Yii::$app->name = '中清筑道';
    
?>
<div class="block">
    <div class="text-center"><?php echo $info['topical'];?></div>
    
    <video width="100%" height="230" controls id='player' style="margin:10px 0px 15px;">
        <source src="" type="video/mp4">您的浏览器不支持 视频播放。
    </video>
    
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 text-center" style="border-right:1px solid #CCCC33">
            <a href="<?= Url::toRoute(['view','id'=>$info['id']])?>">简介</a>
        </div>
        
        <div class="col-xs-4 col-sm-4 col-md-4 text-center" style="border-right:1px solid #CCCC33"><a href="">PPT</a></div>
        <div class="col-xs-4 col-sm-4 col-md-4 text-center"><a href="<?= Url::toRoute(['voice','id'=>$info['id']])?>">音频</a></div>
    </div>
</div>

<div class="block" style="margin-top:10px;">
    <div class="base-info" style="margin-bottom:10px;">
        <div class="pull-left">
            <p style="font-weight:bold;height:24px;line-height:24px;"><?php echo $info['position'];?></p>
            <p style="height:24px;line-height:24px;"><?php echo $info['name'];?></p>
        </div>
        <div class="pull-right" style="font-size:12px;">
            <a href="<?php echo Url::toRoute(['expert/view','id'=>$info['expert_id']])?>">更多</a>
        </div>
        <div class="clearfix"></div>
    </div>
    
    <!-- 资源 -->
    <?php 
        if (!empty($less)) {
    ?>
    <div class="video-info" style="margin: 20px 0px;">
        <div class="video-info-title" style="margin:10px 0px;">
            <p class="pull-left" style="font-size:16px;color:#222;">选集播放</p>
            <p class="pull-right" style="font-size:12px;color:#888;">总共<?php echo count($less);?>集</p>
            <div class="clearfix"></div>
        </div>

        <div class="video-info-lib">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                <?php 
                    foreach ($less as $val) {
                ?>
                  <div class="swiper-slide video-one" style="height:70px;padding:5px;background:#fafafa;">
                    <a class="video-one-a" href="javascript:void(0);" data-src="<?php echo $val['addr'];?>" style="display:inline-block;width:100%;height:100%;"><?php echo $val['title'];?><br/><?php echo $val['time_len'];?>分钟</a>
                  </div>
                <?php 
                    }
                ?>   
                 </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
          </div>
        </div>
    </div>
    
    <?php 
        }
    ?>
    
    
    
    <!-- 推荐 -->
    <?php 
        if (!empty($recommend)) {
    ?>
    <div class="like-block">
        <div class="video-info-title" style="font-size:16px;color:#222;margin:10px 0px;border-left:2px #cc3 solid;padding-left:5px;">猜你喜欢</div>
        
        <div class="like-recommend">    
        <?php 
            foreach ($recommend as $val) {
        ?>
        <div class="media">
            <div class="media-left">
                <a href="<?php echo Url::toRoute(['view','id'=>$val['id']])?>">
                    <img class="media-object" style="width:100px;" src="<?php echo \Yii::$app->params['resourceUrl'].$val['thumb'];?>" alt="<?php echo $val['topical']?>">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $val['topical']?></h4>
            </div>
        </div>
        <?php 
            }
        ?>
          </div> 
    </div>
    <?php 
        }
    ?>
</div>

