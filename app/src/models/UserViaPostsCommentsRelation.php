<?php

namespace app\models;

use app\models\Comments;
use app\models\Image;


/**
 * Trait PostsCommented
 * @property \yii\db\ActiveRecord[] $commentsViaPosts
 * @package app\models
 */
trait UserViaPostsCommentsRelation
{
    public function getPosts()
    {
        return $this->hasMany(Post::class, ['user_id' => 'id']);
    }

    public function getPostToImages()
    {
        return $this->hasMany(PostToImage::class, ['post_id' => 'id'])
            ->via('posts');
    }

    public function getCommentsViaPosts()
    {
        return $this->hasMany(Comments::class, ['image_id' => 'image_id'])
            ->via('postToImages');
    }
}