<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function getAll()
    {
        return Task::all();
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update(Task $task, array $data)
    {
        $task->update($data);
        return $task;
    }

    public function delete(Task $task)
    {
        return $task->delete();
    }
}
