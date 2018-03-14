<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zq_expert".
 *
 * @property int $id
 * @property string $name 名称
 * @property string $position 职务
 * @property string $introduction 简介
 * @property string $head_img 头像
 * @property string $read_num 阅读量
 * @property string $praise_num 点赞
 * @property int $created_at
 * @property int $status 0不显示1显示
 * @property string $post_num 发文数量
 */
class Expert extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zq_expert';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'introduction', 'head_img'], 'required'],
            [['introduction'], 'string'],
            [['read_num', 'praise_num', 'created_at', 'post_num'], 'integer'],
            [['name', 'position', 'head_img'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '专家',
            'position' => '职务',
            'introduction' => '简介',
            'head_img' => '头像',
            'read_num' => '阅读量',
            'praise_num' => '赞',
            'created_at' => '创建时间',
            'post_num' => '发文数量',
        ];
    }

    public static function getExpertName($id=null)
    {
        $expert = new self();
        if($id):
            $model = $expert->find()->select(['id','name'])->where(['id' => $id])->one();
        else:
            $model = $expert->find()->select(['id','name'])->indexBy('id')->all();
        endif;

        $data=array();
        if($model){
            foreach($model as $val){
                $data[$val->id]=$val->name;
            }
        }
        return $data;
    }

    public static function getExpertInfo($id,$feild=null)
    {
        $expert = new self();
        $model = $expert->find()->where(['id' => $id])->one();
        if($feild)
            return $model[$feild];
        return $model;
    }
}
