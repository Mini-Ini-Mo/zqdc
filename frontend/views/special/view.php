<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->registerCssFile('css/expert.css');

$this->registerJsFile('js/expert.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
    
?>

<div class="expert">
    <p><strong>--大佬简介--</strong></p>
    <div class="row expert-item" style="margin-top:10px;border-bottom: none;">
        <div class="col-xs-5 col-sm-5 headimgurl">
            <img src="https://t11.baidu.com/it/u=3190383520,3564931388&fm=173&s=BB22E10526A05317D10F5C9C0300C0A2&w=639&h=399&img.JPEG">
        </div>
        <div class="col-xs-7 col-sm-7 expert-item-desc">
            <div>简要简要简要简要简要简要简要简要</div>
        </div>
    </div>
    
    <p><strong>--人物观点--</strong></p>
    <div class="expert-top" style="margin-top:10px;">
        <div class="row expert-base">
            <div class="col-xs-7 col-sm-7">
                <p><?php echo $info->viewpoint;?></p>
            </div>
        </div>
    </div>
    
    <div class="block-head"></div>
    
    <p><strong>--观点解析--</strong></p>
    <div class="expert-top" style="margin-top:10px;">
        <div class="row expert-base">
            <div class="col-xs-7 col-sm-7">
                <p><?php echo $info->analysis;?></p>
            </div>
        </div>
    </div>
    
    <div class="row expert-bottom">
        <div class="col-xs-3 col-sm-3"><p>阅读 <?php echo $info->read_num;?></p></div>
        <div class="col-xs-3 col-sm-3"><p class="praise-btn" data-url="<?php echo Url::toRoute(['praise', 'id' => $info->id]);?>">点赞   <?php echo $info->praise_num;?></p></div>
        <div class="col-xs-3 col-sm-3"><p>发文   <?php //echo $info->post_num;?></p></div>
    </div>
    
</div>