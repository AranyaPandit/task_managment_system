@extends('admin.layout')
@section('content')
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
        <th colspan="6" class="text-center"><h2>Our Employees List</h2></th>
    </tr>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->role }}</td>
                <td><img src="{{ asset($user->image) }}" alt="Profile Image" class="rounded-circle img-thumbnail"></td>
                <td><a href="{{ route('edit',['id' => $user->id]) }}" class="btn btn-primary">Update Your Profile</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endsection