<?php
namespace components\helpers;

use yii\db\ActiveRecord;
use yii\helpers\Html;
use Yii;
use yii\imagine\Image;

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
    function cutStringSimbols($str, $length = 0, $postfix='...', $encoding='UTF-8')
    {
        //удаляем все лишшнее
        $str = strip_tags(trim($str));

        //если не щадана длинна то ничего блоее не делаем
        if($length == 0) return $str;

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
     * Возварт отнаоистельного адреса картинки и его ресайз если нет размера. Если нет и ориганал вернуть заглушку
     *
     * @param string $folder Относитьельный путь от uploads
     * @param string $name Имя изображения с расширением
     * @param string $size требуемый размер
     * @param string $requaered_extension требуемое расширение
     * @return string Src картинки
     */
    public static function flyResize($folder, $name, $size, $requaered_extension)
    {
        $dir = Yii::getAlias('@app'). "/web/uploads/" . $folder . "/";

        //аозварт заглушки
        if(!file_exists($dir . $name)){
            return "noimage_" . $size . ".png";
        }

        list($widh, $height) = explode("x", $size);

        //сохраняем тумбочку
        Image::thumbnail($dir . $name, $widh, $height)
            ->save($dir . $name . '_' . $size . '.' . $requaered_extension, ['quality' => 80]);

        return  $folder . "/" .$name . "_" . $size . "." . $requaered_extension;

    }

    /**
     * Возварт src картинки
     *
     * @param string $folder Относитьельный путь от uploads
     * @param string $name Имя изображения с расширением
     * @param string $size требуемый размер
     * @param string  $requaered_extension требуемое расширение
     * @return string Src картинки
     */
    public static function imageSrc($folder, $name, $size, $requaered_extension)
    {
        $src = "/uploads/";

        //получаем имя оригинала оттдельно от его расширения
        list($f_name, $extension) = explode("." , $name);


        //если нет тумбочки ресайзим, возварщаем
        if(!file_exists( Yii::getAlias('@app'). "/web/uploads/" . $folder . $f_name . "_" . $size . $requaered_extension ))
            $src  .=   flyResize($folder, $name, $size, $requaered_extension);
        //если есть тумбочка вернем ее отснительный путь
        else
            $src  .= $folder . $f_name . "_" . $size . $requaered_extension;

        return $src;
    }


    /**
     * Возврат фоновой картинки
     *
     * @param string $folder папка от uploads
     * @param string $name имя изображения
     * @param array $params массив парраметров
     * @return string
     */
    public static function bgImage($folder, $name, $params = [])
    {
        //это для выписывания изображения в контейне
        $params['class'] .= " img-well ";


        if(!isset($params['size'])) $params['size'] = ""; //требуемый размер
        if(isset($params['block'])) $params['class'] .= " " . $params['block']. "__img";  //добавляем класс элемента блока БЭМ
        if(!isset($params['extension'])) $params['extension'] = "jpg"; //расширение требуемое

        if(!isset($params['class'])) $params['class'] = "";
        if(is_array($params['class'])) $params['class'] = implode(" ", $params['class']);



        return '<i style="background-image: url(\'' . self::imageSrc($folder, $name, $params['size'], $params['extension']) . '\')"  class="' . $params['class'] . '"></i>';
    }


    /**
     * Возврат обычной картинки
     *
     * @param string $patch путь до изображения
     * @param string $name имя изображения
     * @param array $params массив парраметров
     * @return string
     */
    public static function image($folder, $name, $params = []){

        if(!isset($params['size'])) $params['size'] = "";
        if(isset($params['block'])) $params['class'] .= " " . $params['block']. "__img";
        if(!isset($params['extension'])) $params['extension'] = "jpg";

        if(!isset($params['class'])) $params['class'] = "";
        if(!isset($params['alt'])) $params['alt'] = "";
        if(is_array($params['class'])) $params['class'] = implode(" ", $params['class']);

//        if(isset($params['user_id'])) $params['user_id'] .= "/";


        return '<img alt="' . $params['alt'] . '" src=\'/' . self::imageSrc($folder, $name, $params['size'], $params['extension']) . '.' . $params['extension'] . '\'  class="' . $params['class'] . '"/>';
    }

    /**
     * @param $image ActiveRecord
     * @param array $params
     * @return string
     */
    public static function renderImage($image, $params = [])
    {
        return self::image($image->patch, $image->name, $params);
    }



}