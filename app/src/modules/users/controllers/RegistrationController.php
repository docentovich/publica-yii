<?php

namespace app\modules\users\controllers;

use dektrium\user\Finder;
use dektrium\user\models\RegistrationForm;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use Yii;

/**
 * RegistrationController is responsible for all registration process, which includes registration of a new account,
 * resending confirmation tokens, email confirmation and registration via social networks.
 *
 * @property \dektrium\user\Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class RegistrationController extends \dektrium\user\controllers\RegistrationController
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
     * @throws NotFoundHttpException
     * @throws \yii\base\ExitException
     * @throws \yii\base\InvalidConfigException
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
        $title = null;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->register()) {
                $this->trigger(self::EVENT_AFTER_REGISTER, $event);

                $title = Yii::t('user', 'Your account has been created');
                $this->redirect(Url::toRoute(['choose-role', 'id' => 'contact']), 302);
            }
        }

        return $this->render('register', [
            'title' => $title,
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
     * @return string|void
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
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

        $this->redirect(Url::home(), 302);
        \Yii::$app->getSession()->setFlash('error', 'Аккаунт активирован');
    }

    public function actionChooseRole()
    {
        return $this->render('choose-role');
    }
}
