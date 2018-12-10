<?php

namespace app\models;

use app\modules\tosee\models\Like;
use ImageAjaxUpload\ImageInterface;
use ImageAjaxUpload\UploadModelTrait;
use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%image}}".
 *
 * @property int $id
 * @property string $alt
 * @property string $path
 * @property string $name
 * @property string $extension
 * @property Profile[] $profiles
 * @property Comments[] comments
 * @property string $relativeUploadPath
 * @property string $path0
 * @property string desc
 * @property Like|null $likes
 * @property Like[]|null $myLike
 */
class Image extends \yii\db\ActiveRecord implements ImageInterface
{
    const SCENARIO_LOAD_FILE = 'loadFile';
    protected $relativeUploadPathLabel = 'Relative Upload Path';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%image}}';
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['name', 'path'],
            self::SCENARIO_LOAD_FILE => ['name', 'path']
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['path', 'name'], 'required'],
            [['path', 'name'], 'string', 'length' => [1]],
            [['path', 'alt', 'name'], 'trim'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'alt' => Yii::t('app', 'Alt'),
            'path' => Yii::t('app', 'Path'),
            'name' => Yii::t('app', 'Name'),
            'relativeUploadPath' => $this->relativeUploadPathLabel
        ];
    }

    public function setRelativeUploadPathLabel($value)
    {
        $this->relativeUploadPathLabel = $value;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['avatar' => 'id']);
    }

    public function getRelativeUploadPath(): string
    {
        return '/uploads/' . $this->getPath0();
    }

    public function getRelativeUploadPathOrNull()
    {
        return  ($this->getPath0OrNull()) ? '/uploads/' . $this->getPath0OrNull() : null;
    }

    public function getPath0()
    {
        if ($this->name === null) {
            return 'noimage.png';
        }
        return $this->path . "/" . $this->name;
    }

    public function getPath0OrNull()
    {
        if ($this->name === null) {
            return null;
        }
        return $this->path . "/" . $this->name;
    }

    /**
     * @param string $size  e.g 200x200
     * @return string url
     */
    public function getPathImageSizeOf($size)
    {
        if ($this->name === null) {
            return 'noimage.png';
        }
        list($file_name, $file_extension) = explode('.', $this->name);
        return "{$this->path}/{$file_name}[{$size}].$file_extension";
    }

    public function getUrlImageSizeOf($size)
    {
        return  Url::to('/uploads/' . $this->getPathImageSizeOf($size), true);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['image_id' => 'id']);
    }

    public function getLikes()
    {
        return  $this->hasMany(Like::className(), ['image_id' => 'id'])->count();
    }

    public function getMyLike()
    {
        return $this->hasMany(Like::className(), ['image_id' => 'id'])
            ->andOnCondition(['user_id' => \Yii::$app->user->getId()]);
    }

}
