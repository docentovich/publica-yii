<?php

namespace app\models;


use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Class UserForm
 * @property mixed $username
 * @package app\models
 */
class UserForm extends Model
{
    const SCENARIO_REGISTER = 'register';
    const SCENARIO_UPDATE = 'update';

    public $id = null;
    private $_username;
    /** @var string */
    public $password;
    /** @var string */
    public $password_repeat;
    public $email;

    public function attributeLabels()
    {
        return [
            'username' => \Yii::t('app/user', 'Login {sub_level}',
                ['sub_level' => \Yii::t('app/user', 'sub_level')]
            ),
            'email' => \Yii::t('app/user', 'Email'),
            'password' => \Yii::t('app/user', 'Password'),
            'password_repeat' => \Yii::t('app/user', 'Repeat password'),
        ];
    }

    public function scenarios()
    {
        return ArrayHelper::merge(
            parent::scenarios(),
            [
                self::SCENARIO_REGISTER => ['username', 'email', 'password'],
                self::SCENARIO_UPDATE => ['username', 'password'],
            ]);
    }


    public function rules()
    {
        return [
            ['username', 'required', 'message' => \Yii::t('app/user', 'Login required')],
            /** password */
            ['email', 'required', 'message' => \Yii::t('app/user', 'Email required')],
            ['email', 'email'],
            ['password', 'required', 'message' => \Yii::t('app/user', 'Password required')],
            ['password_repeat', 'required', 'message' => \Yii::t('app/user', 'Repeat password')],
            ['password', 'string', 'min' => 6, 'tooShort' => \Yii::t('app/user', "Password should contain at least {min, number}.")],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => \Yii::t('app/user', "Passwords don't match")],
        ];
    }

    public function getUsername()
    {
        return $this->_username ??
            (\Yii::$app->user->identity
                ? \Yii::$app->user->identity->username
                : null);
    }

    public function setUsername($username)
    {
        return $this->_username = $username;
    }

    public function toArray(array $fields = [], array $expand = [], $recursive = true)
    {
        return [
            'username' => $this->_username,
            'password' => $this->password,
            'email' => $this->email
        ];
    }

}
