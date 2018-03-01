<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->registerCssFile('css/expert.css');

$this->registerJsFile('js/expert.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
    
?>

<!-- 专家信息-->
<div class="expert">

    <div class="expert-top">
        <div class="row expert-base">
            <div class="col-xs-5 col-sm-5 headimgurl">
                <img src="<?php echo \Yii::$app->params['resourceUrl'].$info->head_img;?>">
            </div>
            <div class="col-xs-7 col-sm-7">
                <p><?php echo $info->name;?></p>
            </div>
        </div>
        
        <div class="row expert-info">
            <div class="col-xs-12 col-sm-12">
                <?php echo $info->introduction;?>
            </div>
        </div>
    </div>
    
    <div class="row expert-bottom">
        <div class="col-xs-3 col-sm-3"><p>阅读 <?php echo $info->read_num;?></p></div>
        <div class="col-xs-3 col-sm-3"><p class="praise-btn" data-url="<?php echo Url::toRoute(['praise', 'id' => $info->id]);?>">点赞   <?php echo $info->praise_num;?></p></div>
        <div class="col-xs-3 col-sm-3"><p>发文   <?php echo $info->post_num;?></p></div>
    </div>
    
</div>

<div class="expert recommend-block">
    
    <div class="block-head">
        <p><strong>精典文章</strong></p>
    </div>
    
    <div class="block-body">
        
        <div class="row expert-item" style="margin-top:10px;">
            <div class="col-xs-5 col-sm-5 headimgurl">
                <img src="https://t11.baidu.com/it/u=3190383520,3564931388&fm=173&s=BB22E10526A05317D10F5C9C0300C0A2&w=639&h=399&img.JPEG">
            </div>
            <div class="col-xs-7 col-sm-7 expert-item-desc">
                
                <p>专家名称</p>
                <div>简要简要简要简要简要简要简要简要</div>
                <div class="row-2">
                    <p class="pull-left">阅读 2000</p>
                    <p class="pull-right">点赞   1533</p>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div> 

      
    </div>

</div>

