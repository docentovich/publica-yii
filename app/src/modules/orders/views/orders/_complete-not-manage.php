<?php
/**
 * @var \orders\dto\OrdersTransportModel $orderTransportModel
 * @var \yii\web\View $this
 */
?>
<div class="single-member order">
    <div class="member-header order-header">
        <div class="title">Анастасия</div>
        <div class="sub-title">Модель</div>
        <div class="order-header-avatars">
            <div class="flex-el avatar" style="background-image:url(/images/my-avatar.jpg)"></div><i class="flex-el icon-exchange2" aria-hidden="true"></i>
            <div class="flex-el avatar" style="background-image:url(/images/customer-avatar.jpg)"></div>
        </div>
        <div class="order-geo-time">
            <div class="order-geo-time-inner">
                <div class="flex-el"><i class="icon-geo"></i><span>Орел</span></div>
                <div class="flex-el"><i class="icon-clock"></i><span>18.00 - 22.00</span></div>
            </div>
        </div>
    </div>
</div>
<div class="finish-order">
    <div class="finish-block">
        <label>Оценку (0-5 баллов) о пратнере</label>
        <select id="rate" data-val="2">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>
    <div class="finish-block finish-comment">
        <label>Комментарий о партнере</label><span>Lorem ipsom dollar</span>
    </div>
</div>
