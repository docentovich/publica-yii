<div class="content">
    <div class="add-article">
        <form class="form" action="/who.html">
            <h2 class="form-title">Добавить событие</h2>
            <div class="form-block">
                <div class="form-row">
                    <label>Заголовок</label>
                    <input type="text"/>
                </div>
                <div class="form-row">
                    <label>Дата</label>
                    <input type="text"/>
                </div>
                <div class="form-row">
                    <label>Место (город)</label>
                    <input type="text"/>
                </div>
                <div class="form-row form--upload">
                    <label>Заглавное фото</label>
                    <div class="form-avatar trigger-click dark-icon" rel="upload-input"><i class="fa fa-user"></i></div>
                    <input type="file" name="pic" accept="image/*" style="display: none" id="upload-input"/>
                </div>
                <div class="form-row">
                    <label>Введение</label>
                    <input type="text"/>
                </div>
                <div class="form-row">
                    <label>Текст</label>
                    <textarea></textarea>
                </div>
                <div class="form-row">
                    <label>Фотоглерея</label>
                    <div class="form-photo-gallery">
                        <div class="form-photo-gallery-item"><img src="/images/avatars/2.jpg"/></div>
                        <div class="form-photo-gallery-item"><img src="https://dummyimage.com/1000x400/000/fff"/></div>
                        <div class="form-photo-gallery-item"><img src="/images/avatars/5.jpg"/></div>
                        <div class="form-photo-gallery-item"><img src="/images/avatars/2.jpg"/></div>
                        <div class="form-photo-gallery-item"><img src="/images/avatars/2.jpg"/></div>
                        <div class="form-photo-gallery-item"><img src="https://dummyimage.com/1000x400/000/fff"/></div>
                        <div class="form-photo-gallery-item"><img src="/images/avatars/5.jpg"/></div>
                        <div class="form-photo-gallery-item"><img src="/images/avatars/2.jpg"/></div>
                    </div>
                </div>
            </div>
            <div class="form-block form-control">
                <div class="form-row">
                    <div class="form-submit-button">
                        <button>Отправить на модерацию</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>