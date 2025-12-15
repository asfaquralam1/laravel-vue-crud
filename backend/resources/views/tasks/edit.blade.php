@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Task</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                            @csrf
                            <div class="form group">
                                <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
                                @error($task->title)
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form group mt-3">
                                <textarea name="description" class="form-control" rows="4" required>{{ $task->description }}</textarea>
                                @error($task->description)
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button class="btn btn-success mt-3" type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection