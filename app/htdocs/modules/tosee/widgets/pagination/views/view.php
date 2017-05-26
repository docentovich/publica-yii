<?php use yii\helpers\Html; ?>
<div class="row">
    <div class="col-xs-24">
        <!-- pagination -->
        <div class="pagination">

            <div class="pagination__item">
                <!-- pagination-item -->
                <?= Html::a(
                    "<",
                    ($current_page > 1) ? str_replace("%i%", ($current_page - 1), $url): "#",
                    ["class" => "pagination-item" . (($current_page > 1) ? "" : " pagination-item_disabled")]
                );
                /* <a href="<?= ($current_page > 1) ? $url . "/" . ($current_page - 1) : ""; ?>" class="pagination-item <?= ($current_page > 1) ? "" : "pagination-item_disabled"; ?>"><</a> */
                ?>
                <!--/ pagination-item -->
            </div>

            <?php if ($display_start_dots) { ?>
                <div class="pagination__dots">
                    ...
                </div>
            <?php } ?>

            <?php for ($i = $start; $i <= $end; $i++) { ?>
                <div class="pagination__item">
                    <!-- pagination-item -->
                    <?= HTML::a(
                        $i,
                        ($current_page == $i) ? "#" : str_replace("%i%", $i, $url),
                        ["class" => "pagination-item pagination-item_disabled" . (($current_page == $i) ? " pagination__item_disabled pagination__item_active" : "")]
                    );
                    /* <a href = "<?= ($current_page == $i) ? "" :  $url . " / " . $i ?>" class="pagination-item pagination-item_disabled <?= ($current_page == $i) ? "pagination - item_disabled pagination - item_active" : "" ?>" ><?= $i; ?><!--</a>--> */
                    ?>
                    <!--/ pagination-item -->
                </div>
            <?php } ?>

            <?php if ($display_end_dots) { ?>
                <div class="pagination__dots">
                    ...
                </div>
            <?php } ?>

            <div class="pagination__item">
                <!-- pagination-item -->
                <?= Html::a(
                    ">",
                    ($current_page < $max_pages) ? str_replace("%i%", ($current_page + 1), $url) : "#",
                    ["class" => "pagination-item" . (($current_page < $max_pages) ? "" : " pagination-item_disabled")]
                );
                /* <a href="<?= ($current_page < $max_pages) ? $url . "/" . ($current_page + 1) : ""; ?>" class="pagination-item <?= ($current_page < $max_pages) ? "" : "pagination-item_disabled"; ?>">></a> */
                ?>
                <!--/ pagination-item -->
            </div>

        </div>
        <!--/ pagination -->
    </div>
</div>
