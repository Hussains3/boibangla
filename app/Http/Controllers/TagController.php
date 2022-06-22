<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * This function loads the view of tags to create/list
     * @return view
     */
    public function index()
    {
        $user = Auth::user();
        $tags = Tag::all();
        return view('dashboard.tags.tags',compact('user','tags'));
    }


    /**
     * This function loads the view of tags to create/list
     * @return view
     */
    public function tagShow($tagSlug)
    {
        $tag= Tag::where('slug',$tagSlug)->first();

        $books = Book::select('books.*','book_tags.*','tags.*')->join('book_tags','books.id','=','book_tags.book_id')->join('tags','book_tags.tag_id','=','tags.id')->where('tags.slug','=', $tagSlug)->take(8)->get();
        return view('tags.show',compact('tag', 'books'));
    }

    /**
     * This function creates or updates the tags
     * @param AttributeRequest $attributeRequest
     * @return json
     */
    public function saveTag(StoreTagRequest $storeTagRequest)
    {
        $tagName = $storeTagRequest->tag_name;

        Tag::updateOrCreate(['id'=>$storeTagRequest->editId],['tag'=>ucwords($tagName),'slug'=>Str::slug($tagName)]);

        return response()->json(['status'=>'success','message' => 'Tag saved successfylly !']);

    }

    /**
     * This function returns the list of tags
     * @param Request $listRequest
     * @return json
     * @throws \Exception
     */
    public function listTags(Request $listRequest)
    {
        $tagsData = Tag::listTags($listRequest);
        return datatables($tagsData)->addIndexColumn()->make(true);
    }

    /**
     * This function deletes the attribute with its associated categories
     * @param Request $deleteRequest
     * @return json
     */
    public function deleteTags(Request $deleteRequest)
    {
        Tag::where('id',$deleteRequest->tagId)->delete();
        return response()->json(['status'=>'success','message' => 'Tag deleted successfylly !']);
    }
}
