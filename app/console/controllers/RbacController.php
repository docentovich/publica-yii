<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 02.06.2017
 * Time: 23:42
 */

namespace console\controllers;


use common\models\User;
use modules\tosee\models\common\Post;
use console\rbac\AuthorRule;
use console\rbac\CityRule;
use yii\base\Controller;
use Yii;
//use yii\console\Request;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->getAuthManager();
        $auth->removeAll();



        //******  Rules  ******//
        $authorRule = new AuthorRule();
        $auth->add($authorRule);
        $cityRule   = new CityRule();
        $auth->add($cityRule);
        //---******  Rules  ******---//




        //******  Roles  ******//
        $guest = $auth->createRole("guest");
        $auth->add($guest);

        $user = $auth->createRole("user");
        $auth->add($user);

        $author = $auth->createRole("author");
        $auth->add($author);

        $moderator = $auth->createRole("moderator");
        $auth->add($moderator);

        $administrator = $auth->createRole("administrator");
        $auth->add($administrator);

        //==наследоване Roles==
        $auth->addChild($administrator, $moderator);
        $auth->addChild($moderator, $author);
        $auth->addChild($author, $user);
        $auth->addChild($user, $guest);
        //--=наследоване Roles==--



        //----******  Roles  ******----//



//###################################  POSTS    #################################################


        //******  Permissions Posts  ******//

        //create post
        $createPost = $auth->createPermission("createPost");
        $auth->add($createPost);
        //-create post




        //update post
        $updatePost = $auth->createPermission("updatePost");
        $auth->add($updatePost);

        $updateCityPost = $auth->createPermission("updateCityPost");
        $updateCityPost->ruleName = $cityRule->name;
        $auth->add($updateCityPost);

        $updateOwnPost   = $auth->createPermission("updateOwnPost");
        $updateOwnPost->ruleName = $authorRule->name;
        $auth->add($updateOwnPost);
        //-update post




        //reed post
        $reedPost = $auth->createPermission("reedPost");
        $auth->add($reedPost);


        $reedCityPosts = $auth->createPermission("reedCityPosts");  ///просомтр нескольких постов города
        $auth->add($reedCityPosts);

        $reedCityPost = $auth->createPermission("reedCityPost");
        $reedCityPost->ruleName = $cityRule->name;
        $auth->add($reedCityPost);


        $reedOwnPosts = $auth->createPermission("reedOwnPosts");  ///просомтр нескольких постов своих
        $auth->add($reedOwnPosts);


        $reedOwnPost = $auth->createPermission("reedOwnPost"); //просмотр одного своего поста. выполняеться с кондишином
        $reedOwnPost->ruleName = $authorRule->name;
        $auth->add($reedOwnPost);
        //-reed post



        //moderate post
        $moderatePost = $auth->createPermission("moderatePost");
        $auth->add($moderatePost);

        $moderateCityPost = $auth->createPermission("moderateCityPost");
        $moderateCityPost->ruleName = $cityRule->name;
        $auth->add($moderateCityPost);
        //-moderate post





        //======================наследоване Permissions========================

        //update post
        $auth->addChild($updateOwnPost, $updatePost);
        //--OR--
        $auth->addChild($updateCityPost, $updatePost);
        //-update post

        //reed post
        $auth->addChild($reedOwnPost, $reedOwnPosts);
        $auth->addChild($reedOwnPosts, $reedPost);
        //--OR--
        $auth->addChild($reedCityPost, $reedCityPosts);
        $auth->addChild($reedCityPosts, $reedPost);
        //-reed post

        //moderate post
        $auth->addChild($moderateCityPost, $moderatePost);
        //-moderate post

        //--==================наследоване Permissions==================--


        //---******  Permissions Posts ******---//






        //******** Permissions Posts TO Roles *****//
        $auth->addChild($author,        $reedOwnPosts);
        $auth->addChild($author,        $reedOwnPost);
        $auth->addChild($moderator,     $reedCityPosts);
        $auth->addChild($moderator,     $reedCityPost);
        $auth->addChild($administrator, $reedPost);

        $auth->addChild($author,        $updateOwnPost);
        $auth->addChild($moderator,     $updateOwnPost);
        $auth->addChild($moderator,     $updateCityPost);
        $auth->addChild($administrator, $updatePost);

        $auth->addChild($author,        $createPost);
        $auth->addChild($moderator,     $createPost);
        $auth->addChild($administrator, $createPost);

        $auth->addChild($moderator,     $moderateCityPost);
        $auth->addChild($administrator, $moderatePost);

        //---***** Permissions Posts TO Roles **---//




//#################################  USERS   ###################################################


        //******  Permissions Назначение ролей  ******//

        //change author
        $changeAuthor = $auth->createPermission("changeAuthor");
        $auth->add($changeAuthor);

        $changeCityAuthor = $auth->createPermission("changeCityAuthor");
        $changeCityAuthor->ruleName = $cityRule->name;
        $auth->add($changeCityAuthor);
        //change author

        //change moderator
        $changeModerator = $auth->createPermission("changeModerator");
        $auth->add($changeModerator);
        //change moderator



        //==================наследоване ролей=================
        $auth->addChild($changeCityAuthor, $changeAuthor);
        //--===============наследоване ролей--============


        //--****  Permissions Назначение ролей  ****--//






        //--****  Permissions Назначение ролей TO Roles  ****--//
        $auth->addChild($moderator,     $changeCityAuthor);
        $auth->addChild($administrator, $changeAuthor);

        $auth->addChild($administrator, $changeModerator);
        //--****  Permissions Назначение ролей TO Roles  ****--//


        //получаем id и присваеваем роль
        $auth = Yii::$app->getAuthManager();
        $auth->assign($auth->getRole("administrator"), 1);

        $auth = Yii::$app->getAuthManager();
        $auth->assign($auth->getRole("author"), 2);


        echo "Done" . PHP_EOL;
    }

    public function actionTest()
    {
        die;
        //для тестирование надо не забыть поменять модель extended у модели User
        echo "test" . PHP_EOL;
        $auth = Yii::$app->getAuthManager();


        Yii::$app->set('request', new \yii\console\Request());

        $auth->revokeAll(1);
        $auth->revokeAll(2);
        $auth->revokeAll(3);
        $auth->revokeAll(4);
        $auth->revokeAll(5);

        $user = new User(['id' => 1, 'username' => 'User']);
        $auth->assign( $auth->getRole("author"), $user->id);

        $user1 = new User(['id' => 2, 'username' => 'User1']);
        $auth->assign( $auth->getRole("author"), $user1->id);


        $moderator = new User(['id' => 3, 'username' => 'moderator', 'city_id' => 'orl']);
        $auth->assign( $auth->getRole("moderator"), $moderator->id);


        $moderator1 = new User(['id' => 4, 'username' => 'moderator1', 'city_id' => 'msk']);
        $auth->assign( $auth->getRole("moderator"), $moderator1->id);


        $administrator = new User(['id' => 5, 'username' => 'administrator']);
        $auth->assign( $auth->getRole("administrator"), $administrator->id);




        $loginUser = $administrator;
        Yii::$app->user->login($loginUser);

        $post = new Post([
            'user_id' => $user->id,
            'city_id' => 'orl'
        ]);

        var_dump($post);

        echo  PHP_EOL ."===========" . PHP_EOL;

        var_dump([
            "user name" => $loginUser->username,
            "user id" => $loginUser->id,
            "user city" => $loginUser->city_id,
            "post user_id" => $post->user_id,
            "post city_id" => $post->city_id,
            "identity city_id" => Yii::$app->user->identity->city_id,
            "can" => Yii::$app->user->can('updatePost', ['object' => $post])
        ]);

        echo "done!" . PHP_EOL;

    }
}