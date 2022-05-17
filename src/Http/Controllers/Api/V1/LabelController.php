<?php

namespace Farhadhp\SimpleTodo\Http\Controllers\Api\V1;

use Farhadhp\SimpleTodo\Http\Resources\V1\LabelResource;
use Illuminate\Http\Request;
use Farhadhp\SimpleTodo\Models\Label;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labels = Label::paginate(10);

        return LabelResource::collection($labels);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Lable  $lable
     * @return \Illuminate\Http\Response
     */
    public function show(Lable $lable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Lable  $lable
     * @return \Illuminate\Http\Response
     */
    public function edit(Lable $lable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Lable  $lable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lable $lable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Lable  $lable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lable $lable)
    {
        //
    }
}
