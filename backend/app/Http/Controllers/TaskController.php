<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
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

    public function update(Request $request, $id)
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

        $task = $this->taskService->update($id, $validator->validated());

        return response()->json([
            'status' => true,
            'message' => 'Task updated successfully',
            'task' => $task,
        ]);
    }
    
    public function destroy($id)
    {
        $this->taskService->delete($id);

        return response()->json([
            'status' => true,
            'message' => 'Task deleted successfully',
        ]);
    }
}
