@extends('profile.dashboard-master')


@section('dashboard-wraper')
    <div id="ps" class="ac-content">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <div class="">
                <h2>My Addresses</h2>
            </div>
            <div class="">
                <a href="{{ route('addAddress') }}" style="text-decoration:none;" class="btn-red">Add a New
                    Address</a>
            </div>
        </div>
        <div class="">
            @forelse ($addresses as $key=>$address)
                {{-- Address --}}
                <div class="prv-address">

                    <div class="top">
                        <div class="ps-1">
                            {{ $address->full_name }}
                        </div>
                        <div class="d-flex">
                            <a href="{{route('editAddress',$address->id)}}" class="btn-red-micro">
                                Edit
                            </a>
                            <form action="{{route('deleteAddress',$address->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="addressId" value="{{$address->id}}">
                                <button type="submit" class="btn-red-micro">Delete</button>
                            </form>
                        </div>
                    </div>


                    <div class="address-box">
                        <p>
                            <span>
                                {{ $address->street_address }}
                            </span>
                            <span>
                                {{ $address->town_city }}
                            </span>
                            <span>
                                {{ $address->state }} - {{ $address->postal_code }}
                            </span>
                            <span>
                                <label id="ctl00_cpBody_lvCustomerAdd_ctrl0_lblMobile">Mobile:
                                    {{ $address->contact }}
                                </label>
                            </span>
                        </p>
                    </div>
                </div>

            @empty

                <div id="ctl00_cpBody_lvCustomerAdd_ctrl0_divNoShipping" class="no-shipping-address">
                    The shipping address will be saved to your account to help you a faster checkout
                    with your next orders.
                </div>
            @endforelse
        </div>
    </div>
@endsection
@section('script')
    <script>
        function ClosePopup() {
            document.getElementById('ctl00_phBody_AccountSetting_fvCustomer_plnOTP').style.display = "none";
        }
    </script>
@endsection
