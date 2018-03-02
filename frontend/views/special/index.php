<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->registerCssFile('css/expert.css');

$this->title = '专题';
?>


<div class="row bg-white" id="server_index">
	<div class="col-xs-12">
		<div class="table-responsive">
			<table class="table">
				<tr>
					
					<?php foreach($cates as $k=>$a):?>
					<td class="<?php //if($cid == $k){echo 'in';}?>"><a href="<?php //echo $this->createUrl('jihua',array('cid'=>$k,'gid'=>$gid))?>#server_index"><?php echo $a;?></a></td>
					<?php endforeach;?>
				</tr>
			</table>
		</div>
	</div>
</div>
	
<div class="expert">
    
    <?php 
        if ($list) :
        foreach($list as $key => $val):
    ?>
    
    <div class="row expert-item">
        <a href="<?php echo Url::toRoute(['view', 'id' => $val->id]);?>">
            <div class="col-xs-5 col-sm-5 headimgurl">
                <img src="<?php echo \Yii::$app->params['resourceUrl'].$val->img;?>">
            </div>
        </a>
        <div class="col-xs-7 col-sm-7 expert-item-desc">
            <div class="row-1">
                <p class="pull-left"><?php echo $val->title;?></p>
                <div class="clearfix"></div>
            </div>
            <div class="row-1">
                <p class="pull-left"><?php echo $val->introduction;?></p>
                <div class="clearfix"></div>
            </div>
            <div class="row-2">
                <p class="pull-right"><?php echo $val->created_at;?></p>
                <div class="clearfix"></div>
            </div>
        </div> 
    </div>
    
    <?php 
        endforeach;
        endif;
    ?>

</div>

<nav aria-label="Page navigation" class="text-center">

<?php
echo LinkPager::widget([
    'pagination' => $pagination,
    'options' => ['class' => 'pagination pagination-sm'],
]);
?>
</nav>