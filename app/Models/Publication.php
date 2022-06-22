<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','slug','logo', 'discount','description', 'status'];

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
        'name' => 'string',
        'slug' => 'string',
        'logo' => 'string',
        'description' => 'string',
        'status' => 'int',
        'discount' => 'int',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * This function creates/updates book publications
     * @param $publicationRequest
     * @return Collection
     */
    public static function savePublications($publicationRequest)
    {
        $publicationLogo = $publicationRequest->file('publicationLogo');
        if ($publicationRequest->hasFile('publicationLogo')) {
            $publicationImageName =  $publicationRequest->publicationSlug.'-'.$publicationLogo->getClientOriginalName();
            $path = storage_path('app/public/uploads/publications/');
            if ($publicationRequest->prePublicationLogo !="null" && $publicationRequest->prePublicationLogo){
                @unlink($path.$publicationRequest->prePublicationLogo);
            }
            $publicationLogo->move($path, $publicationImageName);
        }else{
            $publicationImageName = $publicationRequest->prePublicationLogo;
        }
        $publicationData = [
            'name' => $publicationRequest->publicationName,
            'slug'=> $publicationRequest->publicationSlug,
            'logo' => $publicationImageName,
            'description' => $publicationRequest->description,
            'discount' => $publicationRequest->discount,
        ];
        return self::updateOrCreate(['id' => $publicationRequest->editId],$publicationData);
    }




    /**
     * This function returns all the publications
     * @param $request
     * @purpose admin
     * @return collection
     */
    public static function getPublicationList($request)
    {
        $publicationStatus = $request->publicationStatus;
        $publicationNameSearch = $request->publicationNameSearch;
        return self::select(
            'id',
            'name',
            'slug',
            'logo',
            'description',
            'discount',
            'status'
            )
            ->when($publicationNameSearch, function ($nameQuery) use ($publicationNameSearch) {
                return $nameQuery->where('name', 'like','%'. $publicationNameSearch . '%');
            })
            ->when($publicationStatus, function ($statusQuery) use ($publicationStatus) {
                 $statusQuery->where('status',$publicationStatus);
            })
            ->orderBy('id', 'DESC')
            ->get();
    }




    /**
     * This function deletes the publication
     * @param $request
     * @purpose admin
     * @return collection
     */
    public static function deletePublication($request)
    {
        @unlink(storage_path('app/public/uploads/publications/').$request->logo);
        return self::where('id',$request->publicationId)->delete();
    }




    public function books() {
        return $this->hasMany(PublicationBook::class,'publication_id','id')
          ->join('books','publication_books.book_id','books.id');
    }
}
