<?php
namespace backend\models;

// This File Handles All Images Uploads 
use yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii\base\Model;
use yii\helpers\Json;
use yii\base\ErrorException;

class ImageHandler
{
    private const IMAGE_EXTENSION = ".jpg";
    private const TEMP_DIRECTORY = "temp/animals/";
    private const FINAL_DIRECTORY = "/uploads/animals/";

    private const QUALITY = "80"; // JPEG QUALITY
    private const RESOLUTION = "720"; // HEIGHT

    public static function temp_upload($source_img_name, $target_img_name, $target_folder_name)
    {
        $target_dir = self::TEMP_DIRECTORY . $target_folder_name;
        $img = UploadedFile::getInstanceByName($source_img_name);

        if (!is_dir($target_dir)) FileHelper::createDirectory($target_dir);

        if ($img->saveAs($target_dir . '/' . $target_img_name)) return $img;

        throw new ErrorException();
    }

    public static function final_upload($source_folder_name, $target_folder_name)
    {
        $source_dir = self::TEMP_DIRECTORY . $source_folder_name;
        $target_dir = Yii::getAlias('@common') . self::FINAL_DIRECTORY . $target_folder_name;

        if (is_dir($target_dir)) FileHelper::removeDirectory($target_dir);

        FileHelper::createDirectory($target_dir);

        $file_list = scandir($source_dir);

        $count = 0;

        foreach ($file_list as $filename) {
            if ($filename == '.' || $filename == '..') continue;

            /* Define Paths */
            $source_path = $source_dir . '/' . $filename;
            $target_path = $target_dir . '/' . $count++ . self::IMAGE_EXTENSION;

            if (strpos($filename, '_p4aopt') === true) {
                copy($source_path, $target_path);
            } else {
                $img = null;
                $img_layer = null;

                /* Default Image sizes */
                $img_info = getimagesize($source_path);

                $img_width = $img_info[0];
                $img_height = $img_info[1];

                // http://php.net/manual/en/
                $memoryNeeded = round(($img_width * $img_height * $img_info['bits'] * $img_info['channels'] / 8 + Pow(2, 16)) * 1.65);
                if (function_exists('memory_get_usage') && memory_get_usage() + $memoryNeeded > (integer)ini_get('memory_limit') * pow(1024, 2)) {
                    ini_set('memory_limit', (integer)ini_get('memory_limit') + ceil(((memory_get_usage() + $memoryNeeded) - (integer)ini_get('memory_limit') * pow(1024, 2)) / pow(1024, 2)) . 'M');
                }
                // END http://php.net/manual/en/

                switch ($img_info['mime']) {
                    case 'image/jpeg':
                        $img = imagecreatefromjpeg($source_path);
                        break;
                    case 'image/gif':
                        $img = imagecreatefromgif($source_path);
                        break;
                    case 'image/png':
                        $img = imagecreatefrompng($source_path);
                        break;
                    default:
                        throw new ErrorException();
                }
                /* Resize */
                $img_ratio = $img_width / $img_height;

                // Calculate Final Width Based on Ratio
                $img_target_width = self::RESOLUTION * $img_ratio;
                $img_target_height = self::RESOLUTION;

                // Image Layer
                $img_layer = imagecreatetruecolor($img_target_width, $img_target_height);

                // Resize Image
                imagecopyresampled($img_layer, $img, 0, 0, 0, 0, $img_target_width, $img_target_height, $img_width, $img_height);

                // Compress image
                imagejpeg($img_layer, $target_path, self::QUALITY);
            }

        }
    }

    public static function copy_to_temp($source_folder, $target_folder)
    {
        /* Define DIR */
        $source_dir = Yii::getAlias('@common') . self::FINAL_DIRECTORY . $source_folder;
        $target_dir = self::TEMP_DIRECTORY . $target_folder;

        if (!is_dir($source_dir)) return null;
        if (!is_dir($target_dir)) FileHelper::createDirectory($target_dir);

        /* List Of Files in The Source Directory */
        $file_list = scandir($source_dir);

        foreach ($file_list as $file_base_name) {
            if ($file_base_name == '.' || $file_base_name == '..') continue;

            $file_name = pathinfo($source_dir . '/' . $file_base_name)['filename'];

            $source_path = $source_dir . '/' . $file_base_name;
            $target_path = $target_dir . '/' . $file_name . '_p4aopt' . self::IMAGE_EXTENSION;

            /* Copy To Temp Directory */
            copy($source_path, $target_path);
        }
    }

    /* Returns the list of contented files in the @Backend/web/temp folder */
    public static function load_from_temp($source_folder)
    {
        $source_dir = self::TEMP_DIRECTORY . $source_folder;

        if (!is_dir($source_dir)) return ['error' => 'Folder Not Found'];

        $file_list_name = scandir($source_dir);
        $file_list = [];

        foreach ($file_list_name as $file_name) {
            if ($file_name == '.' || $file_name == '..') continue;

            $source_path = $source_dir . '/' . $file_name;

            $img_size = filesize($source_path);

            $img_info['id'] = rand(10000000, 99999999);
            $img_info['name'] = $file_name;
            $img_info['size'] = $img_size;
            $img_info['url'] = $source_path;

            $file_list[] = $img_info;
        }

        return $file_list;
    }

    /* Returns the list of contented files in the @Common/uploads folder */
    public static function load_from_final($source_folder)
    {
        $source_dir = Yii::getAlias('@common') . self::FINAL_DIRECTORY . $source_folder;

        if (!is_dir($source_dir)) return ['error' => 'Folder Not Found'];

        $file_list_name = scandir($source_dir);
        $file_list = [];

        foreach ($file_list_name as $file_name) {
            if ($file_name == '.' || $file_name == '..') continue;

            $source_path = $source_dir . '/' . $file_name;

            $img_size = filesize($source_path);

            $img_info['id'] = rand(10000000, 99999999);
            $img_info['name'] = $file_name;
            $img_info['size'] = $img_size;
            $img_info['url'] = $source_path;

            $file_list[] = $img_info;
        }

        return $file_list;
    }

    /* Returns Base64 Image */
    public static function load_image($source_folder, $source_name)
    {
        $source_dir = Yii::getAlias('@common') . self::FINAL_DIRECTORY . $source_folder;
        $source_path = $source_dir . '/' . $source_name;

        $fp = fopen($source_path, 'r');

        $data = fread($fp, filesize($source_path));

        fclose($fp);

        return base64_encode($data);
    }

    public static function load_images($source_folder)
    {
        $files = ImageHandler::load_from_final($source_folder);
        $images = [];
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') continue;

            $images[] = ImageHandler::load_image($source_folder, $file['name']);
        }

        return $images;
    }

    public static function delete_image($file_name, $file_folder)
    {
        $source_path = self::TEMP_DIRECTORY . $file_folder;

        if (file_exists($source_path . '/' . $file_name)) FileHelper::unlink($source_path . '/' . $file_name);

        return ['Success' => 'Image Removed with Success'];
    }

    public static function delete_directory($directory)
    {
        $source_path = self::TEMP_DIRECTORY . $directory;

        if (is_dir($source_path)) FileHelper::removeDirectory($source_path);

        return ['Success' => 'Directory Removed with Success'];
    }
}
