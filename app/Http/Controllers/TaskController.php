<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks.
     *
     * @return App\Http\Resources\TaskCollection
     */
    public function index(Request $request)
    {
        $task = Task::with('notes')->filters($request->all())->withCount('notes')->priorityHighFirst()->orderBy('notes_count', 'desc')->paginate(10);

        return new TaskCollection($task);
    }

    /**
     * Store a newly created Tasks
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();
        $task = Task::create($data);
        // upload notes attachments to storage
        foreach ($data['notes'] as $note) {
            // store attachment
            if (isset($note['attachment'])) {
                $attachments = [];
                foreach ($note['attachment'] as $attachment) {
                    $attachments[] = $attachment->store('public/attachments');
                }
                $note['attachment'] = $attachments;
            }
            $task->notes()->create($note);
        }

        return response()->json(['message' => 'Task created successfully.'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\TaskResource
     */
    public function show(Task $task)
    {
        // with notes
        if (request()->has('with_notes')) {
            $task->load('notes');
        }

        return TaskResource::make($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully.'], 200);
    }
}
