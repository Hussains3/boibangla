<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TrackOrderRequest;
use App\Services\TrackingService;

class TrackOrderController extends Controller
{
    protected $success = false;
    protected $data = [];

    /**
     * This function loads the order tracking page
     * @return View
     */
    public function index()
    {
        return view('order-tracking.order-tracking');
    }

    /**
     * This function gives the json response of order tracking
     * @param TrackOrderRequest $trackOrderRequest
     * @return json
     */
    public function trackOrder(TrackOrderRequest $trackOrderRequest)
    {
        $trackingData =  TrackingService::trackOrder($trackOrderRequest->order_no);
        if ($trackingData){
            $success = true;
            $data['order_no'] = $trackOrderRequest->order_no;
            $data['tracking_data'] = $trackingData;
        }
        return response()->json(['success' => $success,'data' => $data]);
    }
}
