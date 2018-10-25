<?php
namespace app\models;

use app\models\Image;
use dektrium\user\models\Profile as BaseProfile;
use borales\extensions\phoneInput\PhoneInputBehavior;
use borales\extensions\phoneInput\PhoneInputValidator;

/**
 * This is the model class for table "profile".
 *
 * @property integer $user_id
 * @property string  $name
 * @property string  $firstname
 * @property string  $sename
 * @property string  $lastname
 * @property string  $fullName
 * @property string  $public_email
 * @property string  $gravatar_email
 * @property string  $gravatar_id
 * @property string  $location
 * @property string  $website
 * @property string  $bio
 * @property string  $timezone
 * @property User    $user
 * @property Image   $avatar0
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com
 */
class Profile extends BaseProfile
{
    // use UserDbConnection;

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
            'phone' => \Yii::t('app/user', 'phone'),
            'bio'   => \Yii::t('app/user', 'bio'),
        ];
    }


    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'][]   = ['sename','lastname','phone'];
        $scenarios['update'][]   = ['sename','lastname','phone'];
        $scenarios['register'][] = ['sename','lastname','phone'];
        return $scenarios;
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules['senameLength']   = ['sename', 'string', 'max' => 255];
        $rules['lastnameLength']   = ['lastname', 'string', 'max' => 255];
        $rules['phone']   = ['phone', PhoneInputValidator::className()];

        return $rules;
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
        return $this->hasOne(Image::className(), ['id' => 'avatar']);
    }

    public function getFullName(){
        return implode(" ", [$this->firstname, $this->sename, $this->lastname]);
    }

}
