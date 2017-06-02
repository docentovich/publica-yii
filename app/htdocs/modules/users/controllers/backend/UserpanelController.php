<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace modules\users\controllers\backend;

use common\models\UploadForm;
use dektrium\user\Finder;
use modules\tosee\models\common\Post;
use modules\users\models\Profile;
use dektrium\user\models\SettingsForm;
use dektrium\user\models\User;
use dektrium\user\Module;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use Yii;
use yii\imagine\Image;
use common\models\Image as _ImageModel;
use dektrium\user\controllers\SettingsController as BaseSettingsController;

/**
 * SettingsController manages updating user settings (e.g. profile, email and password).
 *
 * @property \dektrium\user\Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class UserpanelController extends BaseSettingsController
{
    use AjaxValidationTrait;
    use EventTrait;


    /** @var Finder */
    protected $finder;


//    /**
//     * @inheritdoc
//     */
//    public function actions()
//    {
//        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ]
//        ];
//    }
//
//
//    /** @inheritdoc */
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'disconnect' => ['post'],
//                    'delete' => ['post'],
//                ],
//            ],
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => ['profile', 'account', 'networks', 'disconnect', 'delete', 'upload'],
//                        'roles' => ['@'],
//                    ],
//                    [
//                        'allow' => true,
//                        'actions' => ['confirm'],
//                        'roles' => ['?', '@'],
//                    ],
//                ],
//            ],
//        ];
//    }

    /**
     * Shows profile settings form.
     *
     * @return string|\yii\web\Response
     */
    public function actionProfile()
    {

        //Профиль

        $model_profile = $this->finder->findProfileById(\Yii::$app->user->identity->getId());


        if ($model_profile == null) {
            $model_profile = \Yii::createObject(Profile::className());
            $model_profile->link('user', \Yii::$app->user->identity);
        }
        $model_profile->link('user', \Yii::$app->user->identity);

        $event = $this->getProfileEvent($model_profile);

        $this->performAjaxValidation($model_profile);

        $this->trigger(self::EVENT_BEFORE_PROFILE_UPDATE, $event);
        if ($model_profile->load(\Yii::$app->request->post()) && $model_profile->save()) {

            \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'Your profile has been updated'));
            $this->trigger(self::EVENT_AFTER_PROFILE_UPDATE, $event);
            return $this->refresh();
        }


        //Settings
        /** @var SettingsForm $model */
        $model_settings = \Yii::createObject(SettingsForm::className());

        $event = $this->getFormEvent($model_settings);

        $this->performAjaxValidation($model_settings);

        $this->trigger(self::EVENT_BEFORE_ACCOUNT_UPDATE, $event);
        if ($model_settings->load(\Yii::$app->request->post()) && $model_settings->save()) {

            \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'Your account details have been updated'));
            $this->trigger(self::EVENT_AFTER_ACCOUNT_UPDATE, $event);
            return $this->refresh();

        }

        $upload = new UploadForm;

        return $this->render('profile', [
            'model_profile' => $model_profile,
            'model_settings' => $model_settings,
            'upload' => $upload,
            'module' => $this->module,
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
    public function actionAvatarUpload()
    {
        if (!Yii::$app->request->isAjax) {
            throw new \Exception("this action can be access by ajax only");
        }

        $model = new Profile();

        if ($model->load(\Yii::$app->request->post() && $model->save())) {
            echo $model->image->json;
        }


//        $model = new UploadForm();
//        $profile = $this->finder->findProfileById(\Yii::$app->user->identity->getId());
//        $image_model = _ImageModel::find()->where(["=", "id", "1"])->one();
//
//        $imageFile = UploadedFile::getInstance($model, 'file');
//
//        $directory = Yii::getAlias('@frontend/web/uploads') . DIRECTORY_SEPARATOR . \Yii::$app->user->identity->getId() . DIRECTORY_SEPARATOR;
//
//
//        if ($imageFile) {
//            if (!is_dir($directory)) {
//                FileHelper::createDirectory($directory);
//            }
//
//            $uid = uniqid();
//            $fileName = $uid . '.' . $imageFile->extension;
//            $filePath = $directory . $fileName;
//            if ($imageFile->saveAs($filePath)) {
//                $path = '/uploads/' . Yii::$app->user->identity->getId() . DIRECTORY_SEPARATOR . $fileName;
//
//                $a = Yii::$app->user->identity->getId();
//                $profile->image->patch = $a;
//                $profile->image->name = $uid;
////                    $image_model->alt = "";
//                $profile->image->extension = $imageFile->extension;
//                $profile->image->save(false);
//
//
//                $imageFile->reset();
//
//                Image::thumbnail($filePath, 160, 200)->save($filePath . '_160x200.jpg',
//                    ['quality' => 70]);
//
//                Image::getImagine()->open($filePath)->save($filePath . '_origin.jpg',
//                    ['quality' => 70]);
//
//                return Json::encode([
//                    'files' => [
//                        [
//                            'name' => $fileName,
//                            'size' => $imageFile->size,
//                            'url' => $path,
//                            'thumbnailUrl' => $path,
//                            'deleteUrl' => 'image-delete?name=' . $fileName,
//                            'deleteType' => 'POST',
//                        ],
//                    ],
//                ]);
//            }
//        }

        return '';
    }

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
}
