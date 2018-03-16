<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zq_smslog".
 *
 * @property string $id 主键
 * @property string $mobile 手机号
 * @property string $code 验证码
 * @property string $ipaddr IP地址
 * @property int $sms_type 1精英论坛2专题讲座...
 * @property string $sendtime 发送时间
 * @property int $isuse 是否已经使用1使用0未使用
 */
class Smslog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zq_smslog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mobile', 'code', 'sms_type', 'sendtime'], 'required'],
            [['sendtime','sms_type','isuse'], 'integer'],
            [['mobile'], 'string', 'max' => 11],
            [['code'], 'string', 'max' => 10],
            [['ipaddr'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mobile' => 'Mobile',
            'code' => 'Code',
            'ipaddr' => 'Ipaddr',
            'sms_type' => 'Sms Type',
            'sendtime' => 'Sendtime',
            'isuse' => 'Isuse',
        ];
    }
}
