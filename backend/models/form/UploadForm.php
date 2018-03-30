<?php
namespace app\models\form;
use yii\base\Model;

/**
 * Created by PhpStorm.
 * User: cuik
 * Date: 2018/3/21
 * Time: 15:39
 */

class UploadForm extends Model
{
    public $file;
    public $file_name;

    public function rules()
    {
        return [
          [['file'],'file','maxFiles' => 10,'maxSize' => 1024*1024*30],//10M
          [['file_name'], 'required'],
          [['file_name'], 'string', 'max' => 64],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'file' => '文件',
            'file_name'=>'文件名称',
        ];
    }
}