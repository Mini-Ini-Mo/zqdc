<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zq_act_less".
 *
 * @property string $id 主键
 * @property string $act_id 活动id
 * @property string $addr 资源地址
 * @property int $sort 次数由高到低
 * @property string $created_at 添加时间
 */
class ActLess extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zq_act_less';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['act_id', 'addr','title'], 'required'],
            [['act_id', 'created_at','time_len'], 'integer'],
            [['addr','title'], 'string', 'max' => 64],
            [['sort'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'act_id' => 'Act ID',
            'addr' => 'Addr',
            'sort' => 'Sort',
            'created_at' => 'Created At',
            'title'=>'Title',
            'time_len'=>'Time_len'
        ];
    }
}
