<?php

namespace app\modules\tosee;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap ( $app )
    {
        $app->setComponents([
            'postService' => [
                'class' => 'app\modules\tosee\services\PostService'
            ]
        ]);
    }
}