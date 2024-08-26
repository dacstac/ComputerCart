<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ComputerCart</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
</head>

<body class="antialiased">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="row w-100">
                <div class="col-4">
                    <h1><a href="{{ route('home') }}" class="text-decoration-none fw-bold">ComputerCart</a></h1>
                </div>
                <div class="col-4">
                    <form action="{{ route('searchProducts') }}" method="POST">
                        @csrf
                        <div class="mb-3 input-group">
                            <input type="text" id="search" placeholder="search product" name="search"
                                class="form-control" value="{{old('search')}}">
                            <button type="submit" class="btn"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-2 pt-2">
                    @if (auth()->user())
                        <div class="dropdown">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ auth()->user()->name }}
                            </button>
                            <ul class="dropdown-menu">
                                @if (auth()->user()->type_user == 0)
                                    <li><a class="dropdown-item" href="{{ route('indexUsers') }}">Show Users</a></li>
                                    <li><a class="dropdown-item" href="{{ route('createUsers') }}">Create Users</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('indexCategories') }}">Show Category</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('createCategories') }}">Create
                                            Categoty</a></li>
                                    <li><a class="dropdown-item" href="{{ route('indexProducts') }}">Show Products</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('createProducts') }}">Create
                                            Product</a>
                                    </li>
                                    <hr class="dropdown-divider">
                                @endif
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('address') }}">Address</a></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                            </ul>
                        </div>
                    @else
                        <button type="button" class="btn"><a class="link" href="{{ route('startLogin') }}">
                                <i class="bi bi-person-circle"></i>My Count</a></button>
                    @endif
                </div>
            </div>
        </div>
    </nav>
    <hr>
    @yield('content')
</body>

</html>
