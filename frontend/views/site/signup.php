<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */
/*<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
 *<?= $form->field($model, 'email') ?>*/

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\components\helper\StringHelper;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;

$this->title = '注册';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('css/baoming.css');
$fieldOptions1 = [
    'options' => ['class'=>'form-group'],
    'labelOptions'=>['class'=>'col-xs-3 control-label text-right baoming-option'],
    'inputOptions'=>['class'=>'form-control'],
    'errorOptions'=>['class'=>'help-block col-xs-offset-3 baoming-error'],
    'template' => '{label}<div class="col-xs-9">{input}</div><div class="clearfix"></div>{hint}{error}'
];


//注册返回事件
$js = <<<JS

    var button = $(".getcaptcha");

    //获取校验码
    $(".getcaptcha").click(function(){
    
        var phone = $(".username").val();
        var flg = true;

	   if(jQuery(this).hasClass('clicked'))return;//按钮灰色不可点击

       if(isEmpty(phone)||!isMobile(phone)){
            flg = false;
            $(this).closest(".form-group").addClass("has-error");
            $(this).parent().siblings(".help-block").html('请填写可用手机号码！');
            return;
       }else{
            $(this).closest(".form-group").removeClass("has-error");
            $(this).closest(".form-group").addClass("has-success");
    	    $(this).parent().siblings(".help-block").html('');
       }

       if(flg){
            //发送验证Ajax
    	   jQuery.post('index.php?r=site/sms',{mobile:phone},function(results){

                //var data = jQuery.parseJSON(results);
                console.log(results);
                if(results.code == 200){
					//发送成功时改变按钮状态
					changeButtonStatus();
                }else{
                    $(this).closest(".form-group").addClass("has-error");
                    $(this).parent().siblings(".help-block").html('请填写可用手机号码！');
                }
            });
        }

    });
    var timelyInterval;
    //发送成功时改变按钮状态
    function changeButtonStatus(){
        button.html('60秒后重新发送');
        button.addClass('clicked');
        timelyInterval = window.setInterval("timelyFun()",1000);
    }

    window.timelyFun = function(){
        var mis = parseInt(button.html());

        //alert(mis);
        if(mis-1>=0)
            button.html((mis-1)+'秒后重新发送');
        else{
            button.removeClass('clicked').html('发送验证码');
            //清除执行
            if(timelyInterval!=null)clearInterval(timelyInterval);
        }
    }



    function isEmpty (val)
    {
      switch (typeof(val))
      {
        case 'string':
          return trim(val).length == 0 ? true : false;
          break;
        case 'number':
          return val == 0;
          break;
        case 'object':
          return val == null;
          break;
        case 'array':
          return val.length == 0;
          break;
        default:
          return true;
      }
    }

    function isMobile (mobile)
    {
        var reMobile = /^1[3|4|7|5|8][0-9]\d{4,8}$/;
        return reMobile.test(mobile);
    }


    function trim (text)
    {
      if (typeof(text) == "string")
      {
        return text.replace(/^\s*|\s*$/g, "");
      }
      else
      {
        return text;
      }
    }

JS;

$this->registerJs($js);
?>
<div class="site-signup">
    <h3><?= Html::encode($this->title) ?></h3>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'com_name',$fieldOptions1)->textInput(['placeholder'=>"请输入企业名称"]) ?>
                
                <?= $form->field($model, 'contacts',$fieldOptions1)->textInput(['placeholder'=>"请输入联系人"]) ?>
                
                <div class="form-group">
                    <label for="phone" class="col-xs-3 control-label text-right baoming-option">手机号</label>
                    <?= $form->field($model, 'username',['options'=>['class'=>'col-xs-5'],'inputOptions' =>['class' => 'form-control username'],'template' => '{input}'])->textInput(['placeholder'=>"请输入联系人手机号"]) ?>
                    <div class="col-xs-4" style="padding-left:0px;">
                        <button type="button" class="btn btn-sm getcaptcha">发送验证码</button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="help-block col-xs-offset-3 baoming-error"></div>
                </div>
                <?= $form->field($model, 'captcha',$fieldOptions1)->textInput(['placeholder'=>"请输入验证码"]) ?>

                <?= $form->field($model, 'password',$fieldOptions1)->passwordInput() ?>
                
                <?= $form->field($model, 'confirmpd',$fieldOptions1)->passwordInput() ?>

                <div class="form-group text-center">
                    <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
