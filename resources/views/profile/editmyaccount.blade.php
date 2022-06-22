@extends('profile.dashboard-master')


@section('dashboard-wraper')
    <div id="ps" class="ac-content">
        <div class="title">
            Personal Settings
        </div>
        <form action="{{route('users.update',$user->id)}}" method="post">
            @method('PATCH')
            @csrf
            <table id="" style="width:100%;border-collapse:collapse;" cellspacing="0" border="0">
                <tbody>
                    <tr>
                        <td colspan="2">
                            <div class="myaccount-form">
                                <div class="customer-form">
                                    <div style="margin: 0 5px 0 0;" class="name-fild">
                                        Name:
                                    </div>
                                    <div class="input-fild">
                                        <input type="text" name="name" value="{{$user->name}}" required>
                                    </div>
                                    <div class="clearfloat">
                                    </div>
                                </div>
                                <div class="customer-form">
                                    <div style="margin: 0 5px 0 0;" class="name-fild">
                                        Email:
                                    </div>
                                    <div class="input-fild">
                                        <input type="email" name="email" id="email" value="{{$user->email}}">
                                    </div>
                                    <div class="clearfloat">
                                    </div>
                                </div>
                                <div class="customer-form">
                                    <div style="margin: 0 5px 0 0;" class="name-fild">
                                        Phone:
                                    </div>
                                    <div class="input-fild">
                                        <input type="text" name="phone" id="phone" value="{{$user->phone}}">
                                    </div>
                                    <div class="clearfloat">
                                    </div>
                                </div>
                                    <input type="hidden" value="{{$user->roles[0]->id}}" name="role">
                                <div class="form-btn">
                                    <button type="submit" class="btn-red" id="edit" id="saveprofile">Save</button>
                                    <button type="reset" class="btn-red">Reset</button>
                                    <a href="{{url()->previous()}}" class="btn-black">Cancel and Back</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
@endsection
@section('script')

<script>
</script>

@endsection

