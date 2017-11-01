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
                'dsn'         => 'mysql:host=db;dbname=tosee',
                'username'    => 'root',
                'password'    => '1Vv4nfkCXp',
                'tablePrefix' => 'usr_',
                'charset'     => 'utf8',
            ];
            
            return \Yii::$app->params['user_db'] = new Connection( $paremeters );
        }
    }
}