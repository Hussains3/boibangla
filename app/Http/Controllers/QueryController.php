<?php

namespace App\Http\Controllers;

use App\Models\Query;
use App\Http\Requests\StoreQueryRequest;
use App\Http\Requests\UpdateQueryRequest;
use Illuminate\Http\Request;


class QueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $quries = Query::all();
        return view('dashboard.query.queries');
    }

    /**
     * This function returns the queries raised by customers form websites
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Exception
     */
    public function listQueries(Request $request)
    {
        $queries = Query::listQueries($request);
        return datatables($queries)->addIndexColumn()->make(true);
    }

    /**
     * This function deletes the query
     * @param Request $request
     * @return json
     */
    public function deleteQuery(Request $request)
    {
        Query::where('id', $request->id)->delete();
        return response()->json(['success' => true,'message' => 'Popup details updated successfully']);
    }
}
