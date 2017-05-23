<?php
namespace app\components\Helpers;

/**
 * Это пока нахуй не использую.
 *
 * Class Bem
 * @package app\components\Helpers
 */
class Bem{
    public static $_block; //текущий блок
    public static $_element; //текущий элемень

    /**
     * БЭМ блок
     * @string
     */
    public static function b($block){
        self::$_block = $block;
        return $block;
    }

    /**
     * БЭМ Элемент
     * @string
     */
    public static function e($element){
        self::$_element = $element;
        return self::$_block . "__" . $element;
    }

    /**
     * БЭМ Модификатор блока
     * @string
     */
    public static function m($modifaer, $delemiter = "_"){
        return self::$_block . $delemiter . $modifaer;
    }

    /**
     * БЭМ Модификатор Элемента
     * @string
     */
    public static function me($modifaer, $delemiter = "_"){
        return self::$_block . "__" . self::$_element . $delemiter . $modifaer;
    }
}