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
     * Смотрим в будущее
     */
    const PAST = "p";

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = "tosee";
        Yii::$app->view->params['future_past'] = SiteController::FUTURE;

        $posts = Post::find()
            //->where(["1" => "1"])
            ->with("postData")
            ->with("images")
            ->all();
        return $this->render('index', compact('posts'));
    }
}
