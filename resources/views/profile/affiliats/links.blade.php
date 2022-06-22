@extends('profile.dashboard-master')

@section('individualcss')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection
@section('dashboard-wraper')
    <div class="contents">
        <h1 id="create-links">
            Create Links
        </h1>
        <p style="margin: 10px 0">
            <strong>Your MasterLink:</strong>
            <span id="affiliatorMasterLink"
                style="color: #0088e8; border:1px solid gray; padding:3px; border-radius:3px;"></span><span
                class="copybtn" style=""><img src="{{ asset('clone.svg') }}" alt="" width="10px"></span>
        </p>
        <input type="hidden" name="myaffiliationId" id="myaffiliationId"
            value="{{ Auth::user()->affiliation->affiliate_id }}">
        <p>
            <strong>To create Book Affiliation Links by searching for the product:</strong>
        </p>
        <div class="d-flex flex-column">
            <div class="search-input">
                <form action="" method="post">
                    <input name="bookSearchAffiliat" type="text" id="bookSearchAffiliat" autocomplete="off" placeholder="বইয়ের নাম">
                    <div id="divLoaderAffiliate" style="display: none">
                        <div class="lds-spinner">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="search-dropdown-affiliate">
                <ul id="resultsAffiliateBooks">
                </ul>
            </div>
        </div>
    </div>
    <div class="">
        <table id="affiliationLinkTable" class="display" style="margin-top: 10px;">
            <thead>
                <tr>
                    <td>SL:</td>
                    <td>Affiliation Link</td>
                </tr>
            </thead>
            <tbody>
                @forelse ($links as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->link }}</td>
                    </tr>
                @empty

                    <tr>
                        <td >Please create one</td>
                        <td >Please create one</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
    </div>
@endsection

@section('inner-script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#affiliationLinkTable').DataTable();


            /**
             * This block of code finds the books on
             * change of search
             */
            $("input#bookSearchAffiliat").on('keyup', function(event) {
                event.preventDefault();
                var search = $("#bookSearchAffiliat").val();
                if (search) {
                    getAffiliationBook(search);
                    $(".search-dropdown-affiliate").css('display', 'block');
                } else {
                    $(".search-dropdown-affiliate").css('display', 'none');
                }
            });


            /**
             * This function is to get book  based on search
             * @scope local
             * @param search
             */
            function getAffiliationBook(search) {
                $.ajax({
                    type: 'POST',
                    url: BASE_URL + 'common/get-affiliation-book',
                    data: {
                        bookSearch: search
                    },
                    beforeSend: function() {
                        $("#divLoaderAffiliate").css('display', 'block');
                    },
                    success: function(response) {
                        if (response.data) {
                            console.log('data paisi' + response.data);
                        }
                        $("#divLoaderAffiliate").css('display', 'none');
                        console.log('got search response');
                        console.log(response.data);
                        var bookResult = '';
                        if (response.status == "success") {

                            var bookResults = response.data;
                            $.each(bookResults, function(key, value) {
                                bookResult +=
                                    '<li><a class="" href="' +
                                    BASE_URL + 'book/' + value.book_slug +
                                    '">' +
                                    value.book_name +
                                    '</a><button class="btn-grini" onclick="createLink(\'' +
                                    value.book_slug + '\',' + value.id +
                                    ')">Crete</button></li>';
                            });
                            $("#resultsAffiliateBooks").html(bookResult);
                        }
                    }
                });
            }



        });

        function createLink(bookslug, bookID) {
            var affiliationID = $("#myaffiliationId").val();
            var affiBookLink = BASE_URL + 'book/' + bookslug + '?affiliator=' + affiliationID;
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'affiliationLinks',
                data: {
                    link: affiBookLink,
                    bookID: bookID
                },
                success: function(response) {
                    location.reload();
                }
            });
        }

        $("#affiliatorMasterLink").html(BASE_URL + '?referrer=' + $("#myaffiliationId").val());

        $(".copybtn").on('click', function() {
            navigator.clipboard.writeText($("#affiliatorMasterLink").html());
            $(".copybtn").html('Copied');
        });
    </script>
@endsection
