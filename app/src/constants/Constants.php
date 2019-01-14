<?php
namespace app\constants;

use yii\helpers\Url;

class Constants{
    const ALLOWED_IMAGE_SIZES = [
        "500x500", "320x200", "770x500",
        "200x200", "500xR", "450xR", // post main image
        "200x150", "390x280", "280x200", "200xR", "390xR", "280xR", "450xR", // post additional images
        "768x500", "1200x500", "1500x500", // modal base image
        "800xR", // Portfolio base image
        "40x40", "50x50", // comments avatar
        "Rx270",
        "100x100",
        "80x80" // small avatar
    ];

    const NO_IMAGE = 'noimage.svg';
    const NO_IMAGE_WHITE = 'noimage-white.svg';

    static public function NO_IMAGE() {
        return Url::to('/uploads/' . self::NO_IMAGE, true);
    }

    static public function NO_IMAGE_WHITE() {
        return Url::to('/uploads/' . self::NO_IMAGE_WHITE, true);
    }

    static public function WAITING_IMAGE(){
        return Url::to('/uploads/waiting.gif', true);
    }

    static public function INVISIBLE_IMAGE(){
        return Url::to('/uploads/invisible.png', true);
    }

    const LANGUAGE_RU = 'ru-RU';
    const LANGUAGE_EN = 'en';
    const LANGUAGE_SHORT_RU = 'ru';
    const LANGUAGE_SHORT_EN = 'en';

}