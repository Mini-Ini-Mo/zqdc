<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zq_act_less_cate".
 *
 * @property int $id 主键
 * @property string $name 分类名称
 * @property int $type 1中清筑道2中清博纳3中清游学4中清论坛
 */
class ActLessCate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zq_act_less_cate';
    }
    
    /**
     * @return 中清商学类目
     */
    public static function cate()
    {
        return [
            '1'=>'中清筑道',
            '2'=>'中清博纳',
            '3'=>'中清游学',
            '4'=>'中清论坛',
        ];
    }
    /**
     * 类目下的类目
     */
    public static function category($id)
    {
        $res = self::find()->where(['type'=>$id])->all();
        return $res;
    }
    
    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 32],
            [['type'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '分类名称',
            'type' => '中清商学',
        ];
    }
}
