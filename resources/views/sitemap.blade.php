@extends('layouts.master')

@section('content')
<div class="artical-main">
    <table class="all-categories" width="100%" cellspacing="0" cellpadding="0" border="0">
        <tbody>
            <tr>
                <td class="site-map">

                    <ul>
                        <li><a href="{{route('home.index')}}">Home</a></li>
                    </ul>
                    <p>Company</p>


                    <ul>
                        <li><a href="{{route('aboutUs')}}">About Us</a></li>
                        <li><a href="{{route('viewContactUs')}}">Contact Us</a></li>

                    </ul>

                    <p>Policies</p>


                    <ul>
                        <li><a href="{{route('privacyPolicies')}}">Privacy Policies</a></li>
                        <li><a href="{{route('termsOfUse')}}">Terms of Use</a></li>
                        <li><a href="{{route('secureshoping')}}">Secure Shopping</a></li>
                        <li><a href="{{route('copyrigttpolicy')}}">Copyright Policy</a></li>
                    </ul>

                    <p>Affiliate</p>

                    <ul>
                        <li><a href="{{route('gaffiliats')}}">About the Programme</a></li>
                        <li><a href="{{route('gaffiliatsPayment')}}">Payments</a></li>
                        <li><a href="{{route('gaffiliatsCondition')}}">Terms &amp; Conditions</a></li>
                    </ul>


                </td>
                <td class="site-map">

                    <p>Books by Category</p>
                    <ul>
                        @forelse ($categories as $category)

                        <li><a href="{{route('showCategory',$category->category_slug)}}">{{$category->category}}</a></li>
                        @empty

                        @endforelse
                    </ul>

                </td>
                <td class="site-map">
                    <p>Browse by Author</p>
                    <ul>
                        <li><a href="{{route('cfeaturedAuthors')}}">Books by Author</a></li>
                    </ul>
                    <p>Browse by Publisher</p>
                    <ul>
                        @foreach ($publications as $publication)

                        <li><a href="{{route('cPublicationBooks',$publication->slug)}}">{{$publication->name}}</a></li>
                        @endforeach
                    </ul>

                    <p>Help</p>
                    <ul>
                        <li><a href="{{route('payment')}}">Payment</a></li>
                        <li><a href="{{route('shipping')}}">Shipping</a></li>
                        <li><a href="{{route('returnPolicy')}}">Return</a></li>
                        <li><a href="{{route('faq')}}">FAQ</a></li>
                    </ul>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
