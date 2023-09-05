<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tasks</title>
        {{-- Fonts --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

        {{-- Bootstrap CSS --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        

        
        <link rel="stylesheet" type="text/css" href="{{ asset('css/taskshow.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/task-details.css') }}">
        </head>
    <body class="antialiased">

        {{-- Navbar --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
            <li class="nav-item">
                    @auth
                        <a class="nav-link" href="{{ route('user-task') }}">Your Task</a>
                    @endauth
                </li>
                <li>
                    @auth
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link">Logout</button>
                        </form>
                    @endauth
                </li>
                <li >
                    @auth   
                    @if(Auth::user()->name)    
                    <a href="{{ route('profile') }}"><img src="{{ asset(Auth::user()->image) }}" class="avatar">{{ Auth::user()->name }}</a>
                   @endif
                    @else
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                        <!-- https://youtu.be/-FfqpB7B1eo?si=KEdr9AlBYf88nwqs -->
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>



        {{-- Body --}}
        <div class="container p-5">
            @yield('main-content')
        </div>


        {{-- Bootstrap JS --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    </body>
</html>




      


