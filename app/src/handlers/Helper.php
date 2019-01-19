<?php

namespace app\handlers;


class Helper
{
    public static function fn($name, $extension)
    {
        return "{$name}.{$extension}";
    }

    public static function resizeComplex($fileName, $sizes)
    {
        $file_name_array = explode('.', $fileName);

        foreach ($sizes as $size){
            self::resizeFileFromOriginal($file_name_array[0],$size, $file_name_array[1]);
        }
    }

    public static function resizeFileFromOriginal($original_file_and_dir, $size, $file_extension)
    {
        $size = mb_strtolower($size);
        // if we scaling only one side whe need use inset algotitm
        $resize_algoritm = (strpos($size, 'r') !== false)
            ? \Imagine\Image\ImageInterface::THUMBNAIL_INSET
            : \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;
        list($width, $height) = explode("x", str_replace('r', 100000, $size));

        $size = str_replace('r', 'R', $size);
        $return_file_name_and_dir = self::fn("{$original_file_and_dir}[{$size}]", $file_extension);
        // save
        \yii\imagine\Image::getImagine()
            ->open(self::fn($original_file_and_dir, $file_extension))
            ->thumbnail(new \Imagine\Image\Box($width, $height), $resize_algoritm)
            ->save($return_file_name_and_dir, ['quality' => 90]);

        return $return_file_name_and_dir;
    }
}