<?php

namespace app\helpers;

use yii\helpers\Html;

class Helpers extends Html
{

    /**
     * Дата с точками из даты сплошняком. 171015 -> 17.10.15
     *
     * @param string $date дата
     * @return string
     */
    public static function dateStripDots($date)
    {
        preg_match("/^(\d{2})(\d{2})\d{2}(\d{2})$/", $date, $matches);
        return $matches[1] . "." . $matches[2] . "." . $matches[3];
    }

    /**
     * Взврат даты. 2917-45-66 -> 2917.45.66
     *
     * @param string $date
     * @return string
     */
    public function dateVsDots($date)
    {
        $date = str_replace("-", ".", $date);
        return $date;
    }

    /**
     * Возврат короткого описания. Обрезка символов без разрыв слов
     *
     * @param string $str строка
     * @param int $length длина, до скольки символов обрезать
     * @param string $postfix постфикс, который добавляется к строке
     * @param string $encoding кодировка, по-умолчанию 'UTF-8'
     * @return string обрезанная строка
     */
    function cutStringSymbols($str, $length = 0, $postfix = '...', $encoding = 'UTF-8')
    {
        //удаляем все лишшнее
        $str = strip_tags(trim($str));

        //если не щадана длинна то ничего блоее не делаем
        if ($length == 0) return $str;

        //если символов меньше выход
        if (mb_strlen($str, $encoding) <= $length) {
            return $str;
        }

        //поседний символ по лимиту
        $tmp = mb_substr($str, 0, $length, $encoding);
        //последний симвло по пробелу до лиита и обрезка
        $a = mb_substr($tmp, 0, mb_strripos($tmp, ' ', 0, $encoding), $encoding) . $postfix;
        return $a;
    }
}