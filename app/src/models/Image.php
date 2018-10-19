<?php

namespace app\models;

use app\beheviors\ImageUpload;
use Yii;

/**
 * This is the model class for table "{{%image}}".
 *
 * @property int $id
 * @property string $alt
 * @property string $path
 * @property string $name
 * @property string $extension
 *
 * @property Post[] $posts
 * @property PostToImage[] $postToImages
 * @property Post[] $posts0
 * @property Profile[] $profiles
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @var string Сюда загружаем размер для тумбочки
     */
    public $size;

    /**
     * @var string Адрес тумбочки
     */
    public $thumb;

    /**
     * @var string JSON для ajax
     */
    public $json;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%image}}';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['path', 'alt', 'name'], 'trim'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('post', 'ID'),
            'alt' => Yii::t('post', 'Alt'),
            'path' => Yii::t('post', 'Path'),
            'name' => Yii::t('post', 'Name'),
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostToImages()
    {
        return $this->hasMany(PostToImage::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts0()
    {
        return $this->hasMany(Post::className(), ['id' => 'post_id'])->viaTable(PostToImage::tableName(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['avatar' => 'id']);
    }

    public function getFullPath(){
        return $this->path . "/" . $this->name;
    }

    public function getFullPathImageSizeOf($size){
        list($file_name, $file_extension) = explode('.', $this->name);
        return "{$this->path}/{$file_name}[{$size}].$file_extension";
    }


}
