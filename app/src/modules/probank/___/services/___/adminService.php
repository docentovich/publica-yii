<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 03.06.2017
 * Time: 14:16
 */

namespace probank\services\backend;

use app\models\User;
use Yii;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use app\Services;



class adminService extends Services
{
    /**
     * @var string Текущий город
     */
    public $city_id = '1';

    public function __construct()
    {
        $this->city = Yii::$app->user->identity->city_id;

        $this->_query = User::find();
    }

    protected function getMany($condition = [])
    {
        $this->count();

        //select all
        $this->items = $this->_query
            ->andWhere($condition)
            ->andWhere(["!=", "id", Yii::$app->user->getId()])//скрыть себя
            ->all();
    }

    protected function getOne($id)
    {
        // TODO: Implement getOne() method.
    }

    public function search($keyword)
    {
        // TODO: Implement search() method.
    }

    public function save()
    {
        // TODO: Implement save() method.
    }

    /**
     * Получить все доступные user
     *
     * @return $this|postServices
     * @throw AccessDeniedException
     */
    public function getAllUsers()
    {

        if (Yii::$app->user->can("administrator")) {
            $this->getMany();
        } elseif (Yii::$app->user->can("moderator")) {
            $this->getMany(["=", "city", $this->city_id]);
        } else {
            throw new AccessDeniedException();
        }

        return $this;

    }

    /**
     * Смена роли
     * @throw AccessDeniedException
     */
    public function setUserRole($post_requst)
    {

        foreach ($post_requst['id'] as $user_id => $new_role) {

            if ($user_id == Yii::$app->user->getId())
                throw new AccessDeniedException();

            $user = new User(["id" => $user_id]);
            $auth = Yii::$app->getAuthManager();


            //если админ то правим как угодно
            if (Yii::$app->user->can("changeModerator")) {

                $auth->revokeAll($user->id);
                $auth->assign($auth->getRole($new_role), $user->id);

            }
            //если модератор то с дополнительными проверками
            elseif (Yii::$app->user->can("changeAuthor", ['object' => $user])) {
                if (in_array($new_role, ['user', 'author'])) { //этот костыль надо как то рефакторить!!!
                    $auth->revokeAll($user->id);
                    $auth->assign($auth->getRole($new_role), $user->id);
                }

            }
        }
    }
}