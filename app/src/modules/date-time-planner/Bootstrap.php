<?php

namespace DateTimePlanner;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap ( $app )
    {
        $app->getUrlManager()->addRules(
            [
                'planner' => 'planner/date-time/index',
                'planner/<action:\w+>' => 'planner/date-time/<action>',
                'planner-api/<action:\w+>' => 'planner/date-time-api/<action>',
            ]
        );
    }
}