<!-- The Modal -->
<div id="readModal" class="modal " height="70vh">
    <!-- Modal content -->
    <div class="modal-content" >
        <div class="d-flex justify-content-end"><span id="readModalClose" class="btn-red">&times;</span></div>
        @if ($bookDetail->book_image_1)
        <img src="{{ asset('storage/uploads/books/'.$bookDetail->book_image_1) }}" alt="" srcset="" width="100%">
        @endif
        @if ($bookDetail->book_image_2)
        <img src="{{ asset('storage/uploads/books/'.$bookDetail->book_image_2) }}" alt="" srcset="" width="100%">
        @endif
        @if ($bookDetail->book_image_3)
        <img src="{{ asset('storage/uploads/books/'.$bookDetail->book_image_3) }}" alt="" srcset="" width="100%">
        @endif
        @if ($bookDetail->book_image_4)
        <img src="{{ asset('storage/uploads/books/'.$bookDetail->book_image_4) }}" alt="" srcset="" width="100%">
        @endif
        @if ($bookDetail->book_image_5)
        <img src="{{ asset('storage/uploads/books/'.$bookDetail->book_image_5) }}" alt="" srcset="" width="100%">
        @endif
    </div>
</div>
