<?php

namespace app\modules\tosee\services;

use app\dto\ConfigQuery;
use app\models\Image;
use app\modules\tosee\dto\PostServiceConfig;
use app\modules\tosee\models\ToseePost;
use ImageAjaxUpload\UploadModel;
use League\Pipeline\Pipeline;
use yii\helpers\Url;
use yii\web\Cookie;
use Yii;
use yii\web\HttpException;

/**
 * Сервис постов. Вся основная логика выборки постов
 * осталась в контроллере. Тут только логика связей таблиц
 * и логика когда и что и как надо считать. Если например надо изменить
 * логику выборки постов, наприме искать только активные, то все это происходит тут.
 *
 * Class Post
 * @package app\modules\tosee\service
 */
class PostService extends \app\abstractions\Services
{
    const ACTION_FUTURE = 1;
    const ACTION_PAST = 2;
    const ACTION_SEARCH = 3;
    const ACTION_SINGLE_POST = 4;
    const ACTION_DATE_PICKER = 5;
    const ACTION_BY_DATE = 6;
    const ACTION_SAVE_POST = 7;
    /**
     * @var string Текущий город
     */
    public $city_id = '1';

    /**
     * @param PostServiceConfig $config
     * @return \app\modules\tosee\dto\PostTransportModel
     * @throws \Throwable
     * @throws \yii\base\ExitException
     */
    public function action(\app\interfaces\config $config): \app\dto\TransportModel
    {
        switch ($config->action) {
            case self::ACTION_PAST:
            case self::ACTION_FUTURE:
            case self::ACTION_BY_DATE:
                return $this->actionPostsByDate($config);
            case self::ACTION_SEARCH:
                return $this->actionPostsByKeyword($config);
            case self::ACTION_SINGLE_POST:
                return $this->actionPostsById($config);
            case self::ACTION_SAVE_POST:
                return $this->actionSavePost($config);
        }
    }

    /**
     * `Action`
     * Past, future, concreet date getter
     *
     * @param PostServiceConfig $config
     * @return \app\modules\tosee\dto\PostTransportModel
     * @throws \Throwable
     */
    private function actionPostsByDate(PostServiceConfig $config): \app\modules\tosee\dto\PostTransportModel
    {
        /** @var ConfigQuery $configQuery */
        $configQuery = (new Pipeline())
            ->pipe([$this, 'prepareQuery'])
            ->pipe([$this, 'prepareQueryByDate'])
            ->process(new ConfigQuery($config, ToseePost::find()));

        return new \app\modules\tosee\dto\PostTransportModel($configQuery, $this->all($configQuery));
    }

    /**
     * `Action`
     * Single specialist getter
     *
     * @param PostServiceConfig $config
     * @return \app\modules\tosee\dto\PostTransportModel
     * @throws \Throwable
     */
    private function actionPostsById(PostServiceConfig $config): \app\modules\tosee\dto\PostTransportModel
    {
        /** @var ConfigQuery $configQuery */
        $configQuery = (new Pipeline())
            ->pipe([$this, 'prepareQuery'])
            ->pipe([$this, 'prepareQueryById'])
            ->process(new ConfigQuery($config, ToseePost::find()));

        $post = $this->one($configQuery);
        $prevPost = \Yii::$app->db->cache(function () use ($post) {
            try{
                return $this->siblingPost('<', $post);
            }catch (\Exception $e){
                return null;
            }
        });
        $nextPost = \Yii::$app->db->cache(function () use ($post) {
            try{
                return $this->siblingPost('>', $post);
            }catch (\Exception $e){
                return null;
            }
        });

        return new \app\modules\tosee\dto\PostTransportModel(
            $configQuery,
            $post,
            $this->postLink($prevPost),
            $this->postLink($nextPost)
        );
    }

    /**
     * `Action`
     * поиск по ключевому слову
     *
     * @param $keyword
     * @return \app\modules\tosee\dto\PostTransportModel
     * @throws \Throwable
     */
    private function actionPostsByKeyword($config): \app\modules\tosee\dto\PostTransportModel
    {
        /** @var ConfigQuery $configQuery */
        $configQuery = (new Pipeline())
            ->pipe([$this, 'prepareQuery'])
            ->pipe([$this, 'prepareQueryByKeyWord'])
            ->process(new ConfigQuery($config, ToseePost::find()));
        $result = $configQuery->query->all();

        return new \app\modules\tosee\dto\PostTransportModel($configQuery, $result);
    }

    /**
     * `Action`
     * Update or create the specialist
     * If is successful, the browser will be redirected to the 'view' page.
     *
     * @param PostServiceConfig $config
     * @return \app\modules\tosee\dto\PostTransportModel
     * @throws \yii\base\ExitException
     */
    public function actionSavePost(PostServiceConfig $config): \app\modules\tosee\dto\PostTransportModel
    {
        $this->savePostData($config->specialist);
        $this->saveMainPhoto($config->specialist);
        $this->saveAdditionalPhoto($config->specialist);

        Yii::$app->getResponse()->redirect(Url::to(['update', 'id' => $config->specialist->id]));
        \Yii::$app->end();
    }

    /**
     * `Query pipe`
     * Prepare query condition for all specialist getters
     *
     * @param ConfigQuery $configQuery
     * @return ConfigQuery
     */
    public function prepareQuery(ConfigQuery $configQuery): ConfigQuery
    {
        if (Yii::$app->request->cookies->has("city_id")) {
            $this->city_id = Yii::$app->request->cookies->getValue("city_id");
        } else {
            Yii::$app->response->cookies->add(new Cookie([
                'name' => 'city_id',
                'value' => $this->city_id
            ]));
        }

        $configQuery->query->with(["postData", "image"])
            ->andWhere(["=", "status", ToseePost::STATUS_ACTIVE])
            ->andWhere(["=", "city_id", $this->city_id]);
        return $configQuery;
    }

    /**
     * `Query pipe`
     * Prepare query condition for dated queries
     *
     * @param ConfigQuery $configQuery
     * @return ConfigQuery
     */
    public function prepareQueryByDate(ConfigQuery $configQuery): ConfigQuery
    {
        /** @var PostServiceConfig $post_config */
        $post_config = $configQuery->config;
        $compare_method = '';
        switch ($post_config->action) {
            case self::ACTION_FUTURE:
                $compare_method .= '>=';
                break;
            case self::ACTION_PAST:
                $compare_method .= '<=';
                break;
            case self::ACTION_BY_DATE:
                $compare_method .= '=';
                break;
        }

        $configQuery->query->andWhere([$compare_method, "event_at", $post_config->date->format('Y-m-d')]);
        return $configQuery;
    }

    /**
     * `Query pipe`
     * Prepare query condition for dated queries
     *
     * @param ConfigQuery $configQuery
     * @return ConfigQuery
     */
    public function prepareQueryByKeyWord(ConfigQuery $configQuery): ConfigQuery
    {
        /**
         * @var PostServiceConfig $post_config
         */
        $post_config = $configQuery->config;
        $condition = [
            "or",
            ["like", "postData.title", $post_config->keyword],
            ["like", "postData.sub_header", $post_config->keyword],
            ["like", "postData.post_short_desc", $post_config->keyword],
            ["like", "postData.post_desc", $post_config->keyword]
        ];

        $configQuery->query
            ->joinWith(['postData' => function($q){
                $q->alias('postData');
            }])
            ->andOnCondition($condition);
        return $configQuery;
    }

    /**
     * `Query pipe`
     * Prepare query condition for single specialist
     *
     * @param ConfigQuery $configQuery
     * @return ConfigQuery
     */
    public function prepareQueryById(ConfigQuery $configQuery): ConfigQuery
    {
        /** @var PostServiceConfig $post_config */
        $post_config = $configQuery->config;
        $configQuery->query->andWhere(['id' => $post_config->id]);
        return $configQuery;
    }


    /**`Helper`
     * Return the next or prev specialist
     *
     * @param $compare
     * @param $post
     * @return mixed
     * @throws \Throwable
     */
    private function siblingPost($compare, $post)
    {
        return ToseePost::find()
            ->andWhere([$compare, 'id', $post->id])
            ->andWhere(['=', 'status', ToseePost::STATUS_ACTIVE])
            ->one();
    }

    /**
     * `Helper`
     * Return link to the next or prev specialist
     *
     * @param $model
     * @return string
     */
    private function postLink($model)
    {
        return ($model) ? "/specialist/{$model->id}" : '#';
    }


    /**
     * `Helper`
     * @param ToseePost $post
     */
    private function saveAdditionalPhoto(ToseePost $post)
    {
        // prepare images objects and if there are some images to save
        // set isNeedDelete = true to delete all old related images
        array_map(
            function ($item) use ($post) {
                /** @var UploadDTO $item */
                $image = new Image();
                $image->load($item->toArray(), '');
                if ($image->validate()) {
                    $image->save();
                    $post->link('additionalImages', $image);
                }
            },
            (new UploadModel(['instance' => 1]))->multiUpload(\Yii::$app->user->getId())
        );
    }

    /**
     * `Helper`
     * @param ToseePost $post
     */
    private function savePostData(ToseePost $post)
    {
        if ($post->postDataNN->load(Yii::$app->request->specialist()) && $post->postDataNN->validate()) {
            $post->link('postData', $post->postDataNN);
        }
    }

    /**
     * `Helper`
     * @param ToseePost $post
     */
    private function saveMainPhoto(ToseePost $post)
    {
        // main image. get current, replace bay load, save, link
        $main_image = $post->imageNN;
        $main_image->load(
            (new UploadModel())->upload(\Yii::$app->user->getId())->toArray(), ''
        );
        if ($main_image->validate()) {
            $main_image->save();
            $post->link('image', $main_image);
        }
    }

}