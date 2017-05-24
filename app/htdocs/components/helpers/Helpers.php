<?php
namespace components\helpers;

use yii\helpers\Html;

class Helpers extends Html
{

    /**
     * @param string $date дата
     * @return string
     */
    public static function dateVsDots($date)
    {
        preg_match("/^(\d{2})(\d{2})\d{2}(\d{2})$/", $date, $matches);
        return $matches[1] . "." . $matches[2] . "." . $matches[3];
    }

    /**
     * Возврат короткого описания
     *
     * @param string $str строка
     * @param int $length длина, до скольки символов обрезать
     * @param string $postfix постфикс, который добавляется к строке
     * @param string $encoding кодировка, по-умолчанию 'UTF-8'
     * @return string обрезанная строка
     */
    function cutStringSimbols($str, $length = 0, $postfix='...', $encoding='UTF-8')
    {
        $str = strip_tags(trim($str));

        if($length == 0) return $str;

        if (mb_strlen($str, $encoding) <= $length) {
            return $str;
        }

        $tmp = mb_substr($str, 0, $length, $encoding);
        $a = mb_substr($tmp, 0, mb_strripos($tmp, ' ', 0, $encoding), $encoding) . $postfix;
        return $a;
    }

    /**
     * Возврат элемента спрайта
     *
     * @param string $folder Имя спрайта
     * @param string $name Название изображения в спрайте
     * @param array $class Дополнительные классы
     * @return string
     */
    public static function i($folder, $name,  $class = []){
        $class[] = "sp-{$folder}";
        $class[] = "sprite-img";
        $class[] = "sp-{$folder}__{$name}";
        return "<i class='" . implode(" ", $class) . "'></i>";
    }


    /**
     * Возврат фоновой картинки
     *
     * @param string $patch путь до изображения
     * @param string $name имя изображения
     * @param array $params массив парраметров
     * @return string
     */
    public static function bgImage($patch, $name, $params = []){

        if(!isset($params['size'])) $params['size'] = "";
        if(isset($params['block'])) $params['class'] .= " " . $params['block']. "__img";
        if(!isset($params['extension'])) $params['extension'] = "jpg";

        if(!isset($params['class'])) $params['class'] = "";
        if(is_array($params['class'])) $params['class'] = implode(" ", $params['class']);

//        if(isset($params['user_id'])) $params['user_id'] .= "/";

        $params['class'] .= " img-well ";

        //если нет файла искомого размера возмем оригинал
        if(!file_exists(__DIR__ . "/../../frontend/web/uploads/" . $patch . $name . $params['size'] . '.' . $params['extension']))
            $params['size'] = "_origin";
        return '<i style="background-image: url(\'/uploads/' . $patch . $name . $params['size'] . '.' . $params['extension'] . '\')"  class="' . $params['class'] . '"></i>';
    }



}