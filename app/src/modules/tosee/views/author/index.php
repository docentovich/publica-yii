<div class="content">
    <div class="role">
        <?= \app\widgets\UserHeader::widget(); ?>
        <div class="role-actions">
            <?= \yii\helpers\Html::a(\Yii::t('app/user', 'Add article'), ["/author/create"]); ?>
            <?= \yii\helpers\Html::a(\Yii::t('app/user', 'My article'), ["/author/my-articles"]); ?>
        </div>
    </div>
</div>