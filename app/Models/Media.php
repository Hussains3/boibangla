<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    const BANNER = 1;
    const ACTIVE = 1;
    const INACTIVE = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['file', 'type', 'status', 'data'];

    /**
     * The attributes that aren't mass assignable.
     * @var array
     */
    protected $guarded = ['created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * fields will be Carbon-ized
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'file' => 'string',
        'type' => 'string',
        'status' => 'int',
        'data' => 'json',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * This function saves the media to database
     * @param $bannerRequest
     * @param $mediaName
     * @param $additionalData
     * @param $type
     * @return int
     */
    public static function saveMedia($bannerRequest,$mediaName, $additionalData, $type)
    {
        return self::updateOrCreate(['id' => $bannerRequest->editId],[
            'file' => $mediaName,
            'type' => $type,
            'data' => $additionalData,
        ]);
    }

    /**
     * This function returns the list of media files based on type
     * @param $bannerRequest
     * @param $mediaType
     * @return collection
     */
    public static function listMedia($bannerRequest,$mediaType)
    {
        $bannerFilter = $bannerRequest->banner_filter;
       return self::select('*')
            ->where('type',$mediaType)
            ->when($bannerFilter,function($queryFilter) use($bannerFilter){
                $queryFilter->where('status',$bannerFilter);
            })
            ->orderBy('id','DESC')
            ->get();
    }
}
