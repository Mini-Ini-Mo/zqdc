<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property string $name
 * @property string $file
 * @property int $size
 * @property string $type 类型:img,file,tar
 * @property int $uid
 * @property string $status usable,forbidden
 * @property int $created_at
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file','file_name'], 'required'],
            [['size', 'uid', 'created_at'], 'integer'],
            [['name', 'file', 'status'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 50],
            [['file_name'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'file' => '文件',
            'size' => '大小',
            'type' => '类型',
            'uid' => '所有者',
            'status' => '状态',
            'created_at' => '添加时间',
            'file_name'=>'文件名称',
            'base_type'=> '文件基本类型',
        ];
    }
}
