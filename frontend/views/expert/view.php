<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\components\helper\StringHelper;

$this->registerCssFile('css/expert.css');

$this->registerJsFile('js/expert.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

Yii::$app->name = '新领袖';
    
?>

<!-- 专家信息-->
<div class="expert">

    <div class="expert-top">
        <div class="row expert-base">
            
            <div class="col-xs-12 headimgurl">
                <img src="<?php echo \Yii::$app->params['resourceUrl'].$info->head_img;?>">
                <div class="expert-info">
                    <p style="font-size:16px;font-weight:blod;"><?php echo $info->name;?></p>
                    <div style="margin-top:8px;">
                        <?php echo $info->introduction;?>
                    </div>
                </div>
                <div class="clearfix"></div>
        </div>
        </div>
    </div>
    
    <div class="row expert-bottom">
        <div class="col-xs-3 col-sm-3"><p>阅读 <?php echo $info->read_num;?></p></div>
        <div class="col-xs-3 col-sm-3"><p class="praise-btn" data-url="<?php echo Url::toRoute(['praise', 'id' => $info->id]);?>"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span><span class="praise-box"><?php echo $info->praise_num;?></span></p></div>
        <div class="col-xs-3 col-sm-3"><p>发文   <?php echo $info->post_num;?></p></div>
    </div>
    
</div>


<div class="expert recommend-block">
    
    <div class="block-head">
        <p><strong>精典文章</strong></p>
    </div>
    
    <div class="block-body">
        
        <?php 
            if (!empty($recommend)) :
            foreach($recommend as $key => $val):
        ?>
        <div class="row expert-item" style="margin-top:10px;">
            
            <a href="<?php echo Url::toRoute(['special/view', 'id' => $val['id']]);?>">
                <div class="col-xs-5 col-sm-5 headimgurl">
                    <img src="<?= \Yii::$app->params['resourceUrl'].$val['img']?>">
                </div>
            </a>
            
            <div class="col-xs-7 col-sm-7 expert-item-desc">
                
                <p><?= $val['title']?></p>
                <div><?php echo mb_substr($val['viewpoint'],0,22,'utf-8');?></div>
                <div class="row-2" style="width:90%;">
                    <p class="pull-left">阅读 <?= $val['read_num']?></p>
                    <p class="pull-right"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> <?= $val['praise_num']?></p>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div> 
       
        <?php 
            endforeach;
            endif;
        ?> 

      
    </div>

</div>

