<?php
namespace app\components\Helpers;

/**
 * Это пока не использую.
 *
 * Class Bem
 * @package app\components\Helpers
 */
class Bem{
    public static $block; //текущий блок
    public static $element; //текущий элемень

    /**
     * БЭМ блок
     * @string
     */
    public static function b($block){
        self::$block = $block;
        return $block;
    }

    /**
     * БЭМ Элемент
     * @string
     */
    public static function e($element){
        self::$element = $element;
        return self::$block . "__" . $element;
    }

    /**
     * БЭМ Модификатор блока
     * @string
     */
    public static function m($modifaer, $delemiter = "_"){
        return self::$block . $delemiter . $modifaer;
    }

    /**
     * БЭМ Модификатор Элемента
     * @string
     */
    public static function me($modifaer, $delemiter = "_"){
        return self::$block . "__" . self::$element . $delemiter . $modifaer;
    }
}