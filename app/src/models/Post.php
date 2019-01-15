<?php

namespace app\models;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "{{%post}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $event_at Дата события. Для поиска timestump. Триггер для приведения к нужному виду. Индекс
 * @property string $eventAt
 * @property int $post_category_id Родительская категория. не fkey
 * @property int $image_id Главное изображение. Ссылка на ресурс.
 * @property int $city_id
 * @property int $status 0 - на модерации 1 - одобрено 2 - отклонено 3 - заблокировано 4 - удален
 * @property string $created_at Дата создания. Для вывода на страницу постов. Задается триггером
 * @property Post nextPost
 * @property Post prevPost
 * @property Image|null $image
 * @property Image $imageNN
 * @property User $user
 * @property PostData|null $postData
 * @property PostData $postDataNN
 * @property Image|null $additionalImages
 * @property Image $additionalImagesNN
 * @property PostToImage[]|null $postToImages
 */
class Post extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tosee_post}}';
    }
}
