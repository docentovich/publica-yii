<?php
/**
 * @var string $currentProject
 * @var \app\models\City[] $cities
 * @var \app\models\City $current_city
 */
$bundle = \app\widgets\header\HeaderAssets::register($this);
/** @var array $projects
 * @see /app/common/config/params-local.php
 */
$projects = \Yii::$app->params['projects'];
$filtered_projects = array_filter(
    $projects,
    function ($key) use ($currentProject) {
        return $key !== $currentProject;
    },
    ARRAY_FILTER_USE_KEY
);

?>
    <div style="box-sizing: content-box">
        <header style="box-sizing: content-box">
            <div id="header-inner">
                <div class="navigation-panel">
                    <!--Left-->
                    <div class="navigation-part">
                        <div class="menu">

                            <?php if (PROJECT !== PUBLICA) { ?>
                                <div class="hamburger toggle-overlay" id="service-menu" rel="service-menu">
                                    <i class="icon-burger"></i>
                                </div>
                            <?php } ?>

                            <!--Logo-->
                            <div class="toggle-drop-down-action-panel base-logo" id="services" rel="services">
                                <?= \yii\helpers\Html::img("{$bundle->baseUrl}/images/logo-inline/{$currentProject}.svg"); ?>
                            </div>
                            <!--// Logo-->
                        </div>
                    </div>
                    <!--// Left-->

                    <!--Right-->
                    <div class="navigation-part">
                        <div class="controls">

                            <?php if (PROJECT !== PUBLICA) { ?>
                                <div class="toggle-drop-down-action-panel control" id="search" rel="search">
                                    <i class="icon-search"></i>
                                </div>
                                <div class="toggle-drop-down-action-panel control" id="geo" rel="geo">
                                    <i class="icon-geo"></i>
                                </div>
                            <?php } ?>

                            <div class="toggle-drop-down-action-panel control" id="enter" rel="enter">
                                <?php if (Yii::$app->id === "app-backend" and \Yii::$app->user->identity !== null) {
                                    echo \yii\helpers\Html::beginForm(['/user/security/logout'], 'post');
                                    echo \yii\helpers\Html::button(
                                        '<i class="icon-enter"></i>',
                                        ["class" => "button-only-icon", 'type' => 'submit']
                                    );
                                    echo \yii\helpers\Html::endForm();

                                } else {
                                    echo \yii\helpers\Html::a(
                                        '<i class="icon-enter"></i>',
                                        \yii\helpers\Url::to(
                                            (PROJECT === PUBLICA)
                                                ? \yii\helpers\ArrayHelper::getValue(\Yii::$app->params, 'projects.tosee.url') . '/admin'
                                                : '/admin',
                                            true));
                                } ?>
                            </div>
                        </div>
                    </div>
                    <!--// Right-->

                </div>
                <div class="action-panel toggle-overlay" id="drop-down-geo" rel="geo">
                    <div class="action-panel-control">
                        <i class="icon-geo"></i>
                        <span><?= \Yii::t('app/cities', $current_city->label); ?></span>
                    </div>
                </div>
                <div class="action-panel" id="drop-down-search">
                    <div class="action-panel-control">
                        <div id="search-placeholder">
                            <i class="icon-search"></i>
                            <span><?= \Yii::t('app/tosee', 'search on website'); ?></span>
                        </div>
                        <input type="text" value="" id="search-input" rel="search"/>
                    </div>
                </div>

                <!--DropDown projects logos-->
                <div class="action-panel" id="drop-down-services">
                    <?php foreach ($filtered_projects as $project) {
                        echo \yii\helpers\Html::a(
                            "<div class=\"drop-down-service-image drop-down-service--publica\">"
                            . \yii\helpers\Html::img("{$bundle->baseUrl}/images/logo-inline/{$project['logo']}") .
                            "</div>
                                 <div class=\"drop-down-service-description\"></div>",
                            $project['url'],
                            ["class" => "drop-down-service"])
                        ?>
                    <?php } ?>
                </div>
                <!--// DropDown projects logos-->

            </div>
        </header>
    </div>
    <div class="overlay" id="geo-overlay">
        <ul class="overlay-list" id="">
            <?php foreach ($cities as $city) { ?>
                <?= \yii\helpers\Html::a(
                    "<li>" . \Yii::t("app/cities", $city->label) . "</li>",
                    [
                        '/user/city/set-city',
                        'id' => $city->id,
                        'back' => \yii\helpers\Url::to(Yii::$app->request->url, true)
                    ]
                ); ?>
            <?php } ?>
        </ul>
    </div>
    <div class="overlay" id="search-overlay">
        <ul id="search-results-list" class="overlay-list"></ul>
        +
    </div>

<?= $content; ?>