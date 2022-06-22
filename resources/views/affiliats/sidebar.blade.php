
<div class="affiliat-menu">
    <a href="{{route('gaffiliats')}}" class="btn-red">About the Programme</a>
    <a href="{{route('gaffiliatsPayment')}}" class="btn-red">Payments</a>
    <a href="{{route('gaffiliatsCondition')}}" class="btn-red">Terms &amp; Conditions</a>
    @guest
    <a href="{{route('register.show')}}" class="btn-red">Signup & Join As Affialiator</a>
    @endguest
    @auth
    <form action="{{route('affiliationapplication.store')}}" method="post" class="@role('affiliator') d-none @endrole">
        @csrf
        <input type="submit" value="Apply as an Affialiator" class="btn-red">
    </form>
    @endauth

</div>
