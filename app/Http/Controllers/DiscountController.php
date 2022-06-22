<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Carbon;

class DiscountController extends Controller
{
    protected $success = false;
    protected $data = [];

    public function index()
    {
        $discounts = Discount::all();
        return view('dashboard.discount.index',compact('discounts'));
    }

    public function getAttrr(Request $request)
    {
        print_r($request->all());
    }

    /**
     * This function creates/updates the discounts
     * @param StoreDiscountRequest $discountRequest
     * @return json
     */
    public function createDiscount(StoreDiscountRequest $discountRequest)
    {
        $startDate = date('Y-m-d H:i:s',strtotime($discountRequest->startDate));
        $endDate = date('Y-m-d H:i:s',strtotime($discountRequest->validityDate));
        $discountData = [
            'coupon_name' => strtoupper($discountRequest->couponName),
            'discount' => $discountRequest->discount,
            'description' => $discountRequest->description,
            'start_date' => Carbon::createFromFormat('Y-m-d H:i:s',$startDate),
            'validity_date' => Carbon::createFromFormat('Y-m-d H:i:s',$endDate),
        ];
        if ($discountRequest->categories){
            $discountData['categories'] =  implode(',',$discountRequest->categories);
        }
        Discount::updateOrCreate(['id'=>$discountRequest->editId],$discountData);
        return response()->json(['status'=>'success','message'=>'Discount saved successfully !']);
    }

    /**
     * This function returns the list of discounts
     * @param Request $listRequest
     * @return json
     */
    public function listDiscount(Request $listRequest)
    {
        $discounts = Discount::listDiscount($listRequest);
        return datatables($discounts)->addIndexColumn()->make(true);
    }

    /**
     * This function deletes the discount permanently
     * @param Request $deleteRequest
     * @return json
     */
    public function deleteDiscount(Request $deleteRequest)
    {
        Discount::where(['id'=>$deleteRequest->discountId])->delete();
        return response()->json(['status'=>'success','message'=>'Discount deleted successfully !']);
    }

    /**
     * This function changes the discount to be active or in-active
     * @param Request $statusRequest
     * @return json
     */
    public function changeDiscountStatus(Request $statusRequest)
    {
        Discount::where(['id'=>$statusRequest->discountId])->update(['status'=>$statusRequest->updateStatus]);
        return response()->json(['status'=>'success','message'=>'Discount '.(($statusRequest->updateStatus==1?'activated':'de-activated')).' successfully !']);
    }


    
    public function getDiscountInfo(Request $request)
    {
        $discountId = $request->discountId;
        $discount = Discount::findOrFail($discountId);
        if ($discount){
            $this->success = true;
            $this->data = $discount;
        }
        return response()->json(['status'=> $this->success,'data' => $this->data]);
    }
}
