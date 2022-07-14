@extends('profile.dashboard-master')


@section('dashboard-wraper')
    <div id="ps" class="ac-content">
        <div class="title">
            My Addresses
        </div>
        <div id="plnAccount">

            <form id="addressCreateUpdateForm">

                <!-- Div For Add New Address Section -->
                <div class="myaccount-form">
                    <h2>
                        <label id="lblheading">Add a New Address</label>
                    </h2>

                    <div class="customer-form">
                        <div class="name-fild mandatory">
                            First Name:
                        </div>
                        <div class="input-fild">
                            <input name="first_name" type="text" maxlength="50" id="first_name" style="" value="{{$address->first_name??''}}"  autocomplete="off">

                            <br>
                            <span id="first_name" class="error" style="display:none;">Required</span>
                        </div>
                        <div class="clearfloat">
                        </div>
                    </div>

                    <div class="customer-form">
                        <div class="name-fild mandatory">
                            Last Name:
                        </div>
                        <div class="input-fild">
                            <input name="last_name" type="text" maxlength="50" id="last_name" style="" autocomplete="off" value="{{$address->last_name??''}}">

                            <br>
                            <span id="last_name" class="error" style="display:none;">Required</span>
                        </div>
                        <div class="clearfloat">
                        </div>
                    </div>

                    <div class="customer-form">
                        <div class="name-fild mandatory">
                            Email Address:
                        </div>
                        <div class="input-fild">
                            <input type="email" name="email_address" id="email_address" value="{{$address->email??''}}">
                            <span id="" class="error" style="display:none;">Required</span>
                        </div>
                        <div class="clearfloat">
                        </div>
                    </div>


                    <div class="customer-form">
                        <div class="name-fild mandatory">
                            Contact:
                        </div>
                        <div class="input-fild">
                            <input name="address_contact" type="text" maxlength="50" id="address_contact" style="" value="{{$address->contact??''}}" autocomplete="off">

                        </div>
                        <div class="clearfloat">
                        </div>
                    </div>


                    {{-- Address type --}}
                    <div class="customer-form">
                        <div class="name-fild mandatory">
                            Address Type:
                        </div>
                        <div class="input-fild">
                            <div class="baseDDL">
                                <select name="address_type" id="address_type" style="width: 202px;">
                                    <option value="">Select</option>
                                    <option value="1" {{ ($address->address_type ?? '') == 1 ? 'selected' : '' }}>Home
                                    </option>
                                    <option value="2" {{ ($address->address_type ?? '') == 2 ? 'selected' : '' }}>Office
                                    </option>
                                    <option value="3" {{ ($address->address_type ?? '') == 3 ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                            </div>
                            <div>
                                <span id="address_type_error" class="error" style="display:none;">Required</span>
                            </div>
                        </div>
                        <div class="clearfloat">
                        </div>
                    </div>


                    <div class="customer-form">
                        <div class="name-fild mandatory">
                            Country:
                        </div>
                        <div class="input-fild" id="divCountry">
                            <div class="baseDDL">
                                <select name="ddlCountry" id="ddlCountry" style="width: 202px;">
                                    <option value="">Select</option>
                                    @if ($countries)
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                {{ ($address->country ?? '') == $country->id ? 'selected' : '' }}>
                                                {{ $country->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <input type="hidden" name="cdlCountries_ClientState" id="cdlCountries_ClientState"
                                    value="India:::India">
                            </div>
                            <div>
                                <span id="Country" class="error" style="display:none;">Required</span>
                            </div>
                        </div>
                        <div class="clearfloat">
                        </div>
                    </div>

                    <div class="customer-form">
                        <div class="name-fild mandatory">
                            Street Address:
                        </div>
                        <div class="input-fild mandatory">
                            <input name="street_address" type="text"  id="street_address" autocomplete="off">
                            <span id="street_address_error" class="error" style="display:none;">Required</span>
                        </div>
                        <div class="clearfloat">
                        </div>
                    </div>


                    <div class="customer-form">
                        <div class="name-fild mandatory">
                            District:
                        </div>
                        <div class="input-fild mandatory">
                            <input name="state" type="text"  id="state" autocomplete="off">
                            <span id="state_error" class="error" style="display:none;">Required</span>
                        </div>
                        <div class="clearfloat">
                        </div>
                    </div>




                    <div class="customer-form">
                        <div class="name-fild mandatory">
                            Town/City:
                        </div>
                        <div class="input-fild">
                            <input name="city_town" type="text"  id="city_town" autocomplete="off">
                            <span id="city_town_error" class="error" style="display:none;">Required</span>
                        </div>
                        <div class="clearfloat">
                        </div>
                    </div>



                    <div class="customer-form">
                        <div class="name-fild mandatory">
                            Postal/Zip Code:
                        </div>
                        <div class="input-fild">
                            <input name="postal_zip_code" type="text"  id="postal_zip_code" autocomplete="off">
                            <span id="postal_zip_code_error" class="error" style="display:none;">Required</span>
                        </div>
                        <div class="clearfloat">
                        </div>
                    </div>

                </div>



                <div class="customer-form">
                    <div class="name-fild">
                    </div>
                    <div class="input-fild">
                        <span id="lblMsg" style="color:Red;"></span>
                    </div>
                </div>
                <div class="form-btn">
                    <table width="25%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                            <tr>
                                <td>
                                    <input type="submit" name="saveAddressBtn" value="Save Address" id="saveAddressBtn" class="btn-red" alternatetext="Submit">
                                </td>
                                <td>
                                    <a href="{{ url()->previous() }}" style="padding-left: 8px;margin-left:10px;" class="btn-black">Cancel</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </form>
        </div>

    </div>
@endsection
@section('script')
    <script src="{{asset('assets/js/customer/address/create-update-address.js')}}" type="text/javascript"></script>
@endsection
