<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 01.11.2017
 * Time: 4:26
 */

namespace common\models;
use yii\db\Connection;

trait UserDbConnection
{
    public static function getDb ()
    {
        
        if ( isset( \Yii::$app->params['user_db'] ) !== FALSE ) {
            return \Yii::$app->params['user_db'];
        } else {
            
            $paremeters = [
                'dsn'         => \Yii::$app->db->dsn,
                'username'    => \Yii::$app->db->username,
                'password'    => \Yii::$app->db->password,
                'tablePrefix' => 'usr_',
                'charset'     => \Yii::$app->db->charset,
            ];
            
            return \Yii::$app->params['user_db'] = new Connection( $paremeters );
        }
    }
}