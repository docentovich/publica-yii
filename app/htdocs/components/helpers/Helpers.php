<?php
namespace components\helpers;

class Helpers
{
    /**
     * Трансформирует дату в привычную для чтения
     * @sting
     */
    public static function dateVsDots($date)
    {
        preg_match("/^(\d{2})(\d{2})\d{2}(\d{2})$/", $date, $matches);
        return $matches[1] . "." . $matches[2] . "." . $matches[3];
    }

    /**
     * Возврат короткого описания
     * @return string
     */
    public static function shortDesc($desc, $limit = 0)
    {
        $desc = strip_tags(trim($desc));
        $desc = preg_replace("/[^[:print:]]/", "", $desc);

        if($limit){
            $desc  =  implode(' ', array_slice(str_word_count($desc,1), 0, $limit));
        }

        return $desc;
    }

    /**
     * Возврат элемента спрайта
     * @param $folder Имя спрайта
     * @param $name Название изображения в спрайте
     * @param array $classes Дополнительные классы
     * @return string
     */
    public static function i($folder, $name,  $classes = []){
        $classes[] = "sp-{$folder}";
        $classes[] = "sp-{$folder}__{$name}";
        return "<i class='" . implode(" ", $classes) . "'></i>";
    }


    /**
     * Возврат фоновой картинки
     * @param string $src имя Изображения
     * @param array $params массив парраметров
     * @return string
     */
    public static function bgImage($src, $params = []){

        if(!isset($params['size'])) $params['size'] = "_450X450";
        if(isset($params['block'])) $params['classes'][] = $params['block']. "__img";
        if(!isset($params['extension'])) $params['extension'] = "jpg";
        if(isset($params['user_id'])) $params['user_id'] .= "/";

        $params['classes'][] = "img-well";
        return '<i style="background-image: url(\'/images/' . $params['user_id'] . $src . $params['size'] . '.' . $params['extension'] . '\')"  class="' . implode(" ", $params['classes']) . '"></i>';
    }

}