<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\components\helper\StringHelper;

$this->registerCssFile('css/forum.css');

$this->registerJsFile('js/expert.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

Yii::$app->name = '我的课程';
    
?>
<!-- 论坛信息-->
<div class="forum-box">
    <div class="forum-info-header"><?php echo $info->topical;?></div>
    <div class="forum-info-body"><?php echo $info->content;?></div>
</div>

<!-- 关联信息 -->
<div class="relevance-block">
    <div class="block-head">
        <p><strong>--主讲嘉宾简介--</strong></p>
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