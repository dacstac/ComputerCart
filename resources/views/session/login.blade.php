<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ComputerCart</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body class="antialiased">
    <div class="row">
        <div class="col-sm-6">
            <div class="container-fluid mt-5">

                <div class="card col-10 col-md-8 col-sm-10 col-xl-6 col-lg-7 col-xxl-5 text-center card-css mx-auto">
                    <div class="card-header">
                        <h2> {{ __('Login') }} </h2>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="text" name="email" value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" name="password" value="{{ old('password') }}"
                                        class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <input id="hidden" type="hidden" name="credentials"
                                    class="form-control @error('credentials') is-invalid @enderror">
                                @error('credentials')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-flex flex-row justify-content-between">
                                <div class="col-8 m-auto">
                                    <button type="submit" class="btn btn-primary float-start">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="container-fluid mt-5">
                <div class="card col-10 col-md-8 col-sm-10 col-xl-6 col-lg-7 col-xxl-5 text-center card-css mx-auto">
                    <div class="card-header">
                        <h2> {{ __('Create Account') }} </h2>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('createAccount') }}">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Name') }} *</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Password') }} *</label>

                                <div class="col-md-6">
                                    <input id="pass" type="password" name="pass" value="{{ old('pass') }}"
                                        class="form-control @error('pass') is-invalid @enderror">

                                    @error('pass')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Email') }} *</label>

                                <div class="col-md-6">
                                    <input id="email_create" type="email" name="email_create"
                                        value="{{ old('email_create') }}"
                                        class="form-control @error('email_create') is-invalid @enderror">

                                    @error('email_create')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Phone') }} *</label>

                                <div class="col-md-6">
                                    <input id="phone" type="tel" name="phone" value="{{ old('phone') }}"
                                        class="form-control @error('phone') is-invalid @enderror">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex flex-row justify-content-between">
                                <div class="col-8 m-auto">
                                    <button type="submit" class="btn btn-primary float-start">
                                        {{ __('Create account') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
