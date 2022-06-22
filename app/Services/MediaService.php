<?php


namespace App\Services;


use App\Models\Media;
use Illuminate\Support\Facades\Config;

class MediaService
{
    /**
     * This function updates customer profile image
     * @param $file
     * @param $hasFile
     * @param $preFile
     * @return string
     */
    public static function saveMedia($file,$hasFile,$preFile)
    {
        if ($hasFile) {
            $mediaName = time().'-'.$file->getClientOriginalName();
            $path = Config::get('constants.paths.media');
            if ($preFile !="null" && $preFile){
                @unlink($path.$preFile);
            }
            $file->move($path,$mediaName);
        }else{
            $mediaName = $preFile ?? null;
        }
        return $mediaName;
    }

    /**
     * This function deletes any file from folder
     * @param $fullFileName
     */
    public static function deleteFile($fullFileName)
    {
        @unlink($fullFileName);
    }

    /**
     * This function deletes the media from folder
     * and database
     * @param $mediaId
     * @param $path
     * @return int
     */
    public static function deleteMedia($mediaId,$path)
    {
        $bannerFile = Media::findOrFail($mediaId);
        $filePath = $path.$bannerFile->file;
        self::deleteFile($filePath);
        return $bannerFile->delete();
    }
}
