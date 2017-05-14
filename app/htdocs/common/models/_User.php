<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $username Уникальное
 * @property int $user_group_id Индекс. fkey
 * @property string $first_name
 * @property string $last_name
 * @property string $password_hash
 * @property string $auth_key
 * @property string $password_reset_token
 * @property string $email
 * @property int $phone
 * @property string $avatar
 * @property int $respond_sms
 * @property int $respond_email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Image[] $images
 * @property Post[] $posts
 * @property UserGroup $userGroup
 * @property UserAbout $userAbout
 * @property UserLike[] $userLikes
 */
class _User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'first_name', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['user_group_id', 'phone', 'respond_sms', 'respond_email', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'first_name', 'last_name'], 'string', 'max' => 100],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['auth_key', 'avatar'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 50],
            [['username'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['user_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserGroup::className(), 'targetAttribute' => ['user_group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'user_group_id' => 'User Group ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'phone' => 'Phone',
            'avatar' => 'Avatar',
            'respond_sms' => 'Respond Sms',
            'respond_email' => 'Respond Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserGroup()
    {
        return $this->hasOne(UserGroup::className(), ['id' => 'user_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAbout()
    {
        return $this->hasOne(UserAbout::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLikes()
    {
        return $this->hasMany(UserLike::className(), ['user_id' => 'id']);
    }
}
