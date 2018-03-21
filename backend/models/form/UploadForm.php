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

    public function rules()
    {
        return [
          [['file'],'file','maxFiles' => 10,'maxSize' => 1024*1024*1024],//10M
        ];
    }
}