<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\components\helper\StringHelper;
use yii\web\Request;
use Symfony\Component\Finder\Comparator\DateComparator;

$this->registerCssFile('css/lessons_2.css');

Yii::$app->name = '专题讲座';
    
?>
<div class="block">
    <div style="margin:10px 0px 15px;">
        <img src="<?php echo \Yii::$app->params['resourceUrl'].$info['thumb']?>" style="width:100%;height:200px;">
    </div>
</div>

<div class="block" style="margin-top:15px;">
    <table class="table">
         <tr>
            <td>游学地点：</td>
            <td><?php echo $info['destination'];?></td>
        </tr>
        <tr>
            <td>游学时间：</td>
            <td><?php echo date("Y-m-d",strtotime($info['begin_time']));?></td>
        </tr>
        <tr>
            <td>游学天数：</td>
            <td><?php echo $info['days'];?>&nbsp;天</td>
        </tr>
        
        <tr>
            <td>游学学费：</td>
            <td><?php echo $info['cost'];?></td>
        </tr>
        <tr>
            <td colspan="2">游学简介：</td>
        </tr>
        <tr>
            <td colspan="2"><?php echo $info['intro'];?></td>
        </tr>
        <tr>
            <td colspan="2">游学详情：</td>
        </tr>
        <tr>
            <td colspan="2" class="study-abroad-content"><?php echo $info['content'];?></td>
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

