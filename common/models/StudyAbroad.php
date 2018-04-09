<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zq_study_abroad".
 *
 * @property int $id 主键
 * @property string $destination 游学目的地
 * @property string $begin_time 开始时间
 * @property string $cost 费用说明
 * @property int $status 1公开0未公开
 * @property string $intro 游学简介
 * @property string $content 游学说明
 */
class StudyAbroad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zq_study_abroad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'begin_time','days','thumb'], 'required'],
            [['status','days','destination'], 'integer'],
            [['content','begin_time','thumb','title'], 'string'],
            [['cost'], 'string', 'max' => 100],
            [['intro'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title'=>'游学标题',
            'destination' => '游学目的地',
            'begin_time' => '开始时间',
            'cost' => '费用说明',
            'status' => '状态',
            'intro' => '简介',
            'content' => '详情',
            'days'=>'游学天数',
            'thumb'=>'活动简图',
        ];
    }
}
