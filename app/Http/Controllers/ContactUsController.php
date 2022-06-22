<?php

namespace App\Http\Controllers;
use App\Models\Query;
use Illuminate\Support\Facades\Mail;
use App\Mail\QueryPostedMail;
use App\Http\Requests\StoreQueryRequest;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     *
     * @param QueryRequest $queryRequest
     */
    public function contactUs(StoreQueryRequest $queryRequest)
    {

        $user = [
            'name' => $queryRequest->name,
            'phone' => $queryRequest->phone,
            'email' => $queryRequest->email,
            'subject' => $queryRequest->subject,
            'message' => $queryRequest->message,
        ];

        // return response()->json(['status'=>'form submiting','data'=>$user]);


        try {
            Query::create($user);
            Mail::to($user['email'])->send(new QueryPostedMail($user));
            return response()->json(['status'=>'success','message' => 'We have received your message, will contact you soon']);
        }catch (\Exception $exception){}
    }
}
