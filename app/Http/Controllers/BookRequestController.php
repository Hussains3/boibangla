<?php

namespace App\Http\Controllers;

use App\Models\BookRequest;
use App\Http\Requests\StoreBookRequestRequest;
use App\Http\Requests\UpdateBookRequestRequest;

class BookRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookRequests = BookRequest::all();
        return view('dashboard.bookRequests.index',compact('bookRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequestRequest $request)
    {

        $bookRequest = new BookRequest();
        $bookRequest->name = $request->name;
        $bookRequest->phone = $request->phone;
        $bookRequest->email = $request->email;
        $bookRequest->book_name = $request->book_name;
        $bookRequest->writer_publisher_name = $request->writer_publisher_name;
        $bookRequest->save();

        if ($bookRequest) {
            $response = response()->json(['status'=>'success','message' => 'Book request submited successfully']);
        }else{

            $response = response()->json(['status'=>'fail','message' => 'Something Wrong!']);
        }

        return $response;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookRequest  $bookRequest
     * @return \Illuminate\Http\Response
     */
    public function show(BookRequest $bookRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookRequest  $bookRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(BookRequest $bookRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequestRequest  $request
     * @param  \App\Models\BookRequest  $bookRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequestRequest $request, BookRequest $bookRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookRequest  $bookRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookRequest $bookRequest)
    {
        $bookRequest->delete();

        return redirect()->route('bookRequests.index')
            ->withSuccess(__('Book marked as collected'));
    }
}
