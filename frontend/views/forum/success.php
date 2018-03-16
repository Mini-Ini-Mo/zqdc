<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">报名信息确认！</h3>
  </div>
  <div class="panel-body">
    <p>参课单位：<?php echo $baoming->company;?></p>
    <p>企业联系人：<?php echo $baoming->contacts;?></p>
    <p>职位：<?php echo $baoming->position;?></p>
    <p>手机号：<?php echo $baoming->phone;?></p>
    <p>学员人数：<?php echo $baoming->join_num;?>人</p>
    <p>总费用：<?php echo ($baoming->join_num * 200);?>元</p>
  
  </div>
  
  <div class="panel-footer" style="background-color: #fff;border-top: 0px;">
    <button type="button" class="btn btn-primary btn-sm">确认支付</button>
  </div>
</div>