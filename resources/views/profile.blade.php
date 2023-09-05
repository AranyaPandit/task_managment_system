@extends('layout')

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Your Profile</div>

                    <div class="card-body">
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif

                        <div class="text-center">
                            @if(Auth::user()->image)
                                <img src="{{ asset(Auth::user()->image) }}" alt="Profile Image" class="img-thumbnail mb-3">
                            @endif

                            <h2>{{ Auth::user()->name }}</h2>
                            <p class="text-muted">{{ Auth::user()->email }}</p>
                            <p class="text-muted">{{ Auth::user()->phone }}</p>
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Update Your Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
