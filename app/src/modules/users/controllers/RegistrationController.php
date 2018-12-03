<?php

namespace app\modules\users\controllers;

use app\modules\users\dto\UserServiceConfig;
use app\widgets\alert\Alert;
use dektrium\user\Finder;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
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
                    ['allow' => true, 'actions' => ['confirm', 'resend', 'choose-role'], 'roles' => ['?', '@']],
                ],
            ],
        ];
    }

    private function EVENTS($const)
    {
        $self = $this;
        return function ($event) use ($self, $const) {
            $this->trigger($const, $event);
        };
    }

    private function prepareConfig($config = []): UserServiceConfig
    {
        $self = $this;
        $config = ArrayHelper::merge($config,
            [
                'EVENT_AFTER_REGISTER' => $this->EVENTS(self::EVENT_AFTER_REGISTER),
                'EVENT_BEFORE_REGISTER' => $this->EVENTS(self::EVENT_BEFORE_REGISTER),
                'performAjaxValidation' => function ($form_model) use ($self) {
                    return $self->performAjaxValidation($form_model);
                },
                'getFormEvent' => function ($form_model) use ($self) {
                    return $self->getFormEvent($form_model);
                }
            ]
        );
        return new UserServiceConfig($config);
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
        $transport_model = \Yii::$app->userService->action(
            $this->prepareConfig([
                'action' => UserServiceConfig::ACTION_REGISTRATION,
            ])
        );

        return $this->render('register', [
            'identity' => \Yii::$app->user->identity,
            'transport_model' => $transport_model
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
        $role = \Yii::$app->getRequest()->getQueryParam('role');
        if(isset($role) && !in_array($role, ['author', 'model', 'photograph'])){
            $role = false;
            \Yii::$app->session->setFlash(
                Alert::MESSAGE_DANGER,
                \Yii::t('user', 'The role must be either \'author\' or \'model\' or \'photographer\'')
            );
        }
        if ($role) {
            $auth_manager = Yii::$app->getAuthManager();
            $auth_manager->assign($auth_manager->getRole($role), \Yii::$app->user->getId());
            \Yii::$app->session->setFlash(
                Alert::MESSAGE_SUCCESS,
                ['position' => 'top', 'message' => \Yii::t('user', 'You have successfully changed the role!')]
            );
            \Yii::$app->getResponse()->redirect(Url::toRoute(['/']), 302);
            return;
        }
        return $this->render('choose-role');
    }
}
