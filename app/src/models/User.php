<?php

namespace app\models;

use app\beheviors\UserBeforValidate;
use app\models\Like;
use app\models\UserViaPostsCommentsRelation;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
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
 * @property Comments[] $myComments
 * @property Profile $profileNN
 * @property Like|null $likes
 * @property Portfolio $portfolio
 * @property string $password write-only password
 */
class User extends BaseUser implements IdentityInterface
{
    use UserViaPostsCommentsRelation;
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
            'username' => \Yii::t('app/user', 'Username'),
            'email' => \Yii::t('app/user', 'Email'),
            'city' => \Yii::t('app/user', 'City'),
            'password' => \Yii::t('app/user', 'Password'),
            'phone' => \Yii::t('app/user', 'Phone'),
            'created_at' => \Yii::t('app/user', 'Registration time'),
            'registered_from' => \Yii::t('app/user', 'Registered from'),
            'unconfirmed_email' => \Yii::t('app/user', 'Unconfirmed email'),
            'current_password' => \Yii::t('app/user', 'Current password'),
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
            TimestampBehavior::class,
            UserBeforValidate::class
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
        $scenarios[self::SCENARIO_UPDATE] = ['username', 'email', 'password', 'password_hash'];
        return ArrayHelper::merge($scenarios, [
            self::SCENARIO_REGISTER => ['username', 'email', 'password', 'city_id'],
            self::SCENARIO_CONNECT => ['username', 'email'],
            self::SCENARIO_CREATE => ['username', 'email', 'password', 'password_hash'],
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
        $condition = (\Yii::$app->getModule('user')->enableUnconfirmedLogin)
            ? ['id' => $id]
            : ['id' => $id, 'status' => self::STATUS_ACTIVE];
        return static::findOne($condition);
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
        $condition = (\Yii::$app->getModule('user')->enableUnconfirmedLogin)
            ? ['username' => $username]
            : ['username' => $username, 'status' => self::STATUS_ACTIVE];
        return static::findOne($condition);
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

        $condition = (\Yii::$app->getModule('user')->enableUnconfirmedLogin)
            ? ['password_reset_token' => $token]
            : ['password_reset_token' => $token, 'status' => self::STATUS_ACTIVE];
        return static::findOne($condition);
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
        return $this->profile ?? new Profile(['user_id' => \Yii::$app->user->getId()]);
    }

    /**
     * @return Profile
     */
    public function getProfileNN()
    {
        return $this->profile ?? new Profile();
    }

    public function getLikes()
    {
        return $this->hasMany(Like::class, ['user_id' => 'id']);
    }

    /**
     * @param  array $data
     * @return User
     */
    public static function registerNewUser($data = [], $form_name = '')
    {
        $user = new self(["scenario" => self::SCENARIO_REGISTER]);
        $user->load($data, $form_name);
        return $user;
    }

    public function getMyComments()
    {
        return ArrayHelper::merge($this->commentsViaPosts, []);
    }

    public function getPortfolio()
    {
        return $this->hasMany(Portfolio::class, ['user_id' => 'id']);
    }

    public function toArray(array $fields = [], array $expand = [], $recursive = true)
    {
        return ArrayHelper::merge(
            [
                "id" => $this->id,
                "email" => $this->email,
            ],
            [
                "profile" => $this->profileNN->toArray()
            ]
        );
    }
}
