<div class="book-leftbar">
    <div class="books-category">
       <h2>বিষয় সমূহ</h2>
       <ul>
           @foreach ($categories as $category)

           <li><a href="{{route('showCategory', $category->category_slug)}}">{{ $category->category}}</a></li>
           @endforeach
        </ul>
       <div id="ctl00_phBody_divbookmap" class="rgtbanner">
       </div>
    </div>
 </div>

