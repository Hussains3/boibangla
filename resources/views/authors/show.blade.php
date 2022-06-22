@extends('layouts.master')

@section('content')
    <!-- Information div for search result page -->
    <input type="hidden" name="ctl00$phBody$hdnSearchtext" id="ctl00_phBody_hdnSearchtext">
    <div class="search-results fltrs">
        <div class="rwd1">
            <div class="close-tag"><a href="javascript:void(0);">Close</a></div>
            <div class="left-column">
                @include('layouts.partials.leftColumn')
            </div>
        </div>
        <div class="right-column">
            <div class="authorDtl">
                <div class="authorImg">
                    <img alt="{{ $author->name }}" class="bklazy backup_author_picture" style="display: block;"
                        src="{{ asset('storage/uploads/authorUpload/' . $author->photo) }}" width="130" height="150">
                </div>
                <div class="authorCnt">
                    <p>
                        <strong>{{ $author->name }}</strong>
                        <span class="show-read-more">{{ $author->description }}</span>
                    </p>
                </div>
            </div>
            <div class="result-heading">
                <div class="search-summary search-heading">
                    <div class="preferences-show"><b>{{ count($author->books) }}</b> results found</div>
                </div>
            </div>
            <div class="product" id="listSearchResult">
                <div class="grid-view">
                    <ul class="listing-grid personas">
                        @forelse ($author->books as $book)
                            @include('layouts.partials.bookItem')
                        @empty
                            <p>No Book Found.</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var maxLength = 300;
            $(".show-read-more").each(function() {
                var myStr = $(this).text();
                if ($.trim(myStr).length > maxLength) {
                    var newStr = myStr.substring(0, maxLength);
                    var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                    $(this).empty().html(newStr);
                    $(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
                    $(this).append('<span class="more-text">' + removedStr + '</span>');
                }
            });
            $(".read-more").click(function() {
                $(this).siblings(".more-text").contents().unwrap();
                $(this).remove();
            });
        });
    </script>
@endsection
