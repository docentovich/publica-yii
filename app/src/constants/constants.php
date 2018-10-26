<?php
namespace app\constants;

class Constants{
    const ALLOWED_IMAGE_SIZES = [
        "500x500", "320x200", "770x500",
        "200x150", "390x280", "280x200", // post additional images
        "768x500", "1200x500", "1500x500", // modal base image
        "270xR",
        "100x100",
    ];

    const LANGUAGE_RU = 'ru-RU';
    const LANGUAGE_EN = 'en';
    const LANGUAGE_SHORT_RU = 'ru';
    const LANGUAGE_SHORT_EN = 'en';
}