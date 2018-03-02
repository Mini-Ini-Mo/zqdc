<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zq_cate".
 *
 * @property int $id
 * @property string $name
 */
class Cate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zq_cate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '分类',
        ];
    }
    
    public static function getCates($id=null)
    {
        $model = new Cate();
        if($id):
        $model = $model->find()->where(['id' => $id])->one();
        else:
        $model = $model->find(
            [
                'order'=>'id asc'
            ]
        )->all();
        endif;
        
        
        $data=array();
        if($model){
            foreach($model as $val){
                $data[$val->id]=$val->name;
            }
        }
        return $data;
    }
}
