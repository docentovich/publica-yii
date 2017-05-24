<?php

namespace modules\tosee\controllers\frontend;

use Yii;
use yii\web\Controller;
use modules\tosee\models\common\Post;

/**
 * Default controller for the `tosee` module
 */
class SiteController extends Controller
{
    /**
     * Смотрим в будущее
     */
    const FUTURE = "f";

    /**
     * Смотрим в прошлое
     */
    const PAST = "p";

    /**
     * @var string Задаем лайоут
     */
    public $layout = "tosee";

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }


    /**
     * Экшен вывода постов по условиям
     *
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        Yii::$app->view->params['future_past'] = SiteController::FUTURE;

        $posts = Post::find()
            ->with(["postData", "image"])
            ->all();

        return $this->render('index', compact('posts'));
    }


    /**
     * Экшен поста
     *
     * @param integer $id ид поста
     * @return string
     */
    public function actionPost($id)
    {
        $post = Post::find($id)
//            ->where(["id" => ])
            ->with(["postData", "image"])
            ->one();

        return $this->render('post', compact('post'));
    }
}
