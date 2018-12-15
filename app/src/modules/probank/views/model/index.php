<div class="content">
    <div class="role">
        <?= \app\widgets\UserHeader::widget(); ?>
        <div class="role-actions">
            <?= \yii\helpers\Html::a(\Yii::t('app/probank', 'Edit portfolio'), ["/probank/model/portfolio"]); ?>
<!--            --><?//= \yii\helpers\Html::a(\Yii::t('app/user', 'My article'), ["/probank/model/my-articles"]); ?>
        </div>
    </div>
</div>