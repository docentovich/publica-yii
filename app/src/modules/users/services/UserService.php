<?php

namespace app\modules\users\services;

use app\dto\ConfigQuery;
use app\models\User;
use app\models\UserForm;
use app\modules\users\dto\UserServiceConfig;
use app\modules\users\dto\UserTransportModel;
use app\widgets\alert\Alert;
use yii\db\IntegrityException;
use yii\helpers\Url;

class UserService extends \app\abstractions\Services
{
    /**
     * @param UserServiceConfig $config
     * @return UserTransportModel
    */
    public function action(\app\interfaces\config $config): \app\dto\TransportModel
    {
        switch ($config->action) {
            case UserServiceConfig::ACTION_REGISTRATION:
                return new UserTransportModel(new ConfigQuery($config), $this->registration($config));
        }
    }

    /**
     * After successful registration if enableConfirmation is enabled shows info message otherwise
     * redirects to choose role.
     *
     * @param UserServiceConfig $config
     * @return array
     * @throws \Exception
     */
    private function registration(UserServiceConfig $config)
    {
        $config->user_form_model = new UserForm();
        $event = $config->getFormEvent($config->user_form_model);
        $config->EVENT_BEFORE_REGISTER($event);
        $config->performAjaxValidation($config->user_form_model);
        $return = ['title' => ''];

        if ($config->user_form_model->load(\Yii::$app->request->post()) && $config->user_form_model->validate()) {
            /** @var \app\models\User $user */
            $user = User::registerNewUser($config->user_form_model->toArray());

            if ($this->saveUser($user)){
                $config->EVENT_AFTER_REGISTER($event);

                if(!\Yii::$app->getModule('user')->enableUnconfirmedLogin){
                    /** TODO implements logic when user confirm is required  */
                }else{ // login if  user confirm is not required
                    \Yii::$app->getUser()->login($user);
                    \Yii::$app->getResponse()->redirect(Url::toRoute(['choose-role']), 302);
                }

                $return = ['title' => \Yii::t('user', 'Your account has been created')];
            }
        }

        return $return;
    }

    private function saveUser(User $user)
    {
        if(!$user->validate()){
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