<div class="content">
    <div class="add-article">
        <h2 class="form-title">Добавить событие</h2>
        <?= $this->render('_post-form', [
            'post' => $post,
            'button_text' => \Yii::t('app/tosee', 'Create')
        ]) ?>
    </div>
</div>