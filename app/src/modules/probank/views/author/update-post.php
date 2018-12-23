<div class="content">
    <div class="add-article">
        <h2 class="form-title">Обновить событие</h2>
        <?= $this->render('_post-form', [
            'specialist' => $post,
            'button_text' => \Yii::t('app/tosee', 'Update')
        ]) ?>
    </div>
</div>