@extends('layouts.master')

@section('content')
    <!-- Information div for search result page -->
    <div class="authorList">
        <h3 class="featureHead">লেখক</h3>
        <ul id="listAuthorResult1">
            @forelse ($authors as $author)
                <li>
                    <div class="atrImg">
                        <a href="{{ route('cAuthorBooks', $author->slug) }}">
                            <img
                            src="{{ asset('storage/uploads/authorUpload/'. $author->photo) }}"
                            alt="{{ $author->name }}"
                            width="130"
                            height="150"
                            class="backup_author_picture">
                        </a>
                    </div>
                    <div class="atrCnt">
                        <h3><a href="{{ route('cAuthorBooks', $author->slug) }}">{{ $author->name }}</a></h3>
                        <p>{{ \Illuminate\Support\Str::limit($author->description, 150, $end = '...') }}<a
                                style="color:rgb(188, 50, 50)" href="{{ route('cAuthorBooks', $author->slug) }}"> Read
                                More
                            </a>
                        </p>
                    </div>
                </li>
            @empty
            @endforelse

        </ul>
        <div class="clear"></div>
    </div>
@endsection
