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
     * @var int Текущая старница
     */
    public $page = 1;

    /**
     * @var int Итого на странице
     */
    public $total_items;

    /**
     * @var Будущее или прошло?
     */
    public $future_or_past;

    /**
     * @var int Лимит итемов на страницу
     */
    public $limit_per_page = 20;


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
    public function actionIndex($page = 1)
    {
        $this->page  = $page;
        
        //передаем в лайоут будущее
        Yii::$app->view->params['navigation_label'] = "Что будет";



        $posts = Post::get_future_posts();

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
            ->with(["postData", "image"])
            ->one();

        return $this->render('post', compact('post'));
    }
    
    
}
