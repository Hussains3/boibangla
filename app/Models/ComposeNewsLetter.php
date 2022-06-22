<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComposeNewsLetter extends Model
{
    use HasFactory;

    const ACTIVE = 1;
    const INACTIVE = 2;
    const COMPOSED = 2;
    const NOT_COMPOSED = 1;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','description','image','link','scheduled_at','composed','status'];

    /**
     * The attributes that aren't mass assignable.
     * @var array
     */
    protected $guarded = ['created_at','updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at','updated_at'];

    /**
     * fields will be Carbon-ized
     * @var array
     */
    protected $dates = ['created_at','updated_at'];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'image' => 'string',
        'scheduled_at' => 'date',
        'composed' => 'int',
        'status' => 'int',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * This function used to compose newsletter
     * @param $request
     * @param $image
     * @return object
     */
    public static function composeNewsletter($request, $image)
    {
        return self::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image,
            'link' => $request->link,
            'scheduled_at' => date('Y-m-d', strtotime($request->scheduled_at)),
        ]);
    }

    /**
     * This function returns the the composed newsletters
     * @param $request
     * @return Collection
     */
    public static function getAllNewsletters($request)
    {
        return self::all();
    }
    public static function getNewsletterForDate($date, $composed)
    {
        return self::select('*')
            ->whereDate('scheduled_at', $date)
            ->where('composed', $composed)
            ->get();
    }
}
