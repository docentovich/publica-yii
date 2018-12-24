<?php

namespace app\services;

use app\dto\PostServiceConfig;

/**
 * Сервис постов. Вся основная логика выборки постов
 * осталась в контроллере. Тут только логика связей таблиц
 * и логика когда и что и как надо считать. Если например надо изменить
 * логику выборки постов, наприме искать только активные, то все это происходит тут.
 *
 * Class Post
 * @package app\modules\tosee\service
 */
abstract class BasePostService extends \app\abstractions\Services
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
     * @return \app\dto\PostTransportModel
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

    abstract protected function actionPostsByDate(PostServiceConfig $config): \app\dto\PostTransportModel;

    abstract protected function actionPostsByKeyword(PostServiceConfig $config): \app\dto\PostTransportModel;

    abstract protected function actionPostsById(PostServiceConfig $config): \app\dto\PostTransportModel;

    abstract protected function actionSavePost(PostServiceConfig $config): \app\dto\PostTransportModel;
}