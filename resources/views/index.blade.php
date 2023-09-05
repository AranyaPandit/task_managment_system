@extends('layout')

@section('main-content')
<div>
    <div class="float-start">
        <h4 class="pb-3">My Tasks</h4>
    </div>

    <div class="float-end">
        <a href="{{ route('task.create') }}" class="btn btn-info">
            <i class="fa fa-plus-circle"></i> Create Task
        </a>
    </div>
</div>

<form action="{{ route('user-task') }}" method="GET">
    <label for="status">Check the tasks:</label>
    <select name="status" id="status">
        <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Tasks</option>
        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Todo</option>
        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Pending</option>
        <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Done</option>
    </select>
    <button type="submit">Filter</button>
</form>

@foreach ($tasks as $task)
<div class="card mt-3">
    <h5 class="card-header">
        @if ($task->status === 0 || $task->status === 1)
        <a href="{{ route('task-details', ['id' => $task->id]) }}">
        {{ $task->title }}
        </a>
        @else
        <del>{{ $task->title }}</del>
        @endif

        <span class="badge rounded-pill bg-warning text-dark">
            {{ $task->created_at->diffForHumans() }}
        </span>
    </h5>
    <div class="card-body">
        <div class="card-text">
            <div class="float-start">
                @if ($task->status === 0)
                <span class="badge rounded-pill bg-info text-dark">
                    Todo
                </span>
                @elseif ($task->status === 1)
                <span class="badge rounded-pill bg-success text-white">
                    Pending
                </span>
                @else
                <span class="badge rounded-pill bg-success text-white">
                    Done
                </span>
                @endif
                {{ $task->description }}
                <small>Last Updated - {{ $task->updated_at->diffForHumans() }} </small>
            </div>
            <div class="float-end">
                <a href="{{ route('task.edit', $task->id) }}" class="btn btn-success">
                    <i class="fa fa-edit"></i>
                </a>

                <!-- <form action="{{ route('task.destroy', $task->id) }}" style="display: inline" method="POST" onsubmit="return confirm('Are you sure to delete ?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                </form> -->
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
@endforeach

@if (count($tasks) === 0)
<div class="alert alert-danger p-2">
    No Task Found. Please Create one task
    <br>
    <br>
    <a href="{{ route('task.create') }}" class="btn btn-info">
        <i class="fa fa-plus-circle"></i> Create Task
    </a>
</div>
@endif

@endsection
