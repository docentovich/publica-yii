<?php
/** $_GET 'file_name' => string(22) "post/noimage550x614" 'file_extension' => string(3) "jpg"  */
require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

$dir_separator = '/';
$file_real_directory = '';
$upload_dir = __DIR__ . "/../../frontend/web/uploads";

function patchOf($file_name)
{
    global $dir_separator, $file_real_directory;
    return "{$file_real_directory}{$dir_separator}{$file_name}";
}

function checkFileExist($file_name_and_dir, $file_extension)
{
    global $dir_separator, $file_real_directory, $upload_dir;
    $path_array = explode('/', $file_name_and_dir);

    $file_name_with_size = array_pop($path_array);
    $file_name_with_size_extension = "{$file_name_with_size}.{$file_extension}";

    $file_real_directory = $upload_dir  . ((!empty($path_array)) ? $dir_separator : '') . implode($dir_separator, $path_array);

    preg_match('/(.*)\[(.*)\]/', $file_name_with_size, $matches);

    if(!isset( $matches[2] )){
        return patchOf("{$file_name_with_size}.{$file_extension}");
    }

    list(,$file_name_original, $size) = $matches;
    $file_name_original_extension = "{$file_name_original}.{$file_extension}";

    if (!file_exists($response_file_path = patchOf($file_name_with_size_extension))) { // if not exist
        if (!file_exists($response_file_path = patchOf($file_name_original_extension))) { // if not exist origin
            return checkFileExist("noimage[{$size}]", $file_extension);
        } else {
            return resizeFileFromOriginal(
                patchOf($file_name_original),
                $size,
                $file_extension
            );
        }
    }

    return $response_file_path;
}

function resizeFileFromOriginal($original_file_and_dir, $size, $file_extension)
{
    $size = mb_strtolower($size);
    list($width, $height) = explode("x", $size);

    // save
    \yii\imagine\Image::thumbnail("{$original_file_and_dir}.{$file_extension}", $width, $height)
        ->save($return_file_name_and_dir = "{$original_file_and_dir}[{$size}].{$file_extension}", ['quality' => 90]);

    return $return_file_name_and_dir;
}

function response($get)
{
    $get['file_name'] = preg_replace("/(\.\.\/)/","", $get['file_name']);
    $get['file_extension'] = preg_replace("/(\.\.\/)/","", $get['file_extension']);

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