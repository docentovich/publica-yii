<div class="content">
    <div class="add-article">
        <h2 class="form-title">Обновить событие</h2>
        <?= $this->render('_post-form', [
            'model' => $model,
            'post_data' => $post_data,
            'upload' => $upload,
        ]) ?>
    </div>
</div>