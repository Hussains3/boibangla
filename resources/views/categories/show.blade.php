@extends('layouts.master')

@section('content')
    <div class="">
        <div class="sprite gototop" style="display: none;" onclick="javascript:$(window).scrollTop(0);">
        </div>
        <div id="">
            <!-- main navigation div end -->
            <!-- Information div for search result page -->
            <div class="search-results fltrs demo3">
                {{-- <div class="filters"><a href="javascript:void(0);"></a></div> --}}
                <div class="rwd1">
                    <div class="close-tag"><a href="javascript:void(0);">Close</a></div>
                    <div class="left-column">
                        <div class="store-menu">
                            <h4>{{$category->category}}</h4>
                            <ul class="bullet-link">
                                @forelse ($category->subCategories as $subCategory)
                                    <li class="first-leve">
                                        <a href="{{ route('showSubCategory', $subCategory->slug) }}">{{ $subCategory->subcategory }}</a>
                                    </li>
                                @empty

                                    <li class="first-leve">No Category</li>
                                @endforelse
                            </ul>
                        </div>
                        @include('layouts.partials.leftColumn')
                    </div>
                </div>
                <div class="right-column">
                    <div class="result-heading">
                        <div class="search-summary">
                            <div class="category-head">
                                <h1>{{ $category->category }}</h1>
                            </div>
                            <div class="preferences-show"><b>{{ count($books) }}</b> results found</div>
                        </div>
                    </div>
                    <div class="product" id="gridSearchResult">
                        <div class="grid-view">
                            @forelse ($books as $book)
                                @include('layouts.partials.bookItem')
                            @empty
                                <p>No Book Found.</p>
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    var filterFormurl = "{{ route('showCategory', $category->category_slug) }}";
    $("#filterbtn").click(function (e) {
        e.preventDefault();
        $("form#bookFilterForm").attr('action', filterFormurl);
        $("form#bookFilterForm").submit();
    });
</script>
@endsection
