<?php
namespace app\constants;

use yii\helpers\Url;

class Constants{
    const ALLOWED_IMAGE_SIZES = [
        "500x500", "320x200", "770x500",
        "200x200", "500xR", // post main image
        "200x150", "390x280", "280x200", "200xR", "390xR", "280xR", // post additional images
        "768x500", "1200x500", "1500x500", // modal base image
        "Rx270",
        "100x100",
    ];

    static public function NO_IMAGE() {
        return Url::to('/uploads/noimage.jpg', true);
    }

    const LANGUAGE_RU = 'ru-RU';
    const LANGUAGE_EN = 'en';
    const LANGUAGE_SHORT_RU = 'ru';
    const LANGUAGE_SHORT_EN = 'en';

}