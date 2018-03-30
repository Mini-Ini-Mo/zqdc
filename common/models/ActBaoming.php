<?php

namespace common\models;

use Yii;

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
class ActBaoming extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zq_act_baoming';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company', 'contacts', 'position', 'phone', 'join_num','act_id'], 'required'],
            [['join_num', 'created_at','act_id'], 'integer'],
            [['company'], 'string', 'max' => 60],
            [['contacts', 'position'], 'string', 'max' => 40],
            [['phone'], 'string', 'max' => 11],
            [['remark'], 'string', 'max' => 255],
            [['act_type'],'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company' => '参会单位',
            'contacts' => '企业联系人',
            'position' => '职位',
            'phone' => '手机号',
            'join_num' => '参会人数',
            'created_at' => 'Created At',
            'remark' => '备注',
            'act_id' => 'act_id',
        ];
    }
    
    public function getActivity()
    {
        return $this->hasOne(Activity::className(), ['id' => 'act_id'])->asArray();
    }
}
