<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Http\Requests\StoreNewsletterRequest;
use App\Http\Requests\UpdateNewsletterRequest;
use Illuminate\Http\Request;
use App\Models\ComposeNewsLetter;
use App\Helper\ResponseHelper;
use App\Services\MediaService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ComposeRequest;

class NewsletterController extends Controller
{
        /**
     * This function loads the view of newsletter list
     * @return view
     */
    public function index()
    {
        $user = Auth::user();
        return  view('dashboard.newsletter.newsletters',compact('user'));
    }
    public function getSubscribers()
    {
        $user = Auth::user();
        return  view('dashboard.newsletter.newsletter-subscribers',compact('user'));
    }
    /**
     * This function returns the list of newsletter subscribers
     * @param Request $listRequest
     * @return json
     * @throws \Exception
     */
    public function listSubscribers(Request $listRequest)
    {
        $newsletters = Newsletter::listSubscribers($listRequest);
        return datatables($newsletters)->addIndexColumn()->make(true);
    }
    /**
     * This function changes the newsletter to be active or in-active
     * @param Request $statusRequest
     * @return json
     */
    public function changeSubscriberStatus(Request $statusRequest)
    {
        Newsletter::where(['id'=>$statusRequest->id])->update(['status'=>$statusRequest->status]);
        return response()->json(['status'=>'success','message'=>'Discount '.(($statusRequest->status==1?'activated':'de-activated')).' successfully !']);
    }

    /**
     * This function loads the view to compose the newsletter
     * @return View
     */
    public function composeNewsletter()
    {
        return view('dashboard.newsletter.compose-newsletter');
    }

    /**
     * This function returns the the composed newsletters
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function getAllNewsletters(Request $request)
    {
        $newsletters = ComposeNewsletter::getAllNewsletters($request);
        return datatables($newsletters)->addIndexColumn()->make(true);
    }

    /**
     * This function composes the newsletter
     * @param ComposeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveComposedNewsletters(ComposeRequest $request)
    {
        try{
            $hasFile = $request->hasFile('newsletter_image');
            $mediaFile = $request->file('newsletter_image');
            $mediaName = MediaService::saveMedia($mediaFile,$hasFile,null);
            ComposeNewsletter::composeNewsletter($request, $mediaName);
            return ResponseHelper::successResponse(__('Newsletter composed successfully'));
        }catch(\Exception $exception) {
            return ResponseHelper::errorResponse($exception->getMessage(),201);
        }
    }
    public function preview()
    {
        return view('emails.customer.newsletter');
    }
}
