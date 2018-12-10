<?php

namespace app\modules\users\services;

use app\dto\ConfigQuery;
use app\models\User;
use app\models\UserForm;
use app\modules\users\dto\UserServiceConfig;
use app\modules\users\dto\UserTransportModel;
use app\modules\users\events\UserFormEvent;
use app\widgets\Alert;
use yii\db\IntegrityException;
use yii\helpers\Url;

class UserService extends \app\abstractions\Services
{
    const EVENT_BEFORE_REGISTER = 'beforeRegister';
    const EVENT_AFTER_REGISTER = 'afterRegister';

    const ACTION_REGISTRATION = 1;
    const ACTION_CHOOSE_ROLE = 2;

    /**
     * @param UserServiceConfig $config
     * @return UserTransportModel
     * @throws \Exception
     */
    public function action(\app\interfaces\config $config): \app\dto\TransportModel
    {
        $this->beforeAction($config);
        switch ($config->action) {
            case self::ACTION_REGISTRATION:
                return $this->actionRegistration($config);
            case self::ACTION_CHOOSE_ROLE:
                return $this->actionChooseRole($config);
        }
    }

    /**
     * Decorate all actions call.
     * @param UserServiceConfig $config
     */
    private function beforeAction(\app\interfaces\config $config)
    {

    }

    public function init()
    {
        parent::init();
        $this->on(self::EVENT_AFTER_REGISTER, function ($event) {
            if (!isset($event->userForm, $event->userForm->id)) {
                return;
            }
            /** @var UserFormEvent $event */
            $id = $event->userForm->id; // registered user id
            $auth_manager = \Yii::$app->getAuthManager();
            $auth_manager->assign($auth_manager->getRole("user"), $id);
        });
    }

    /**
     * After successful registration if enableConfirmation is enabled shows info message otherwise
     * redirects to choose role.
     *
     * @param UserServiceConfig $config
     * @return UserTransportModel
     * @throws \Exception
     */
    private function actionRegistration(UserServiceConfig $config)
    {
        $this->trigger(self::EVENT_BEFORE_REGISTER);
        $return = ['title' => ''];

        if ($config->userFormModel->load(\Yii::$app->request->post()) && $config->userFormModel->validate()) {
            /** @var \app\models\User $user */
            $user = User::registerNewUser($config->userFormModel->toArray());

            if ($this->saveUser($user)) {
                // it's a hack. i need to send users id to EVENT_AFTER_REGISTER
                // but i receive it normally in EVENT_AFTER_CONFIRM.
                // To forward id through event system i change UserForm Model. Now
                // it contains id and send it in event object.
                $config->userFormModel->id = $user->id;
                $this->trigger(self::EVENT_AFTER_REGISTER, new UserFormEvent(['userForm' => $config->userFormModel]));
                if (!\Yii::$app->getModule('user')->enableUnconfirmedLogin) {
                    // TODO implements logic when user confirm is required
                } else { // login if  user confirm is not required
                    \Yii::$app->getUser()->login($user);
                    \Yii::$app->getResponse()->redirect(Url::toRoute(['choose-role']), 302);
                    \Yii::$app->end();
                }

                $return = ['title' => \Yii::t('app/user', 'Your account has been created')];
            }
        }


        return new UserTransportModel(new ConfigQuery($config), $return);
    }

    private function actionChooseRole(UserServiceConfig $config)
    {
        $role = \Yii::$app->getRequest()->getQueryParam('role');
        if (isset($role) && !in_array($role, ['author', 'model', 'photograph'])) {
            $role = false;
            \Yii::$app->session->setFlash(
                Alert::MESSAGE_DANGER,
                \Yii::t('app/user', 'The role must be either \'author\' or \'model\' or \'photographer\'')
            );
        }
        if ($role) {
            $auth_manager = \Yii::$app->getAuthManager();
            $auth_manager->assign($auth_manager->getRole($role), \Yii::$app->user->getId());
            \Yii::$app->session->setFlash(
                Alert::MESSAGE_SUCCESS,
                ['position' => 'top', 'message' => \Yii::t('app/user', 'You have successfully changed the role!')]
            );
            \Yii::$app->getResponse()->redirect(Url::toRoute(['/']), 302);
            \Yii::$app->end();
        }

        return new UserTransportModel(new ConfigQuery($config), []);
    }

    /**
     * Save user and slash some messages to user
     *
     * @param User $user
     * @return bool
     * @throws \Exception
     */
    private function saveUser(User $user)
    {
        if (!$user->validate()) {
            return false;
        }
        try {
            if ($user->save()) {
                \Yii::$app->session->setFlash(
                    Alert::MESSAGE_SUCCESS,
                    $user->scenariosSuccessMessages()[$user->scenario]
                );
                return true;
            }
        } catch (IntegrityException $e) {
            // TODO normal check if user name or email already exist
            // now the system does not distinguish what column are no unique
            \Yii::$app->session->setFlash(
                Alert::MESSAGE_DANGER,
                \Yii::t('app/user', 'User already exist')
            );
        } catch (\Exception $e) {
            throw $e;
        }

        return false;
    }



}