<?php
defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_ENV') or define('YII_ENV', 'prod');
/** $_GET 'file_name' => string(22) "post/noimage550x614" 'file_extension' => string(3) "jpg"  */
require_once(__DIR__ . '/../../vendor/autoload.php');
require_once(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

$dir_separator = '/';
$upload_dir = __DIR__ . "/../../frontend/web/uploads";

function pathOf(...$parts)
{
    global $upload_dir, $dir_separator;
    array_unshift($parts, $upload_dir);
    return implode($dir_separator, $parts);
}

function checkFileExist($file_name_and_dir, $file_extension)
{
    try {
        return _checkFileExist($file_name_and_dir, $file_extension);
    } catch (Exception $e) {
        return _checkFileExist("noimage", 'png');
    }
}

function _checkFileExist($file_name_and_dir, $file_extension)
{
    if (file_exists($response_file_path = pathOf(\app\handlers\Helper::fn($file_name_and_dir, $file_extension)))) {
        // if  exist
        return $response_file_path;
    }

    preg_match('/(.*)\[((\d+x\d+)|(Rx\d+)|(\d+xR))\]/', $file_name_and_dir, $matches);

    if (!isset($matches[2])) {
        // user request file with out size suffix but we have not found it before? so return noimage
        throw new Exception();
    }

    list(, $file_name_original, $size) = $matches;

    if (!in_array($size, \app\constants\Constants::ALLOWED_IMAGE_SIZES)) {
        // not allowed size
        throw new Exception();
    }

    if (!file_exists(pathOf(\app\handlers\Helper::fn($file_name_original, $file_extension)))) {
        // if not exist origin
        throw new \app\exceptions\NoOriginImageRequest;
    }

    try {
        return \app\handlers\Helper::resizeFileFromOriginal(
            pathOf($file_name_original),
            $size,
            $file_extension
        );
    } catch (Exception $e) {
        throw new Exception();
    }


}


function response($get)
{
    $get['file_name'] = preg_replace("/(\.\.\/)/", "", $get['file_name']);
    $get['file_extension'] = preg_replace("/(\.\.\/)/", "", $get['file_extension']);

    $file = checkFileExist($get['file_name'], $get['file_extension']);
    switch ($get['file_extension']) {
        case 'gif':
            $type = 'image/gif';
            break;
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