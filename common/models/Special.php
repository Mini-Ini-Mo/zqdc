<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zq_special".
 *
 * @property int $id
 * @property string $title 标题
 * @property int $expert_id 专家
 * @property string $viewpoint 观点
 * @property string $analysis 观点解析
 * @property string $praise_num 点赞
 * @property string $read_num 阅读
 * @property int $status 0不显示 1显示
 * @property int $created_at
 * @property int $cate_id
 */
class Special extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zq_special';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['expert_id', 'praise_num', 'read_num', 'created_at', 'cate_id', 'status'], 'integer'],
            [['viewpoint', 'analysis','img'], 'required'],
            [['viewpoint', 'analysis'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'expert_id' => '专家',
            'viewpoint' => '观点',
            'analysis' => '观点解析',
            'praise_num' => '赞',
            'read_num' => '阅读量',
            'status' => '状态',
            'created_at' => '创建时间',
            'cate_id' => '分类',
            'img' => '图片',
            
        ];
    }
}
