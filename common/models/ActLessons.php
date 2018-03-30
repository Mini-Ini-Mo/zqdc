<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zq_act_lessons".
 *
 * @property int $id 主键
 * @property string $topical 主题
 * @property int $less_cate 课程分类
 * @property string $thumb 活动缩略图
 * @property string $intro 活动公告
 * @property string $content 活动内容
 * @property string $expert_id 讲师
 * @property string $act_begin_time 活动开始时间
 * @property string $act_end_time 活动结束时间
 * @property string $created_at 创建时间
 * @property int $status 1公开0不公开
 * @property int $less_mode 1线上2线下
 */
class ActLessons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zq_act_lessons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['topical', 'act_begin_time', 'act_end_time'], 'required'],
            [['less_cate', 'expert_id', 'created_at','status','less_mode','source_type'], 'integer'],
            [['content'], 'string'],
            [['act_begin_time', 'act_end_time'], 'safe'],
            [['topical'], 'string', 'max' => 60],
            [['thumb'], 'string', 'max' => 100],
            [['intro'], 'string', 'max' => 200],
            [['addr','cost'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'topical' => '课程名称',
            'less_cate' => '课程分类',
            'thumb' => '课程缩略图',
            'intro' => '课程简介',
            'content' => '课程内容',
            'expert_id' => '课程讲师',
            'act_begin_time' => '课程开始时间',
            'act_end_time' => '课程结束时间',
            'created_at' => '课程创建时间',
            'status' => '状态',
            'less_mode' => '课程模式',
            'source_type'=>'资源类型',
            'addr'=>'课程地点',
            'cost'=>'课程费用'
        ];
    }
}
