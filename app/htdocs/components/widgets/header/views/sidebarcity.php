<div class="city">
    <div id="city-dd" class="city__drop-down">
        <div class="city__city-text"><?= (!isset($cities[$current_city_id]) ) ? 'Выберете ваш город' : $cities[$current_city_id];?></div>
        <object class="city__city-ico" data="<?= $bundle->baseUrl; ?>/images/route.svg" type=""></object>
    </div>
    <div id="city-dd-ul" style="display: none" class="city__drop-down-ul">
        <ul>
            <li rel="null" class="city__li">&nbsp;</li>

            <?php foreach($cities as $id=>$city_label ) { ?>
            <li id="city-<?=$id?>" onclick="setcity(<?=$id?>)" class="city__li"><?=$city_label?> </li>
            <?php } ?>
        </ul>
    </div>
</div>

<script>
    function setcity(id) {
        var csrfParam = $('meta[name="csrf-param"]').attr("content");
        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        var datas = {id : id};
        datas[csrfParam] = csrfToken;
        $.ajax({
            type: "POST",
            url: '<?= \yii\helpers\Url::toRoute(['/set-city'])?>',
            data: datas,
            success: function (data) {
                location.reload();
            }
        });
    }

</script>