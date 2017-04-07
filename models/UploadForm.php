<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $extensions = ['jpg', 'gif', 'png', 'jpeg'];
    public $maxsize = '2000000';
    public $savePath = 'upload';

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => $this->extensions, 'minSize' => '100', 'maxSize' => $this->maxsize, 'maxFiles' => 1],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {//由Yii验证，但具体错误返回在下面else
            $filepath = $this->savePath;//相对根的文件存放目录
            if(!file_exists($this->savePath)){mkdir($this->savePath,0777,true);}//支持 date('Y-m-d') 子文件夹
            $filename = strtoupper(md5(uniqid(rand()))).'.'.$this->imageFile->extension;//文件名
            $file_uri = $filepath .'/'. $filename;
            $this->imageFile->saveAs($file_uri);
            return ['code' => 0, 'url' => $file_uri];
        } else {
            $reexts = empty($this->extensions) ? true : in_array(strtolower($this->imageFile->extension), $this->extensions);
            if(!$reexts) {
                $result = array('code' => 1, 'error' => '上传文件后缀不允许');
            }elseif($this->imageFile->size > $this->maxsize){
                $result =  array('code' => 2, 'error' => '上传文件大小不符');
            }else{
                $result = array('code' => 3, 'error' => '上传文件失败请重试');
            }
            return $result;
        }
    }
}