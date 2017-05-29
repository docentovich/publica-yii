<?php
namespace modules\users\models;

use dektrium\user\models\Profile as BaseProfile;

/**
 * This is the model class for table "profile".
 *
 * @property integer $user_id
 * @property string  $name
 * @property string  $public_email
 * @property string  $gravatar_email
 * @property string  $gravatar_id
 * @property string  $location
 * @property string  $website
 * @property string  $bio
 * @property string  $timezone
 * @property User    $user
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com
 */
class Profile extends BaseProfile
{
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
        $rules['phoneLength']   = ['phone', 'string', 'max' => 255];

        return $rules;
    }


}
