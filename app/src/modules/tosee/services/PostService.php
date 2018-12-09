<?php

namespace app\modules\tosee\services;

use app\dto\ConfigQuery;
use app\modules\tosee\dto\PostServiceConfig;
use app\modules\tosee\models\Post;
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
            ->process(new ConfigQuery($config, Post::find()));

        return new \app\modules\tosee\dto\PostTransportModel($configQuery, $this->all($configQuery));
    }

    /**
     * `Action`
     * Single post getter
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
            ->process(new ConfigQuery($config, Post::find()));

        $post = $this->one($configQuery);
        $prevPost = \Yii::$app->db->cache(function () use ($post) {
            return $this->siblingPost('<', $post);
        });
        $nextPost = \Yii::$app->db->cache(function () use ($post) {
            return $this->siblingPost('>', $post);
        });

        return new \app\modules\tosee\dto\PostTransportModel(
            $configQuery,
            $post,
            $this->postLink($prevPost),
            $this->postLink($nextPost),
            (Yii::$app->user->can('user') && )
        );
    }

    /**
     * `Action`
     * поиск по ключевому слову
     *
     * @param string $keyword
     * @return $this
     */
    private function actionPostsByKeyword($keyword): \app\modules\tosee\dto\PostTransportModel
    {
        /** TODO implements method */
        $params = [
            "or",
            ["like", "title", $keyword],
            ["like", "sub_header", $keyword],
            ["like", "post_short_desc", $keyword],
            ["like", "post_desc", $keyword]
        ];

        $this->_query
            ->leftJoin(PostData::tableName(), PostData::tableName() . '.`post_id` = {{%post}}.`id`');

        $this->getMany($params);
        $this->url = "/%i%?keyword=$keyword";

        return $this;
    }

    /**
     * `Action`
     * Update or create the post
     * If is successful, the browser will be redirected to the 'view' page.
     *
     * @param PostServiceConfig $config
     * @return \app\modules\tosee\dto\PostTransportModel
     * @throws \yii\base\ExitException
     */
    public function actionSavePost(PostServiceConfig $config): \app\modules\tosee\dto\PostTransportModel
    {
        $this->savePostData($config->post);
        $this->saveMainPhoto($config->post);
        $this->saveAdditionalPhoto($config->post);

        Yii::$app->getResponse()->redirect(Url::to(['update', 'id' => $config->post->id]));
        \Yii::$app->end();
    }

    /**
     * `Query pipe`
     * Prepare query condition for all post getters
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
            ->andWhere(["=", "status", Post::STATUS_ACTIVE])
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
     * Prepare query condition for single post
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
     * Return the next or prev post
     *
     * @param $compare
     * @param $post
     * @return mixed
     * @throws \Throwable
     */
    private function siblingPost($compare, $post)
    {
        return Post::find()
            ->andWhere([$compare, 'id', $post->id])
            ->andWhere(['=', 'status', Post::STATUS_ACTIVE])
            ->one();
    }

    /**
     * `Helper`
     * Return link to the next or prev post
     *
     * @param $model
     * @return string
     */
    private function postLink($model)
    {
        return ($model) ? "/post/{$model->id}" : '#';
    }


    /**
     * `Helper`
     * @param Post $post
     */
    private function saveAdditionalPhoto(Post $post)
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
     * @param Post $post
     */
    private function savePostData(Post $post)
    {
        if ($post->postDataNN->load(Yii::$app->request->post()) && $post->postDataNN->validate()) {
            $post->link('postData', $post->postDataNN);
        }
    }

    /**
     * `Helper`
     * @param Post $post
     */
    private function saveMainPhoto(Post $post)
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