<?php

namespace app\models;

use app\models\Image;
use dektrium\user\models\Profile as BaseProfile;
use borales\extensions\phoneInput\PhoneInputBehavior;
use borales\extensions\phoneInput\PhoneInputValidator;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "profile".
 *
 * @property integer $user_id
 * @property string $name
 * @property string $firstname
 * @property string $sename
 * @property string $lastname
 * @property string $fullName
 * @property string $public_email
 * @property string $gravatar_email
 * @property string $gravatar_id
 * @property string $location
 * @property string $website
 * @property string $bio
 * @property string $timezone
 * @property User $user
 * @property Image|null $avatar0
 * @property Image $avatarNN
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com
 */
class Profile extends BaseProfile
{
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_CREATE = 'create';
    const SCENARIO_REGISTER = 'register';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%usr_profile}}';
    }

    public function attributeLabels()
    {
        return [
            'phone' => \Yii::t('app/user', 'Phone'),
            'public_email' => \Yii::t('app/user', 'Email'),
            'firstname' => \Yii::t('app/user', 'First Name'),
            'sename' => \Yii::t('app/user', 'Se Name'),
            'lastname' => \Yii::t('app/user', 'Last Name'),
        ];
    }


    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ['sename', 'lastname', 'phone'],
            self::SCENARIO_UPDATE => ['firstname', 'sename', 'lastname', 'phone', 'avatar'],
            self::SCENARIO_REGISTER => ['sename', 'lastname', 'phone'],
        ];
    }

    public function rules()
    {
        return [
            'sename' => ['sename', 'string', 'max' => 255, 'tooLong' => \Yii::t('app/user', 'Se name maximunm {max} symbols')],
            'senameLength' => ['sename', 'required', 'message' => \Yii::t('app/user', 'Sename name is required')],
            'lastnameLength' => ['lastname', 'string', 'max' => 255, 'tooLong' => \Yii::t('app/user', 'Last name maximunm {max} symbols')],
            'lastname' => ['lastname', 'required', 'message' => \Yii::t('app/user', 'Last name is required')],
            'firstname' => ['firstname', 'required', 'message' => \Yii::t('app/user', 'First name is required')],
            'phone' => ['phone', PhoneInputValidator::class],
        ];
    }

    /**
     * Переформатируем телефон
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            'phoneInput' => PhoneInputBehavior::className(),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvatar0()
    {
        return $this->hasOne(Image::class, ['id' => 'avatar']);
    }

    public function getFullName()
    {
        return implode(" ", [$this->sename, $this->firstname, $this->lastname]);
    }

    /**
     * @return \app\models\Image
     */
    public function getAvatarNN()
    {
        return $this->avatar0 ?? new Image();
    }

    public function toArray(array $fields = [], array $expand = [], $recursive = true)
    {
        return ArrayHelper::merge(
            parent::toArray(),
            [
                "avatar" => $this->avatarNN->toArray(),
                "avatar_url" => $this->avatarNN->getUrlImageSizeOf("50x50")
            ]
        );
    }
}
