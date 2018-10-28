<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\modules\users\controllers\backend;

use app\models\Image;
use app\models\UserForm;
use app\widgets\alert\Alert;
use dektrium\user\Finder;
use dektrium\user\models\SettingsForm;
use app\models\User;
use dektrium\user\Module;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use ImageAjaxUpload\UploadAction;
use ImageAjaxUpload\UploadModel;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Cookie;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use Yii;
use app\models\Profile;
use dektrium\user\controllers\SettingsController as BaseSettingsController;
use yii\web\UploadedFile;

/**
 * SettingsController manages updating user settings (e.g. profile, email and password).
 *
 * @property \dektrium\user\Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class UserPanelController extends BaseSettingsController
{
    use AjaxValidationTrait;
    use EventTrait;


    /** @var Finder */
    protected $finder;


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'upload-avatar' => [
                'class' => UploadAction::class,
//                'upload_dir' => \Yii::getAlias('@uploads') . '/' . \Yii::$app->user->getId()
            ],
        ];
    }


    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'disconnect' => ['post'],
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['account', 'save-user-form', 'save-profile-form', 'networks', 'disconnect', 'delete', 'upload-avatar', 'set-city'],
                        'roles' => ['user'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['profile'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['confirm'],
                        'roles' => ['?', '@'],
                    ],
                ],
            ],
        ];
    }

    public function actionSaveProfileForm()
    {
        /** @var Profile $profile_model */
        $profile_model = \Yii::$app->user->identity->profile;
        $profile_model->scenario = Profile::SCENARIO_UPDATE;
        $this->performAjaxValidation($profile_model);

        $profile_model->load(\Yii::$app->request->post());

        if ($profile_model->validate()) {
            $image_model = $profile_model->avatar0 ?? new Image();
            $image_model->scenario = Image::SCENARIO_LOAD_FILE;
            $image_model->load((new UploadModel())->upload(\Yii::$app->user->getId()), '');

            if ($image_model->validate() && $image_model->save()) {
                $profile_model->link('avatar0', $image_model);
            }
            $profile_model->save();
        }

        $this->redirect(['/']);
    }

    public function actionSaveUserForm()
    {
        $user_form_model = new UserForm();
        $this->performAjaxValidation($user_form_model);

        if ($user_form_model->load(\Yii::$app->request->post()) && $user_form_model->validate()) {
            /** @var \app\models\User $user_model */
            $user_model = (User::findMeTo(User::SCENARIO_UPDATE));
            $this->redirect('/admin/');
            return ($user_model->load($user_form_model->toArray(), '') && $user_model->save());
        }

        return false;
    }

    /**
     * Shows profile settings form.
     *
     * @return string|\yii\web\Response
     */
    public function actionProfile()
    {
        //TODO Refactor!!

        //Профиль

//        /*$model_profile = $this->finder->findProfileById(\Yii::$app->user->identity->getId());
//
//
//        if ($model_profile == null) {
//            $model_profile = \Yii::createObject(Profile::className());
//            $model_profile->link('user', \Yii::$app->user->identity);
//        }
//        $model_profile->link('user', \Yii::$app->user->identity);
//
//        $event = $this->getProfileEvent($model_profile);
//
//        $this->performAjaxValidation($model_profile);
//
//        $this->trigger(self::EVENT_BEFORE_PROFILE_UPDATE, $event);
//        if ($model_profile->load(\Yii::$app->request->post()) && $model_profile->save()) {
//
//            \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'Your profile has been updated'));
//            $this->trigger(self::EVENT_AFTER_PROFILE_UPDATE, $event);
//            return $this->refresh();
//        }
//
//
//        //Settings
//        /** @var SettingsForm $model */
//        $model_settings = \Yii::createObject(SettingsForm::className());
//
//        $event = $this->getFormEvent($model_settings);
//
//        $this->performAjaxValidation($model_settings);
//
//        $this->trigger(self::EVENT_BEFORE_ACCOUNT_UPDATE, $event);
//        if ($model_settings->load(\Yii::$app->request->post()) && $model_settings->save()) {
//
//            \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'Your account details have been updated'));
//            $this->trigger(self::EVENT_AFTER_ACCOUNT_UPDATE, $event);
//            return $this->refresh();
//
//        }
//
//        $upload = new UploadImage;
//
//
//        return $this->render('profile', [
//            'model_profile' => $model_profile,
//            'model_settings' => $model_settings,
//            'upload' => $upload,
//            'module' => $this->module,
//        ]);*/

        return $this->render('profile', [
            'user_form' => new UserForm(),
        ]);
    }

    /**
     * Displays page where user can update account settings (username, email or password).
     *
     * @return string|\yii\web\Response
     */
    public function actionAccount()
    {
        /** @var SettingsForm $model */
        $model = \Yii::createObject(SettingsForm::className());
        $event = $this->getFormEvent($model);

        $this->performAjaxValidation($model);

        $this->trigger(self::EVENT_BEFORE_ACCOUNT_UPDATE, $event);


        if ($model->load(\Yii::$app->request->post()) && $model->save()) {

            \Yii::$app->session->setFlash('success', \Yii::t('user', 'Your account details have been updated'));
            $this->trigger(self::EVENT_AFTER_ACCOUNT_UPDATE, $event);
            return $this->refresh();

        }

        return $this->render('account', [
            'model' => $model,
        ]);
    }

    /**
     * Attempts changing user's email address.
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

        if ($user === null || $this->module->emailChangeStrategy == Module::STRATEGY_INSECURE) {
            throw new NotFoundHttpException();
        }

        $event = $this->getUserEvent($user);

        $this->trigger(self::EVENT_BEFORE_CONFIRM, $event);
        $user->attemptEmailChange($code);
        $this->trigger(self::EVENT_AFTER_CONFIRM, $event);

        return $this->redirect(['account']);
    }

    /**
     * Displays list of connected network accounts.
     *
     * @return string
     */
    public function actionNetworks()
    {
        return $this->render('networks', [
            'user' => \Yii::$app->user->identity,
        ]);
    }

    /**
     * Disconnects a network account from user.
     *
     * @param int $id
     *
     * @return \yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     * @throws \yii\web\ForbiddenHttpException
     */
    public function actionDisconnect($id)
    {
        $account = $this->finder->findAccount()->byId($id)->one();

        if ($account === null) {
            throw new NotFoundHttpException();
        }
        if ($account->user_id != \Yii::$app->user->id) {
            throw new ForbiddenHttpException();
        }

        $event = $this->getConnectEvent($account, $account->user);

        $this->trigger(self::EVENT_BEFORE_DISCONNECT, $event);
        $account->delete();
        $this->trigger(self::EVENT_AFTER_DISCONNECT, $event);

        return $this->redirect(['networks']);
    }

    /**
     * Completely deletes user's account.
     *
     * @return \yii\web\Response
     * @throws \Exception
     */
    public function actionDelete()
    {
        if (!$this->module->enableAccountDelete) {
            throw new NotFoundHttpException(\Yii::t('user', 'Not found'));
        }

        /** @var User $user */
        $user = \Yii::$app->user->identity;
        $event = $this->getUserEvent($user);

        \Yii::$app->user->logout();

        $this->trigger(self::EVENT_BEFORE_DELETE, $event);
        $user->delete();
        $this->trigger(self::EVENT_AFTER_DELETE, $event);

        \Yii::$app->session->setFlash('info', \Yii::t('user', 'Your account has been completely deleted'));

        return $this->goHome();
    }

    /**
     * Загрузка автарок.
     *
     * @return string
     * @throws \Exception Если не ajax
     */
//    public function actionUploadAvatar()
//    {
//        if (!Yii::$app->request->isAjax) {
//            throw new \Exception("this action can be access by ajax only");
//        }
//
//
//        $profile = Profile::find()->where(["=", "user_id", Yii::$app->user->getId()])->one();
//
//        $upload_model = new UploadImage;
//
//        if ($upload_model->upload(["160x200"])) {
//
//            $profile->avatar0->path = $upload_model->path;
//            $profile->avatar0->name = $upload_model->new_name;
//
//            if ($profile->avatar0->save()) {
//                echo json_encode($upload_model->json);
//            }
//        }
//
//
//        return '';
//    }

    /**
     * Удаление картинок
     *
     * @param $name
     * @return mixed
     */
    public function actionImageDelete($name)
    {
        $directory = Yii::getAlias('@frontend/web/upload') . DIRECTORY_SEPARATOR . Yii::$app->session->id;
        if (is_file($directory . DIRECTORY_SEPARATOR . $name)) {
            unlink($directory . DIRECTORY_SEPARATOR . $name);
        }

        $files = FileHelper::findFiles($directory);
        $output = [];
        foreach ($files as $file) {
            $fileName = basename($file);
            $path = '/img/temp/' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
            $output['files'][] = [
                'name' => $fileName,
                'size' => filesize($file),
                'url' => $path,
                'thumbnailUrl' => $path,
                'deleteUrl' => 'image-delete?name=' . $fileName,
                'deleteType' => 'POST',
            ];
        }
        return Json::encode($output);
    }

    public function actionSetCity()
    {
        if (!Yii::$app->request->isAjax) {
            throw new HttpException(403, "this action can be access by ajax only");
        }

        $id = (int)Yii::$app->request->post('id');

        Yii::$app->response->cookies->add(new  Cookie([
            'name' => 'city_id',
            'value' => $id
        ]));

        return '';
    }
}
