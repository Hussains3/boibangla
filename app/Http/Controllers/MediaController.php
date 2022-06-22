<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Services\MediaService;
use Symfony\Component\HttpFoundation\Request;
use App\Helper\ResponseHelper;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\BannerRequest;

class MediaController extends Controller
{
    /**
     * This function loads the banner images view
     * @return view
     */
    public function index()
    {
        return view('dashboard.media.banner-images');
    }

    /**
     * This function saves the banner media
     * @param BannerRequest $bannerRequest
     * @return json
     */
    public function saveBanner(BannerRequest $bannerRequest)
    {
        $preFile = null;
        $hasFile = $bannerRequest->hasFile('media');
        $mediaFile = $bannerRequest->file('media');
        if ($bannerRequest->editId != ""){
            $preFile = Media::select('file')->where('id',$bannerRequest->editId)->value('file');
        }
        $additionalData = [
            'title' => ucwords($bannerRequest->title),
            'sub_title' => ucwords($bannerRequest->sub_title),
            'button_label' => ucwords($bannerRequest->button_label),
            'button_link' => strtolower($bannerRequest->button_link),
        ];

        $mediaName = MediaService::saveMedia($mediaFile,$hasFile,$preFile);

        
        if ($mediaName){
            Media::saveMedia($bannerRequest,$mediaName,$additionalData,Media::BANNER);
            return response()->json(['status'=>'success','message'=>'Banner saved successfully !']);
        }
    }

    /**
     * This function gets info of a banner
     * @param Request $request
     * @return json
     */
    public function getBannerInfo(Request $request)
    {
        $banner = Media::findOrFail($request->bannerId);
        return response()->json(['success' => true, 'banner' => $banner]);
    }

    /**
     * This function returns the list of banners
     * @param Request $bannerRequest
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Exception
     */
    public function listBanner(Request $bannerRequest)
    {
        $banners = Media::listMedia($bannerRequest, Media::BANNER);
        return datatables($banners)->addIndexColumn()->make(true);
    }

    /**
     * This funcion deletes the media
     * @param Request $request
     * @return json
     */
    public function deleteBanner(Request $request)
    {
        MediaService::deleteMedia($request->bannerId,Config::get('constants.paths.media'));
        return response()->json(['status'=>'success','message'=>'Banner deleted successfully !']);
    }

    /**
     * This function changes the media status
     * @param Request $statusRequest
     * @return json
     */
    public function changeMediaStatus(Request $statusRequest)
    {
        Media::where(['id'=>$statusRequest->bannerId])->update(['status'=>$statusRequest->updateStatus]);
        return response()->json(['status'=>'success','message'=>'Banner '.($statusRequest->updateStatus== Media::ACTIVE ?'activated':'de-activated')]);
    }

    /**
     * This function loads the others media page
     * @return View
     */
    public function viewOtherMedia()
    {
        return view('dashboard.media.other-media-images');
    }

    /**
     * Thi function loads the list of other media
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Exception
     */
    public function listOtherMedia(Request $request)
    {
        $otherImages = Media::whereIn('type', ['other_img1','other_img2','other_img3','other_img4','other_img5','other_img6'])->get();
        return datatables($otherImages)->addIndexColumn()->make(true);
    }

    /**
     * This function saves the other media
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveOtherMedia(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,JPG,JPEG,PNG',
        ]);
        try {
            $count = Media::where('type','LIKE',"other_img%")->count();
            if (!$request->id){
                if ($count >= 6){
                    return ResponseHelper::errorResponse("No more than 6 images can be added",201);
                }
            }
            $preFile = $request->pre_image;
            $hasFile = $request->hasFile('image');
            $imageFile = $request->file('image');
            $otherImgName = MediaService::saveMedia($imageFile,$hasFile,$preFile);
            $data = [
                'file' => $otherImgName,
                'data' => ['link' => $request->link],
            ];
            if (!$request->id) {
                $data['type'] = 'other_img' . ($count + 1);
            }
            Media::updateOrCreate(['id' => $request->id], $data);
            return ResponseHelper::successResponse(__('Media image saved successfully'));
        }catch (\Exception $exception){
            return ResponseHelper::errorResponse($exception->getMessage(),201);
        }
    }
    /**
     * This function finds the other media info
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOtherMediaInfo(Request $request)
    {
        try{
            $media = Media::findOrFail($request->id);
            return ResponseHelper::successResponse('Data returned successfully', $media);
        }catch(\Exception $exception){
            return ResponseHelper::errorResponse("Some errors occurred ". $exception->getMessage(),201);
        }
    }
}
