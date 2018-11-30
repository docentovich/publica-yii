<?php

namespace app\models;

use app\beheviors\UserBeforValidate;
use app\widgets\alert\Alert;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\IntegrityException;
use yii\web\IdentityInterface;
use dektrium\user\models\User as BaseUser;
use yii\helpers\ArrayHelper;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $city
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $phone
 * @property integer $created_at
 * @property integer $updated_at
 * @property Profile|null $profile
 * @property Profile $myProfile
 * @property string $password write-only password
 */
class User extends BaseUser implements IdentityInterface
{
    // use UserDbConnection;
    const STATUS_DELETED = 0;
    const STATUS_NOT_ACTIVE = 2;
    const STATUS_ACTIVE = 10;

    const SCENARIO_REGISTER = 'register';
    const SCENARIO_CONNECT = 'connect';
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_SETTINGS = 'settings';

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => \Yii::t('user', 'Username'),
            'email' => \Yii::t('user', 'Email'),
            'city' => \Yii::t('user', 'City'),
            'password' => \Yii::t('user', 'Password'),
            'phone' => \Yii::t('user', 'Phone'),
            'created_at' => \Yii::t('user', 'Registration time'),
            'registered_from' => \Yii::t('user', 'Registered from'),
            'unconfirmed_email' => \Yii::t('user', 'Unconfirmed email'),
            'current_password' => \Yii::t('user', 'Current password'),
        ];
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%usr_user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            UserBeforValidate::className()
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['city_id'], 'integer'],
            [['city_id'], 'default', 'value' => 1],

            /** email */
            [['email'], 'required'],
            ['email', 'email'],
            /** phone */
            ['phone', 'match', 'pattern' => '(\+[0-9]{1,3})?\(?[0-9]{3}\)?-[0-9]{3}-[0-9]{4}']

        ];
    }

    /** @inheritdoc */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        return ArrayHelper::merge($scenarios, [
            self::SCENARIO_REGISTER => ['username', 'email', 'password', 'city_id'],
            self::SCENARIO_CONNECT => ['username', 'email'],
            self::SCENARIO_CREATE => ['username', 'email', 'password', 'password_hash'],
            self::SCENARIO_UPDATE => ['username', 'email', 'password', 'password_hash'],
            self::SCENARIO_SETTINGS => ['username', 'email', 'password'],
        ]);
    }

    public function scenariosSuccessMessages()
    {
        return [
            self::SCENARIO_REGISTER => \Yii::t('app/user', 'Registered successful'),
            self::SCENARIO_CREATE => \Yii::t('app/user', 'Created successful'),
            self::SCENARIO_UPDATE => \Yii::t('app/user', 'Changed successful'),
        ];
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findUniqueByUserName($username)
    {
        return static::findOne(['username' => $username]);
    }

    public static function findMeTo($scenario)
    {
        /** @var User $model */
        $model = clone \Yii::$app->user->identity;
        $model->scenario = $scenario;
        return $model;
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        /** TODO to service */
        try {
            if (parent::save($runValidation, $attributeNames)) {
                \Yii::$app->session->setFlash(
                    Alert::MESSAGE_SUCCESS,
                    $this->scenariosSuccessMessages()[$this->scenario]
                );
                return true;
            }
        } catch (IntegrityException $e) {
            \Yii::$app->session->setFlash(
                Alert::MESSAGE_DANGER,
                \Yii::t('app/user', 'User already exist')
            );
        } catch (\Exception $e) {

        }

        return false;
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
//    public function setPassword($password)
//    {
//        $this->password_hash = \Yii::$app->security->generatePasswordHash($password);
//        $this->password = $password;
//    }
//
//    public function getPassword_hash($password)
//    {
//        return $this->password_hash = \Yii::$app->security->generatePasswordHash($this->password);
//    }
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = \Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = \Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'id']);
    }

    /**
     * @return Profile
     */
    public function getMyProfile()
    {
        return  $this->profile ?? new Profile();
    }
}
