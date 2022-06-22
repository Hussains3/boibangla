<?php

namespace App\Http\Controllers;

use App\Models\ProcessLog;
use App\Http\Requests\StoreProcessLogRequest;
use App\Http\Requests\UpdateProcessLogRequest;

class ProcessLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreProcessLogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcessLogRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcessLog  $processLog
     * @return \Illuminate\Http\Response
     */
    public function show(ProcessLog $processLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProcessLog  $processLog
     * @return \Illuminate\Http\Response
     */
    public function edit(ProcessLog $processLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProcessLogRequest  $request
     * @param  \App\Models\ProcessLog  $processLog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcessLogRequest $request, ProcessLog $processLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcessLog  $processLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcessLog $processLog)
    {
        //
    }
}
