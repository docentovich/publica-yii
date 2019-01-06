<?php

namespace users\controllers;

use users\models\UsersImage;
use users\models\UsersProfile;
use users\models\UsersUser;
use users\models\UsersUserForm;
use dektrium\user\Finder;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use ImageAjaxUpload\UploadModel;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * SettingsController manages updating user settings (e.g. profile, email and password).
 *
 * @property \dektrium\user\Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class SettingsController extends \dektrium\user\controllers\SettingsController
{
    use AjaxValidationTrait;
    use EventTrait;

    public $layout = "@current_template/layouts/user";


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
        ];
    }


    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'disconnect' => ['post'],
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
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
        /** TODO to service */
        /** @var UsersProfile $profile_model */
        $profile_model = \Yii::$app->user->identity->myProfile;
        $profile_model->scenario = UsersProfile::SCENARIO_UPDATE;
        $this->performAjaxValidation($profile_model);

        $profile_model->load(\Yii::$app->request->post());

        if ($profile_model->validate()) {
            $image_model = $profile_model->avatarNN;
            $image_model->scenario = UsersImage::SCENARIO_LOAD_FILE;
            $image_model->load(
                (new UploadModel())->upload(\Yii::$app->user->getId())->toArray(), ''
            );

            if ($image_model->validate() && $image_model->save()) {
                $profile_model->link('avatar0', $image_model);
            }
            $profile_model->save();
        }

        $this->redirect(['/']);
    }

    public function actionSaveUserForm()
    {
        /** TODO to service */
        $user_form_model = new UsersUserForm(['scenario' => UsersUserForm::SCENARIO_UPDATE]);
        $this->performAjaxValidation($user_form_model);

        if ($user_form_model->load(\Yii::$app->request->post()) && $user_form_model->validate()) {
            /** @var UsersUser  */
            $user_model = (UsersUser::findMeTo(UsersUser::SCENARIO_UPDATE));

            if ($user_model->load($user_form_model->toArray(), '') && $user_model->validate()) {
                $user_model->save();
            }
        }

        $this->redirect(['/']);
    }

    /**
     * Shows profile settings form.
     *
     * @return string|\yii\web\Response
     */
    public function actionProfile()
    {
        /** @var UsersUser $identity */
        $identity = \Yii::$app->user->identity;
        $profile = $identity->myProfile;
        $profile->scenario = UsersProfile::SCENARIO_UPDATE;

        return $this->render('profile', [
            'identity' => $identity,
            'profile' => $profile,
            'user_form' => new UsersUserForm(),
        ]);
    }

//
//    /**
//     * Удаление картинок
//     *
//     * @param $name
//     * @return mixed
//     */
//    public function actionImageDelete($name)
//    {
//        $directory = Yii::getAlias('@frontend/web/upload') . DIRECTORY_SEPARATOR . Yii::$app->session->id;
//        if (is_file($directory . DIRECTORY_SEPARATOR . $name)) {
//            unlink($directory . DIRECTORY_SEPARATOR . $name);
//        }
//
//        $files = FileHelper::findFiles($directory);
//        $output = [];
//        foreach ($files as $file) {
//            $fileName = basename($file);
//            $path = '/img/temp/' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
//            $output['files'][] = [
//                'name' => $fileName,
//                'size' => filesize($file),
//                'url' => $path,
//                'thumbnailUrl' => $path,
//                'deleteUrl' => 'image-delete?name=' . $fileName,
//                'deleteType' => 'POST',
//            ];
//        }
//        return Json::encode($output);
//    }
//
//    /** TODO standalone action */
//    public function actionSetCity()
//    {
//        if (!Yii::$app->request->isAjax) {
//            throw new HttpException(403, "this action can be access by ajax only");
//        }
//
//        $id = (int)Yii::$app->request->post('id');
//
//        Yii::$app->response->cookies->add(new  Cookie([
//            'name' => 'city_id',
//            'value' => $id
//        ]));
//
//        return '';
//    }
}
