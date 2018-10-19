<?php
/** $_GET 'file_name' => string(22) "post/noimage550x614" 'file_extension' => string(3) "jpg"  */
require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

$dir_separator = '/';
$upload_dir = __DIR__ . "/../../frontend/web/uploads";

function pathOf(...$parts)
{
    global $upload_dir, $dir_separator;
    array_unshift($parts, $upload_dir);
    return implode($dir_separator, $parts);
}

function fn($name, $extension)
{
    return "{$name}.{$extension}";
}

function checkFileExist($file_name_and_dir, $file_extension)
{
    try {
        return _checkFileExist($file_name_and_dir, $file_extension);
    } catch (Exception $e) {
        return _checkFileExist("noimage", 'jpg');
    }
}

function _checkFileExist($file_name_and_dir, $file_extension)
{
    if (file_exists($response_file_path = pathOf(fn($file_name_and_dir, $file_extension)))) {
        // if  exist
        return $response_file_path;
    }

    preg_match('/(.*)\[((\d+x\d+)|(Rx\d+)|(\d+xR))\]/', $file_name_and_dir, $matches);

    if (!isset($matches[2])) {
        // user request file with out size suffix but we have not found it before? so return noimage
        throw new \app\Exceptions\IncorrectImageSizeRequest();
    }

    list(, $file_name_original, $size) = $matches;

    if (!in_array($size, \app\constants\Constants::ALLOWED_IMAGE_SIZES)) {
        // not allowed size
        throw new \app\Exceptions\IncorrectImageSizeRequest;
    }

    if (!file_exists(pathOf(fn($file_name_original, $file_extension)))) {
        // if not exist origin
        throw new \app\Exceptions\NoOriginImageRequest;
    }

    try {
        return resizeFileFromOriginal(
            pathOf($file_name_original),
            $size,
            $file_extension
        );
    } catch (Exception $e) {
        throw new Exception();
    }


}

function resizeFileFromOriginal($original_file_and_dir, $size, $file_extension)
{
    $size = mb_strtolower($size);
    list($width, $height) = explode("x", str_replace('r', 100000, $size) );

    $return_file_name_and_dir = fn("{$original_file_and_dir}[{$size}]", $file_extension);
    // save
    \yii\imagine\Image::getImagine()
        ->open(fn($original_file_and_dir, $file_extension))
        ->thumbnail(new \Imagine\Image\Box($width, $height))
        ->save($return_file_name_and_dir, ['quality' => 90]);

    return $return_file_name_and_dir;
}

function response($get)
{
    $get['file_name'] = preg_replace("/(\.\.\/)/", "", $get['file_name']);
    $get['file_extension'] = preg_replace("/(\.\.\/)/", "", $get['file_extension']);

    $file = checkFileExist($get['file_name'], $get['file_extension']);
    switch ($get['file_extension']) {
        case 'png':
            $type = 'image/png';
            break;
        case 'jpg':
        case 'jpeg':
        default:
            $type = 'image/jpeg';
            break;
    }

    header('Content-Type: ' . $type);
    header('Content-Length: ' . filesize($file));
    echo file_get_contents($file);
}

response($_GET);