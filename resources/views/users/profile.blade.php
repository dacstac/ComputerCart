@extends('nav')
@section('content')
    <div class="container">
        <form action="{{ route('updatedataUser') }}" method="POST">
            @csrf
            <div class="mb-3 input-group">
                <label class="input-group-text col-form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}">
            </div>
            @if ($errors->has('email'))
                <div class="alert alert-danger msg-error">
                    <p class="text-danger fw-bold"> {{ $errors->first('email') }}</p>
                </div>
            @endif
            <div class="mb-3 input-group">
                <label class="input-group-text col-form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">
            </div>
            @if ($errors->has('name'))
                <div class="alert alert-danger msg-error">
                    <p class="text-danger fw-bold"> {{ $errors->first('name') }}</p>
                </div>
            @endif
            <div class="mb-3 input-group">
                <label class="input-group-text col-form-label">Phone</label>
                <input type="tel" class="form-control" name="phone" value="{{ old('phone', $user->phone_number) }}">
            </div>
            @if ($errors->has('phone'))
                <div class="alert alert-danger msg-error">
                    <p class="text-danger fw-bold"> {{ $errors->first('phone') }}</p>
                </div>
            @endif
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
