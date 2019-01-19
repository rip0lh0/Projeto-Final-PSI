<?php
namespace backend\models;

ini_set('memory_limit', '256M');
// This File Handles All Images Uploads 
use yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii\base\Model;
use yii\helpers\Json;
use yii\base\ErrorException;



class ImageHandler extends Model
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

        FileHelper::createDirectory($target_dir);

        $file_list = scandir($source_dir);

        $count = 0;

        foreach ($file_list as $filename) {
            if ($filename == '.' || $filename == '..') continue;

            /* Define Paths */
            $source_path = $source_dir . '/' . $filename;
            $target_path = $target_dir . '/' . $count++ . self::IMAGE_EXTENSION;

            /* Default Image sizes */
            $img_info = getimagesize($source_path);
            $img_width = $img_info[0];
            $img_height = $img_info[1];

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

            //return $img;
        }
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
