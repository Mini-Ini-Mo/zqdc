<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\ActBaoming;
use common\models\Smslog;

/**
 * This is the model class for table "zq_act_baoming".
 *
 * @property string $id 主键
 * @property string $company 参会公司
 * @property string $contacts 联系人
 * @property string $position 职位
 * @property string $phone 手机号
 * @property int $join_num 参会人数
 * @property string $created_at 报名时间
 * @property string $remark 备注
 * @property int $act_id 活动id
 */
class LessonsForm extends Model
{
    public $company;
    public $contacts;
    public $position;
    public $phone;
    public $join_num;
    public $act_id;
    public $captcha;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company', 'contacts', 'position', 'phone', 'join_num', 'act_id','captcha'], 'required'],
            [['join_num', 'act_id','captcha'], 'integer'],
            [['company'], 'string', 'max' => 60],
            [['act_id'], 'integer', 'min' => 1],
            [['contacts', 'position'], 'string', 'max' => 40],
            [['phone'], 'string', 'max' => 11],
            ['captcha','checkCaptcha']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company' => '参课单位',
            'contacts' => '企业联系人',
            'position' => '职位',
            'phone' => '手机号',
            'join_num' => '参课人数',
            'act_id' => '课程',
            'captcha'=>'验证码',
        ];
    }
    
    public function baoming()
    {   
        if ($this->validate() && !$this->hasbaoming()) {
            
            $baoming = new ActBaoming();
            $baoming->company = $this->company;
            
            $baoming->contacts = $this->contacts;
            $baoming->position = $this->position;
            $baoming->phone = $this->phone;
            $baoming->join_num = $this->join_num;
            $baoming->act_id = $this->act_id;
            $baoming->created_at = time();

            return $baoming->save() ? $baoming : null;
        }
        return false;   
    }
    
    /**
    * 判断是否已经报名
    */
    public function hasbaoming()
    {
        $bm = (new \yii\db\Query())
        ->select(['id'])
        ->from('zq_act_baoming')
        ->where(['act_id' => $this->act_id,'phone'=>$this->phone])
        ->one();
        
        if (empty($bm)) {
            return false;
        }
        $this->addError('act_id', "您已经报名了");
        return true;
    }
    
    
    //验证码验证
    public function checkCaptcha($attribute,$params)
    {
        $record = Smslog::find()
        ->where(['mobile' => $this->phone,'sms_type'=>2,'isuse'=>0])
        ->orderBy('id desc')
        ->one();
        
        if (!empty($record)) {  //已经发送了
            if(time() <= ($record['sendtime']+(\Yii::$app->params['bm_expires_in'])) ) {//发送的验证码还有效
                if ($this->$attribute == $record['code']){
                    $record->isuse = 1;
                    $record->save();
                    return true;
                } else {
                    $this->addError($attribute, "验证码有误");
                }
            } else {
                $this->addError($attribute, "验证码有误");
            }
        }else {
            $this->addError($attribute, "验证码有误");
        }
    }
   
}
