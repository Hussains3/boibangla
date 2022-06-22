<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class AddressController extends Controller
{
    /**
     * This function loads the customer address
     * @return view
     */
   public function index()
   {
       $addresses = Address::getMyAddresses();
       return view('customer.addresses.addresses',['addresses'=>$addresses]);
   }

    /**
     * This function shows the form to create address
     * @return view
     */
   public function addAddress()
   {
       $countries = Country::all();
       return view('profile.addAddress',['countries'=>$countries]);
   }
    /**
     * This function shows the form to edit address
     * @return view
     */
   public function editAddress($addressId)
   {
       $countries = Country::all();
       $address = Address::getAddressInfo($addressId);
       return view('profile.editaddress',['countries'=>$countries,'address'=>$address]);
   }
    /**
     * This function creates/updates the address
     * @param StoreAddressRequest $addressRequest
     * @return json
     */
    public function createUpdateAddress(StoreAddressRequest $addressRequest)
    {
        $createUpdate = Address::createUpdateAddress($addressRequest);
        $response = response()->json(['status'=>'success','message'=>'Address details saved successfully']);
        return $response;
    }
    /**
     * This function deletes the address from database
     * @return view
     */
   public function deleteAddress(Request $deleteRequest)
   {
       $address = Address::find($deleteRequest->addressId)->delete();
       return redirect()->route('viewCustomerAddresses')->withSuccess(['message'=>'Address deleted successfully']);
   }
}
