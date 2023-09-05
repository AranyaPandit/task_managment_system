
@extends('layout')

@section('main-content')
    <div class="container">
        <h1>Task Details</h1>
        <p><strong>Title:</strong> {{ $task->title }}</p>
         <div class="float-start">
                @if ($task->status == 0)
                <span class="badge rounded-pill bg-info text-dark">
                    Todo
                </span>
                @elseif ($task->status == 1)
                <span class="badge rounded-pill bg-success text-white">
                    Pending
                </span>
                @else
                <span class="badge rounded-pill bg-success text-white">
                    Done
                </span>
                @endif
                <p><strong>Description:</strong> {{ $task->description }}</p>

            </div><br><br><br><br>
        <p><strong>Start date:</strong> {{ $task->start_date }}</p> 
        <p><strong>End date:</strong> {{ $task->end_date }}</p>
@php
$images = $task->images;

$images = explode(',', $images);
@endphp

@foreach($images as $img)
<img src="{{asset($img)}}"></img>
@endforeach

       
        <p><strong>URL of the site:</strong> {{ $task->url }}</p>
        <!-- <div class="float-end">
                <a href="{{ route('task.edit', $task->id) }}" class="btn btn-success">
                    <i class="fa fa-edit"></i>
                </a>
            </div> -->

    </div>
@endsection
