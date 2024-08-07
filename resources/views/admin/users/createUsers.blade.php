@extends('welcome')
@section('content')
    <div class="container">
        <form action="{{ route('storeUsers') }}" method="POST">
            @csrf
            <div class="mb-3 input-group">
                <label class="input-group-text col-form-label">Name *</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>
            @if ($errors->has('name'))
                <div class="alert alert-danger msg-error">
                    <p class="text-danger fw-bold"> {{ $errors->first('name') }}</p>
                </div>
            @endif
            <div class="mb-3 input-group">
                <label class="input-group-text col-form-label">Email *</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
            </div>
            @if ($errors->has('email'))
                <div class="alert alert-danger">
                    <p class="text-danger fw-bold"> {{ $errors->first('email') }}</p>
                </div>
            @endif
            <div class="mb-3 input-group">
                <label class="input-group-text col-form-label">Password *</label>
                <input type="password" class="form-control" name="password" value="{{ old('password') }}">
            </div>
            @if ($errors->has('password'))
                <div class="alert alert-danger msg-error">
                    <p class="text-danger fw-bold"> {{ $errors->first('password') }}</p>
                </div>
            @endif
            <div class="mb-3 input-group">
                <label class="input-group-text col-form-label">Phone *</label>
                <input type="tel" class="form-control" name="phone" value="{{ old('phone') }}">
            </div>
            @if ($errors->has('phone'))
                <div class="alert alert-danger msg-error">
                    <p class="text-danger fw-bold"> {{ $errors->first('phone') }}</p>
                </div>
            @endif
            <div class="mb-3 input-group">
                <label class="input-group-text col-form-label">Type of user *</label>
                <select class="form-select" name="type">
                    <option {{ old('type') == null ? 'selected' : '' }} disabled>Select type of user</option>
                    <option value="0" @if (old('type') == 0) selected @endif>Admin</option>
                    <option value="1" @if (old('type') == 1) selected @endif>Normal User</option>
                </select>
            </div>
            @if ($errors->has('type'))
                <div class="alert alert-danger msg-error">
                    <p class="text-danger fw-bold"> {{ $errors->first('type') }}</p>
                </div>
            @endif
            <button type="submit" class="btn btn-primary ">Create User</button>
        </form>
    </div>
@endsection
