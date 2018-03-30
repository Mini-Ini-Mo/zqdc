<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\components\helper\StringHelper;
use yii\web\Request;

$this->registerCssFile('css/lessons_2.css');

Yii::$app->name = '专题讲座';
    
?>
<div class="block">
    <div class="text-center"><?php echo $info['topical'];?></div>
    <div style="margin:10px 0px 15px;">
        <img src="<?php echo \Yii::$app->params['resourceUrl'].$info['thumb']?>" style="width:100%;height:200px;">
    </div>
</div>

<div class="block" style="margin-top:15px;">
    <table class="table">
        <tr>
            <td>时间</td>
            <td><?php echo $info['act_begin_time'];?></td>
        </tr>
         <tr>
            <td>地点</td>
            <td><?php echo $info['addr'];?></td>
        </tr>
        <tr>
            <td>学习学费</td>
            <td><?php echo $info['cost'];?></td>
        </tr>
        <tr>
            <td colspan="2">课程简介</td>
        </tr>
        <tr>
            <td colspan="2"><?php echo $info['content'];?></td>
        </tr>
        <tr>
            <td colspan="2" class="text-center"><a class="btn btn-info btn-sm" style="color:#fff;width:100%;" href="<?= Url::toRoute(['baoming','id'=>$info['id']])?>">我要报名</a></td>
        </tr> 
    </table>
</div>

<?php 
    if (!empty($plist)) {
?>
<div class="block" style="margin-top:15px;">
    <?php 
        if (!empty($plist['prev'])) {
    ?>
    <div><a href="<?php echo Url::toRoute(['voffline','id'=>$plist['prev']['id']])?>" style="display:inline-block;height:28px;line-height:28px;">上一个：<?php echo $plist['prev']['topical'];?></a></div>
    <?php 
        }
    ?>
    <?php 
        if (!empty($plist['next'])) {
    ?>
    <div><a href="<?php echo Url::toRoute(['voffline','id'=>$plist['next']['id']])?>" style="display:inline-block;height:28px;line-height:28px;">下一个：<?php echo $plist['next']['topical'];?></a></div>
    <?php 
        }
    ?>
</div>

<?php 
    }
?>

