<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%zq_activity}}".
 *
 * @property int $id 主键
 * @property string $topical 主题
 * @property string $thumb 活动缩略图
 * @property string $intro 活动公告
 * @property string $content 活动内容
 * @property string $expert_id 讲师
 * @property string $act_begin_time 活动开始时间
 * @property string $act_end_time 活动结束时间
 * @property string $created_at 创建时间
 * @property int $status 1公开0不公开
 * @property int $act_type 活动类型1论坛2讲座
 */
class Activity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zq_activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['topical'], 'required'],
            [['content'], 'string'],
            [['expert_id', 'act_begin_time', 'act_end_time', 'created_at', 'status', 'act_type'], 'integer'],
            [['topical'], 'string', 'max' => 60],
            [['thumb'], 'string', 'max' => 100],
            [['intro'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'topical' => '主题',
            'thumb' => '活动图',
            'intro' => '简介',
            'content' => '活动详情',
            'expert_id' => '讲师id',
            'act_begin_time' => '活动开始时间',
            'act_end_time' => '活动结束时间',
            'created_at' => '创建时间',
            'status' => '状态',
            'act_type' => '活动类型',
        ];
    }
}
