<?php

namespace app\modules\probank\controllers;

use app\models\Image;
use app\modules\probank\models\ProbankPortfolio as Portfolio;
use app\modules\probank\models\ProbankPortfolio;
use app\modules\probank\models\ProbankPortfolioAdditionalImages;
use app\traits\AjaxValidationTrait;
use ImageAjaxUpload\UploadDTO;
use ImageAjaxUpload\UploadModel;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class ModelController extends Controller
{
    use AjaxValidationTrait;

    public $layout = "@current_template/layouts/user";

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['model'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionPortfolio()
    {
        $portfolio = $this->findModel(['user_id' => \Yii::$app->user->getId()]);
        $this->performAjaxValidation($portfolio);

        if ($portfolio->load(\Yii::$app->request->specialist()) && $portfolio->validate() && $portfolio->save()) {
            $this->saveMainPhoto($portfolio);
            $this->saveAdditionalPhoto($portfolio);
            $this->refresh();
            \Yii::$app->end();
        }
        return $this->render('portfolio', ['model' => $portfolio]);
    }

    private function saveMainPhoto(ProbankPortfolio $portfolio)
    {
        // main image. get current, replace bay load, save, link
        $main_image = $portfolio->mainPhotoNN;
        $main_image->load(
            (new UploadModel())->upload(\Yii::$app->user->getId())->toArray(), ''
        );
        if ($main_image->validate()) {
            $main_image->save();
            $portfolio->link('mainPhoto', $main_image);
        }
    }

    private function saveAdditionalPhoto(ProbankPortfolio $portfolio, $type = ProbankPortfolioAdditionalImages::TYPE_PORTFOLIO)
    {
        array_map(
            function ($item) use($portfolio)  {
                /** @var UploadDTO $item */
                $image = new Image();
                $image->load($item->toArray(), '');
                if ($image->validate() && $image->save()) {
                    $portfolio->link('additionalImages', $image);
                }
            },
            (new UploadModel(['instance' => 1]))->multiUpload(\Yii::$app->user->getId())
        );
    }

    /**
     * Finds the Portfolio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Portfolio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($condition)
    {
        if (($model = Portfolio::findOne($condition)) !== null) {
            return $model;
        }
        return new Portfolio();
    }
}