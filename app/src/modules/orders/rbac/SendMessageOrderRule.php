<?php

namespace app\modules\orders\rbac;

use orders\models\Orders;
use yii\rbac\Item;
use yii\rbac\Rule;

class SendMessageOrderRule extends Rule
{
    public $name = 'sendMessageOrder';

    /**
     * Executes the rule.
     *
     * @param string|int $user the user ID. This should be either an integer or a string representing
     * the unique identifier of a user. See [[\yii\web\User::id]].
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to [[CheckAccessInterface::checkAccess()]].
     * @return bool a value indicating whether the rule permits the auth item it is associated with.
     */
    public function execute($user, $item, $params)
    {
        return Orders::findOne([
                'AND',
                'id' => $params['order_id'],
                [
                    'or',
                    'customer_id' => \Yii::$app->user->getId(),
                    'seller_id' => \Yii::$app->user->getId()
                ]
            ]) !== null;
    }
}