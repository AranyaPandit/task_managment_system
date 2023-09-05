@extends('layout')
@section('main-content')
    <div class="container">
        <h2>Edit Profile</h2>
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group"> 
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}" required>
            </div>
          
<div class="form-group">
    <label for="image">Profile Image</label>
    <input type="file" name="image" id="image" class="form-control">
</div>
<div class="form-group">
    <label for="phone">Phone Number</label>
    <input type="text" name="phone" id="phone" class="form-control" value="{{ Auth::user()->phone }}" required>
</div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
@endsection
