<?php

namespace app\models;


use yii\base\Model;

/**
 * Class UserForm
 * @package app\models
 */
class UserForm extends Model
{
    private $_username;
    /** @var string */
    public $password;
    /** @var string */
    public $password_repeat;

    public function attributeLabels()
    {
        return [
            'username' => \Yii::t('app/user', 'Login {sub_level}',
                ['sub_level' => \Yii::t('app/user', 'sub_level')]
            ),
            'password' => \Yii::t('app/user', 'Password'),
            'password_repeat' => \Yii::t('app/user', 'Repeat password'),
        ];
    }


    public function rules()
    {
        return [
            ['username', 'required', 'message' => \Yii::t('app/user', 'Login required')],
            /** password */
            ['password', 'required', 'message' => \Yii::t('app/user', 'Password required')],
            ['password_repeat', 'required', 'message' => \Yii::t('app/user', 'Repeat password')],
            ['password', 'string', 'min' => 6, 'tooShort' =>  \Yii::t('app/user', "Password should contain at least {min, number}.")],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => \Yii::t('app/user', "Passwords don't match")],
        ];
    }

    public function getUsername()
    {
        return \Yii::$app->user->identity->username;
    }

    public function setUsername($username)
    {
        return $this->_username = $username;
    }

    public function toArray(array $fields = [], array $expand = [], $recursive = true)
    {
        return [
            'username' => $this->_username,
            'password' =>  $this->password = \Yii::$app->getSecurity()->generatePasswordHash($this->password)
        ];
    }

}
