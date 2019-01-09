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
                'planner/<action:[\w\-]+>' => 'planner/date-time/<action>',
                [
                    'pattern' => 'planner-api/get-busy/<user_id:\d*>',
                    'route' => 'planner/date-time-api/get-busy',
                    'defaults' => ['user_id' => null],
                ],
                'planner-api/get-busy' => 'planner/date-time-api/get-busy',
                'planner-api/<action:[\w\-]+>' => 'planner/date-time-api/<action>',
            ]
        );
    }
}