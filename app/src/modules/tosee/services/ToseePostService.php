<?php

namespace tosee\services;

use app\dto\ConfigQuery;
use app\modules\tosee\dto\PostConfigQuery;
use ImageAjaxUpload\UploadDTO;
use tosee\dto\PostServiceConfig;
use tosee\dto\PostTransportModel;
use ImageAjaxUpload\UploadModel;
use League\Pipeline\Pipeline;
use tosee\models\ToseeImage;
use tosee\models\ToseePost;
use tosee\models\ToseePostQuery;
use yii\helpers\Url;

class ToseePostService extends \app\services\BasePostService
{
    const ACTION_FUTURE = 1;
    const ACTION_PAST = 2;
    const ACTION_SEARCH = 3;
    const ACTION_SINGLE_POST = 4;
    const ACTION_DATE_PICKER = 5;
    const ACTION_BY_DATE = 6;
    const ACTION_SAVE_POST = 7;

    /** @var \app\services\BaseSearchService */
    protected $searchService;

    /**
     * @param PostServiceConfig $config
     * @return PostTransportModel
     * @throws \Throwable
     * @throws \yii\base\ExitException
     */
    public function action(\app\interfaces\config $config): \app\dto\TransportModel
    {
        $this->beforeAction($config);
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

    public function beforeAction(&$config)
    {
        $config->configFromQueryParams = new PostServiceConfig(\Yii::$app->request->get('config'));
    }

    public function setSearchService($service)
    {
        $this->searchService = $service;
    }

    public function getSearchService()
    {
        return $this->searchService;
    }

    /**
     * `Action`
     * Past, future, concreet date getter
     *
     * @param PostServiceConfig $config
     * @return PostTransportModel
     * @throws \Throwable
     */
    protected function actionPostsByDate(PostServiceConfig $config): PostTransportModel
    {
        /** @var ConfigQuery $configQuery */
        $configQuery = (new Pipeline())
            ->pipe([$this, 'prepareQuery'])
            ->pipe([$this, 'prepareCityQuery'])
            ->pipe([$this, 'prepareQueryByDate'])
            ->process(new ConfigQuery($config, ToseePost::find()));

        return new PostTransportModel($configQuery, $this->all($configQuery));
    }

    /**
     * `Action`
     * Single post getter
     *
     * @param PostServiceConfig $config
     * @return PostTransportModel
     * @throws \Throwable
     */
    protected function actionPostsById(PostServiceConfig $config): PostTransportModel
    {
        /** @var ConfigQuery $configQuery */
        $configQuery = (new Pipeline())
            ->pipe([$this, 'prepareQuery'])
            ->pipe([$this, 'prepareQueryById'])
            ->process(new ConfigQuery($config, ToseePost::find()));

        $post = $this->one($configQuery);

        $prevPost = $this->siblingPost(
            $config->configFromQueryParams->action !== self::ACTION_PAST ? '<' : '>',
            $post,
            $config
        );

        $nextPost = $this->siblingPost(
            $config->configFromQueryParams->action !== self::ACTION_PAST ? '>' : '<',
            $post,
            $config
        );

        return new PostTransportModel(
            $configQuery,
            $post,
            $prevPost,
            $nextPost
        );
    }

    /**
     * `Action`
     * поиск по ключевому слову
     *
     * @param PostServiceConfig $config
     * @return PostTransportModel
     * @throws \Throwable
     */
    protected function actionPostsByKeyword(PostServiceConfig $config): PostTransportModel
    {
        $config->keyword = \Yii::$app->request->get('keyword');

        /** @var ConfigQuery $configQuery */
        $configQuery = (new Pipeline())
            ->pipe([$this, 'prepareQuery'])
            ->pipe([$this, 'prepareCityQuery'])
            ->pipe([$this, 'prepareQueryByKeyWord'])
            ->process(new ConfigQuery($config, ToseePost::find()));

        return PostTransportModel::build(
            $this->searchService->search($configQuery, '/project/front-post/post')
        );
    }

    /**
     * `Action`
     * Update or create the post
     * If is successful, the browser will be redirected to the 'view' page.
     *
     * @param PostServiceConfig $config
     * @return PostTransportModel
     * @throws \yii\base\ExitException
     */
    protected function actionSavePost(PostServiceConfig $config): PostTransportModel
    {
        if ($config->post->load(\Yii::$app->request->post()) && $config->post->validate() && $config->post->save()) {
            $this->savePostData($config->post);
            $this->saveMainPhoto($config->post);
            $this->saveAdditionalPhoto($config->post);

            \Yii::$app->getResponse()->redirect(Url::to(['update', 'id' => $config->post->id]));
            \Yii::$app->end();
        }
        return new PostTransportModel(new ConfigQuery($config), false);
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
        $configQuery->query->with(["postData", "image"])
            ->andWhere(["=", "status", ToseePost::STATUS_ACTIVE]);
        return $configQuery;
    }

    /**
     * `Query pipe`
     * Prepare query condition by cite
     *
     * @param ConfigQuery $configQuery
     * @return ConfigQuery
     */
    public function prepareCityQuery(ConfigQuery $configQuery): ConfigQuery
    {
        $configQuery->query->currentCity();
        return $configQuery;
    }

    /**
     * `Query pipe`
     * Prepare query condition for dated queries
     *
     * @param PostConfigQuery $configQuery
     * @return ConfigQuery
     */
    public function prepareQueryByDate(ConfigQuery $configQuery): ConfigQuery
    {
        /** @var PostServiceConfig $post_config */
        $post_config = $configQuery->config;
        switch ($post_config->action) {
            case self::ACTION_FUTURE:
                $configQuery->query->future()->orderByDateDesc();
                break;
            case self::ACTION_PAST:
                $configQuery->query->past()->orderByDateDesc();
                break;
            case self::ACTION_BY_DATE:
                $configQuery->query->date($post_config->date)->orderByDateDesc();
                break;
        }

        return $configQuery;
    }

    /**
     * `Query pipe`
     * Prepare query condition for dated queries
     *
     * @param PostConfigQuery $configQuery
     * @return ConfigQuery
     */
    public function prepareQueryByKeyWord(ConfigQuery $configQuery): ConfigQuery
    {
        $configQuery->query->keyword($configQuery->config->keyword)->orderByDateAsc();
        return $configQuery;
    }

    /**
     * `Query pipe`
     * Prepare query condition for single post
     *
     * @param PostConfigQuery $configQuery
     * @return ConfigQuery
     */
    public function prepareQueryById(ConfigQuery $configQuery): ConfigQuery
    {
        /** @var PostServiceConfig $post_config */
        $post_config = $configQuery->config;
        $configQuery->query->id($post_config->id);
        return $configQuery;
    }


    /**`Helper`
     * Return the next or prev post
     *
     * @param string $compare
     * @param ToseePost $post
     * @param PostServiceConfig $config
     * @return ToseePost|null
     * @throws \Throwable
     */
    private function siblingPost($compare, $post, $config)
    {
        try {
            /** @var ToseePostQuery $query */
            $query = ToseePost::find()
                ->orderByDate(($compare === '>') ? SORT_ASC : SORT_DESC)
                ->andWhere([$compare, 'event_at', $post->eventAt])
                ->orWhere([
                    'and',
                    [$compare, 'id', $post->id],
                    [$compare . '=', 'event_at', $post->eventAt]
                ])
                ->active()
                ->currentCity();

            switch ($config->configFromQueryParams->action) {
                case self::ACTION_FUTURE:
                    $query->future();
                    break;
                case self::ACTION_PAST:
                    $query->past();
                    break;
                case self::ACTION_BY_DATE:
                    $query->date($config->configFromQueryParams->date);
                    break;
                case self::ACTION_SEARCH:
                    $query->keyword($config->configFromQueryParams->keyword);
                    break;
            }

            return $query->one();
        } catch (\Exception $e) {
            return null;
        }
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

                $image = new ToseeImage();
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
        if ($post->postDataNN->load(\Yii::$app->request->post()) && $post->postDataNN->validate()) {
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