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
}
