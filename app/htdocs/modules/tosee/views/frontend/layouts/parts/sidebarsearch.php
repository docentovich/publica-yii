<!-- search-form -->
<form class="search-form" action="/search" method="get">
    <input placeholder="Что ищем ?.." class="search-form__input" type="text" name="keyword"/>
    <div class="search-form__loopa">
        <img src="<?= $bundle->baseUrl; ?>/images/svg/zoom1.svg" class="search-form__svg" alt=""
                                         role="presentation"/>
    </div>
</form>
<!--/ search-form -->