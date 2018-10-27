<?php

namespace ImageAjaxUpload;

use http\Url;
use yii\base\Action;

class UploadAction extends Action
{
    public $relative_upload_dir;

    public function init()
    {
        if(!isset($this->relative_upload_dir))
        {
            $this->relative_upload_dir = '/temp/' . date('Y-m-d');
        }
    }

    public function run()
    {
        if(!\Yii::$app->request->isAjax){
            throw new \Exception('must be ajax');
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return  (new UploadModel())->multiUpload( $this->relative_upload_dir );
    }
}