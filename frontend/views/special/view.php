<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Expert;

$this->registerCssFile('css/expert.css');

$this->registerJsFile('js/expert.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
    
?>

<div class="expert">
    <p><strong>--大佬简介--</strong></p>
    <div class="row expert-item" style="margin-top:10px;border-bottom: none;">
        <div class="col-xs-5 col-sm-5 headimgurl">
            <img src="<?php echo \Yii::$app->params['resourceUrl'].Expert::getExpertInfo( $info->expert_id,'head_img');?>">
        </div>
        <div class="col-xs-7 col-sm-7 expert-item-desc" style="word-wrap:break-word;height:auto;">
            <?php echo mb_substr(Expert::getExpertInfo( $info->expert_id,'introduction'),0,50,'utf-8');?>
        </div>
    </div>
    
    <p><strong>--人物观点--</strong></p>
    <div class="expert-top" style="margin-top:10px;">
         <?php echo $info->viewpoint;?>
    </div>
    
    <div class="block-head"></div>
    
    <p><strong>--观点解析--</strong></p>
    <div class="expert-top" style="margin-top:10px;overflow: hidden;padding:5px">
        <?php echo $info->analysis;?>
    </div>
    
    <div class="row expert-bottom">
        <div class="col-xs-3 col-sm-3"><p>阅读 <?php echo $info->read_num;?></p></div>
        <div class="col-xs-3 col-sm-3">
            <p class="praise-btn" data-url="<?php echo Url::toRoute(['praise', 'id' => $info->id]);?>">
            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
            <span class="praise-box"><?php echo $info->praise_num;?></span>
            </p>
        </div>
        <div class="col-xs-3 col-sm-3"><p></p></div>
    </div>
    
</div>
