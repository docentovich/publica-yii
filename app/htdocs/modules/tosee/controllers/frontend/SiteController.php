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
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        Yii::$app->view->params['future_past'] = SiteController::FUTURE;

        $posts = Post::find()
            //->where(["1" => "1"])
            ->with(["postData", "image"])
            ->all();

        return $this->render('index', compact('posts'));
    }



    public function postAction($id)
    {
        var_dump($id);
        die;
        return $this->action;
    }
}
