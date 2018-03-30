<?php
use yii\helpers\Url;

$lessURl =  Url::toRoute(['less']);
$js = <<<JS
    
    $(".less-add").click(function(){
    
        var act_id = $("input[name='act_id']").val();
        var less = $("select[name='less']").val();
        var sort = $("input[name='sort']").val();
        var title = $("input[name='title']").val();
        var time_len = $("input[name='time_len']").val();
        
        if (!less) {
            alert("请选择音视频。");
        }
        
        $.post("$lessURl",{action:'add',act_id:act_id,less:less,sort:sort,title:title,time_len:time_len},function(result){
        
            if (result.code == 200) {
                var _TMP = '<div class="row" style="margin:4px 0px;">'+
                                '<div class="col-xs-6">'+
                                    '<input type="text" class="form-control" disabled="" value="'+result.data['title']+'">'+
                                '</div>'+
                                 '<div class="col-xs-2">'+
                                     '<input type="text" class="form-control" disabled="" value="'+result.data['sort']+'">'+
                                '</div>'+
                                '<div class="col-xs-4">'+
                                    '<button type="button" class="btn btn-danger less-del" data-id="'+result.data['id']+'" >删除</button>'+
                                '</div> '+
                            '</div>';
            
                $(".box-body").append(_TMP);
            } else {
                alert(result.reason);            
            }
        });
    });
    

    //less 删除
    $(document).on("click",".less-del",function(){
            
        var id = $(this).data('id');
        
        $.post("$lessURl",{action:'del',id:id},function(result){
            
            if (result.code == 200) {
                location.reload();
            } else {
                alert(result.reason);
            }
        });
            
            
    }); 
    
JS;
$this->registerJs($js);
?>
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $actinfo['topical'];?></h3>
            </div>
      <div class="box-body">

      <?php 
     
        if (!empty($less)) {  
            foreach ($less as $val) {
       
      ?>
        <div class="row" style="margin:4px 0px;">
            <div class="col-xs-6">
                 <input type="text" class="form-control" disabled="" value="<?php echo $val['title'];?>">
            </div>
            <div class="col-xs-2">
                 <input type="text" class="form-control" disabled="" value="<?php echo $val['sort'];?>">
            </div>
            <div class="col-xs-4">
                <button type="button" class="btn btn-danger less-del" data-id="<?php echo $val['id'];?>" >删除</button>
            </div>
        </div>
        
           <?php 
            }
        }
           ?>   
    
      </div>
      <!-- /.box-body -->
         <form class="form-horizontal">
                <div class="box-footer">
                    
                    <input type="hidden" name="act_id" value="<?php echo $id;?>">
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">选择音视频</label>
                        <div class="col-sm-6">
                      <select class="form-control" name="less">
                            <?php 
                                if (!empty($source)) {
                                    foreach ($source as $item) {
                             
                            ?>
                                <option value="<?php echo $item['file'];?>"><?php echo $item['file_name'];?></option>
                            
                            <?php 

                                }
                            }
                            ?>
                           
                      </select>
                      </div>
                </div>
                
               
                <div class="form-group">
                  <label class="col-sm-2 control-label">名称</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="title" placeholder="名称">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label">时长(分钟)</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="time_len" value="30" placeholder="分钟">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label">排序</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="sort" value='1' placeholder="排序">
                  </div>
                </div>

                <div class="col-xs-12">
                    <button type="button" class="btn btn-primary less-add">添加</button>
                </div> 
         </div>
         </form>
  </div>
    </div>
</div>



