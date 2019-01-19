<?php

use yii\helpers\Html;

?>
<p>Уважаемый(ая) <b><?= $seller->profile->fullName ?></b></p>
<p>На сайте `Publica` был произведен заказ. Узнать подробнее можно пройдя по ссылке:</p>
<p><?= Html::a(
"$shootme_link/order/{$config->portfolio_id}/{$config->customer_id}",
"$shootme_link/order/{$config->portfolio_id}/{$config->customer_id}"
); ?></p>