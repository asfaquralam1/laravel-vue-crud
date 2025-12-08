<?php

namespace App\Http\Controllers\API;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class TaskAPIController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        return response()->json([
            'status' => true,
            'tasks' => $this->taskService->getAll(),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'nullable'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $task = $this->taskService->create($validator->validated());

        return response()->json([
            'status' => true,
            'message' => 'Task created successfully',
            'task' => $task,
        ], 201);
    }

    public function show($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'status' => false,
                'message' => 'Task not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'task' => $task,
        ]);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'status' => false,
                'message' => 'Task not found.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $task = $this->taskService->update($task, $validator->validated());

        return response()->json([
            'status' => true,
            'message' => 'Task updated successfully',
        ]);
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'status' => false,
                'message' => 'Task not found.'
            ], 404);
        }

        $this->taskService->delete($task);

        return response()->json([
            'status' => true,
            'message' => 'Task deleted successfully',
        ]);
    }
}
