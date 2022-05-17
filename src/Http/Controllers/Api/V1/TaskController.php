<?php

namespace Farhadhp\SimpleTodo\Http\Controllers\Api\V1;

use Farhadhp\SimpleTodo\Http\Requests\Api\V1\TaskStoreRequest;
use Farhadhp\SimpleTodo\Http\Requests\Api\V1\TaskUpdateRequest;
use Farhadhp\SimpleTodo\Http\Resources\V1\TaskResource;
use Farhadhp\SimpleTodo\Services\TaskService;
use Illuminate\Http\Request;
use Farhadhp\SimpleTodo\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $query = Task::query();
        $query->author(auth()->user()->id);
        $query->with('labels');

        if ($request->has('labels')) {
            $query->labelFilter($request->get('labels', []));
        }

        $tasks = $query->paginate(10);

        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskStoreRequest $request
     * @return TaskResource
     */
    public function store(TaskStoreRequest $request)
    {
        $data = $request->only([
            'title',
            'description',
            'labels'
        ]);

        $task = (new TaskService())
            ->create($data, Auth::user());

        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return TaskResource
     */
    public function show($id)
    {
        $task = auth()->user()->tasks()->with('labels')->findOrFail($id);

        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TaskUpdateRequest $request
     * @param $id
     * @return TaskResource
     */
    public function update(TaskUpdateRequest $request, $id)
    {
        $task = auth()->user()->tasks()->findOrFail($id);
        $data = $request->only([
            'title',
            'description',
            'status',
        ]);

        $item = (new TaskService())->update($task, $data);

        return new TaskResource($item);
    }
}
