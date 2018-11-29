<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 02.06.2017
 * Time: 23:42
 */

namespace console\controllers;


use common\models\User;
use app\modules\tosee\models\Post;
use console\rbac\AuthorRule;
use console\rbac\CityRule;
use yii\base\Controller;
use Yii;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->getAuthManager();
        $auth->removeAll();


        //******  Roles  ******//
        $guest = $auth->createRole("guest");
        $auth->add($guest);

        $user = $auth->createRole("user");
        $auth->add($user);

        $administrator = $auth->createRole("administrator");
        $auth->add($administrator);

        //==наследоване Roles==
        $auth->addChild($administrator, $user);
        $auth->addChild($user, $guest);
        //--=наследоване Roles==--

        $this->postsRules();
        $this->specialistsRules();
        $this->authorToPostsRules();

        //получаем id и присваеваем роль
        $auth = Yii::$app->getAuthManager();
        $auth->assign($auth->getRole("administrator"), 1);


        echo "init done" . PHP_EOL;
    }

    private function postsRules()
    {
        $auth = Yii::$app->getAuthManager();
        $administrator = $auth->getRole("administrator");

        //create post
        $createPost = $auth->createPermission("createPost");
        $auth->add($createPost);
        //-create post

        //update post
        $updatePost = $auth->createPermission("updatePost");
        $auth->add($updatePost);
        //-update post


        //reed post
        $reedPost = $auth->createPermission("reedPost");
        $auth->add($reedPost);
        $reedPosts = $auth->createPermission("reedPosts");
        $auth->add($reedPosts);
        //-reed post


        //******** Permissions Posts TO Roles *****//
        $auth->addChild($administrator, $updatePost);
        $auth->addChild($administrator, $reedPost);
        $auth->addChild($administrator, $reedPosts);
        $auth->addChild($administrator, $createPost);
        //---***** Permissions Posts TO Roles **---//

        echo "posts rules done" . PHP_EOL;

    }

    private function specialistsRules()
    {
        $auth = Yii::$app->getAuthManager();

        $authorRule = new AuthorRule();
        $auth->add($authorRule);

        // get roles and rules
        $user = $auth->getRole("user");

        // specialists roles
        $author = $auth->createRole("author");
        $auth->add($author);
        $model = $auth->createRole("model");
        $auth->add($model);
        $photograph = $auth->createRole("photograph");
        $auth->add($photograph);


        // extend user
        $auth->addChild($model, $user);
        $auth->addChild($photograph, $user);
        $auth->addChild($author, $user);



        // calendar, comments, calendar
        $calendar = $auth->createPermission("calendar");
        $auth->add($calendar);
        $comments = $auth->createPermission("comments");
        $auth->add($comments);
        $orders = $auth->createPermission("orders");
        $auth->add($orders);
        $rating = $auth->createPermission("rating");
        $auth->add($rating);


        $auth->addChild($user, $rating);
        $auth->addChild($user, $calendar);
        $auth->addChild($user, $comments);
        $auth->addChild($user, $orders);


        $auth = Yii::$app->getAuthManager();
        $auth->assign($auth->getRole("author"), 2);
        echo "specialists-rules done" . PHP_EOL;
    }

    private function authorToPostsRules()
    {
        $auth = Yii::$app->getAuthManager();
        $authorRule = $auth->getRule('isAuthor');
        var_dump($authorRule);
        $author = $auth->getRole('author');
        $reedPost = $auth->getPermission("reedPost");
        $reedPosts = $auth->getPermission("reedPosts");
        $updatePost = $auth->getPermission("updatePost");
        $createPost = $auth->getPermission("createPost");
        echo '!!!!!!!!!!1';

        // update post
        $updateOwnPost = $auth->createPermission("updateOwnPost");
        $updateOwnPost->ruleName = $authorRule->name;
        $auth->add($updateOwnPost);
        $auth->addChild($updateOwnPost, $updatePost);
        $auth->addChild($author, $updateOwnPost);
        echo '!!!!!!!!!!2';

        // reed posts
        $reedOwnPosts = $auth->createPermission("reedOwnPosts");  ///просомтр нескольких постов своих
        var_dump(['$reedOwnPosts' => $reedOwnPosts]);
        var_dump(['$reedPosts' => $reedPosts]);
        $reedOwnPosts->ruleName = $authorRule->name;
        $auth->add($reedOwnPosts);
        $auth->addChild($reedOwnPosts, $reedPosts);
        echo '!!!!!!!!!!3';


        // reed post
        $reedOwnPost = $auth->createPermission("reedOwnPost"); //просмотр одного своего поста. выполняеться с кондишином
        $reedOwnPost->ruleName = $authorRule->name;
        $auth->add($reedOwnPost);
        $auth->addChild($reedOwnPost, $reedPost);
        $auth->addChild($author, $reedOwnPost);
        echo '!!!!!!!!!!4';

        // create post
        $auth->addChild($author, $createPost);
        echo '!!!!!!!!!!5';


        // author-post permissions extends
        $auth->addChild($reedOwnPost, $reedOwnPosts);
        $auth->addChild($reedOwnPosts, $reedPost);

        echo "authorToPostsRules done" . PHP_EOL;
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
        $auth->assign($auth->getRole("author"), $user->id);

        $user1 = new User(['id' => 2, 'username' => 'User1']);
        $auth->assign($auth->getRole("author"), $user1->id);


//        $moderator = new User(['id' => 3, 'username' => 'moderator', 'city_id' => 'orl']);
//        $auth->assign( $auth->getRole("moderator"), $moderator->id);


//        $moderator1 = new User(['id' => 4, 'username' => 'moderator1', 'city_id' => 'msk']);
//        $auth->assign( $auth->getRole("moderator"), $moderator1->id);


        $administrator = new User(['id' => 5, 'username' => 'administrator']);
        $auth->assign($auth->getRole("administrator"), $administrator->id);


        $loginUser = $administrator;
        Yii::$app->user->login($loginUser);

        $post = new Post([
            'user_id' => $user->id,
            'city_id' => 'orl'
        ]);

        var_dump($post);

        echo PHP_EOL . "===========" . PHP_EOL;

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