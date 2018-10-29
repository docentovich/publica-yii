<?php

namespace app\modules\users\controllers;

use dektrium\user\Finder;
use dektrium\user\models\RegistrationForm;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use dektrium\user\controllers\RegistrationController as BaseRegistrationController;
use Yii;


/**
 * RegistrationController is responsible for all registration process, which includes registration of a new account,
 * resending confirmation tokens, email confirmation and registration via social networks.
 *
 * @property \dektrium\user\Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class RegistrationController extends BaseRegistrationController
{
    use AjaxValidationTrait;
    use EventTrait;
    /** @var Finder */
    protected $finder;

    public $layout = "@current_template/layouts/login";

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['allow' => true, 'actions' => ['register', 'connect'], 'roles' => ['?']],
                    ['allow' => true, 'actions' => ['confirm', 'resend'], 'roles' => ['?', '@']],
                ],
            ],
        ];
    }


    /**
     * Displays the registration page.
     * After successful registration if enableConfirmation is enabled shows info message otherwise
     * redirects to home page.
     *
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionRegister()
    {

        if (!$this->module->enableRegistration) {
            throw new NotFoundHttpException();
        }

        /** @var RegistrationForm $model */
        $model = Yii::createObject(RegistrationForm::className());
        $event = $this->getFormEvent($model);

        $this->trigger(self::EVENT_BEFORE_REGISTER, $event);

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->register()) {
                $this->trigger(self::EVENT_AFTER_REGISTER, $event);

                return $this->render('register', [
                    'title' => Yii::t('user', 'Your account has been created'),
                    'model' => $model,
                    'module' => $this->module,
                ]);
            }
        }

        return $this->render('register', [
            'model' => $model,
            'module' => $this->module,
        ]);
    }


    /**
     * Confirms user's account. If confirmation was successful logs the user and shows success message. Otherwise
     * shows error message.
     *
     * @param int $id
     * @param string $code
     *
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionConfirm($id, $code)
    {
        $user = $this->finder->findUserById($id);

        if ($user === null || $this->module->enableConfirmation == false) {
            throw new NotFoundHttpException();
        }

        $event = $this->getUserEvent($user);

        $this->trigger(self::EVENT_BEFORE_CONFIRM, $event);

        $user->attemptConfirmation($code);

        $this->trigger(self::EVENT_AFTER_CONFIRM, $event);

        //получаем id и присваеваем роль
        $auth = Yii::$app->getAuthManager();
        $auth->assign($auth->getRole("user"), $id);

        $this->redirect(\Yii::$app->homeUrl, 302);

        \Yii::$app->getSession()->setFlash('error', 'Аккаунт активирован');

        // return $this->render('/message', [
        //  'title'  => \Yii::t('user', 'Account confirmation'),
        //  'module' => $this->module,
        // );
    }


}
