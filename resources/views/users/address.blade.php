@extends('welcome')
@section('content')
    <button type="button" class='btn btn-link' data-bs-toggle='modal' data-bs-target='#addModal'>Add Address</button>
    <div class="container">
        @isset($address)
            @foreach ($address as $item)
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->address_line1 }}</h5>
                        <p class="card-text">{{ $item->postal_code }}, {{ $item->city }}, {{ $item->state }},
                            {{ $item->country }}
                        </p>
                        <a href="#" class="card-link updateOrder" data-bs-toggle='modal' data-bs-target='#updateModal'
                            data-id={{ $item->id }}>Edit</a>
                        <a href="#" class="card-link deleteOrder" data-bs-toggle='modal' data-bs-target='#deleteModal'
                            data-delete-link={{ route('deleteAddress', $item->id) }}>Delete</a>
                    </div>
                </div>
            @endforeach
        @endisset
    </div>

    {{-- Create Modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Add Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('storeAddress') }}" method="POST">
                        @csrf
                        <div class="mb-3 input-group">
                            <label class="input-group-text col-form-label">Address 1*</label>
                            <input type="text" class="form-control" name="address_1" value="{{ old('address_1') }}">
                        </div>
                        @if ($errors->has('address_1'))
                            <div class="alert alert-danger msg-error">
                                <p class="text-danger fw-bold"> {{ $errors->first('address_1') }}</p>
                            </div>
                        @endif
                        <div class="mb-3 input-group">
                            <label class="input-group-text col-form-label">Address 2</label>
                            <input type="text" class="form-control" name="address_2" value="{{ old('address_2') }}">
                        </div>
                        @if ($errors->has('address_2'))
                            <div class="alert alert-danger msg-error">
                                <p class="text-danger fw-bold"> {{ $errors->first('address_2') }}</p>
                            </div>
                        @endif

                        <div class="mb-3 input-group">
                            <label class="input-group-text col-form-label">City *</label>
                            <input type="text" class="form-control" name="city" value="{{ old('city') }}">
                        </div>
                        @if ($errors->has('city'))
                            <div class="alert alert-danger msg-error">
                                <p class="text-danger fw-bold"> {{ $errors->first('city') }}</p>
                            </div>
                        @endif
                        <div class="mb-3 input-group">
                            <label class="input-group-text col-form-label">State *</label>
                            <input type="text" class="form-control" name="state" value="{{ old('state') }}">
                        </div>
                        @if ($errors->has('state'))
                            <div class="alert alert-danger msg-error">
                                <p class="text-danger fw-bold"> {{ $errors->first('state') }}</p>
                            </div>
                        @endif
                        <div class="mb-3 input-group">
                            <label class="input-group-text col-form-label">Postal Code *</label>
                            <input type="number" class="form-control" name="postal_code" value="{{ old('postal_code') }}">
                        </div>
                        @if ($errors->has('postal_code'))
                            <div class="alert alert-danger msg-error">
                                <p class="text-danger fw-bold"> {{ $errors->first('postal_code') }}</p>
                            </div>
                        @endif
                        <div class="mb-3 input-group">
                            <label class="input-group-text col-form-label">Country *</label>
                            <select class="form-select" name="country">
                                @foreach (config('constants.countries') as $key => $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('country'))
                            <div class="alert alert-danger msg-error">
                                <p class="text-danger fw-bold"> {{ $errors->first('country') }}</p>
                            </div>
                        @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add address</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- Update Modal --}}
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UpdateModalTitle">Edit Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ old('recover') }}" method="POST" id="updateAddress">
                        @csrf
                        <input type="hidden" name="recover" id="recover" value="{{ old('recover') }}">
                        <div class="mb-3 input-group">
                            <label class="input-group-text col-form-label">Address 1*</label>
                            <input type="text" class="form-control" name="address_1_edit" id="address_1"
                                value="{{ old('address_1_edit') }}">
                        </div>
                        @if ($errors->has('address_1_edit'))
                            <div class="alert alert-danger msg-error">
                                <p class="text-danger fw-bold"> {{ $errors->first('address_1_edit') }}</p>
                            </div>
                        @endif
                        <div class="mb-3 input-group">
                            <label class="input-group-text col-form-label">Address 2</label>
                            <input type="text" class="form-control" name="address_2_edit" id="address_2"
                                value="{{ old('address_2_edit') }}">
                        </div>
                        @if ($errors->has('address_2_edit'))
                            <div class="alert alert-danger msg-error">
                                <p class="text-danger fw-bold"> {{ $errors->first('address_2_edit') }}</p>
                            </div>
                        @endif
                        <div class="mb-3 input-group">
                            <label class="input-group-text col-form-label">postal_code *</label>
                            <input type="number" class="form-control" name="postal_code_edit" value="{{ old('postal_code_edit') }}"
                                id="postal_code">
                        </div>
                        @if ($errors->has('postal_code_edit'))
                            <div class="alert alert-danger msg-error">
                                <p class="text-danger fw-bold"> {{ $errors->first('postal_code_edit') }}</p>
                            </div>
                        @endif
                        <div class="mb-3 input-group">
                            <label class="input-group-text col-form-label">City *</label>
                            <input type="text" class="form-control" name="city_edit" id="city"
                                value="{{ old('city_edit') }}">
                        </div>
                        @if ($errors->has('city_edit'))
                            <div class="alert alert-danger msg-error">
                                <p class="text-danger fw-bold"> {{ $errors->first('city_edit') }}</p>
                            </div>
                        @endif
                        <div class="mb-3 input-group">
                            <label class="input-group-text col-form-label">State *</label>
                            <input type="text" class="form-control" name="state_edit" id="state"
                                value="{{ old('state_edit') }}">
                        </div>
                        @if ($errors->has('state_edit'))
                            <div class="alert alert-danger msg-error">
                                <p class="text-danger fw-bold"> {{ $errors->first('state_edit') }}</p>
                            </div>
                        @endif
                        <div class="mb-3 input-group">
                            <label class="input-group-text col-form-label">Country *</label>
                            <select class="form-select" name="country_edit">
                                @foreach (config('constants.countries') as $key => $value)
                                    <option id="{{ $value }}" value="{{ $value }}">
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('country'))
                            <div class="alert alert-danger msg-error">
                                <p class="text-danger fw-bold"> {{ $errors->first('country') }}</p>
                            </div>
                        @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update address</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure that want delete this address?</p>
                </div>
                <div class="modal-footer">
                    <form action="" method="POST" id="deleteAddress">
                        @csrf
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            @if (
                $errors->has('address') ||
                    $errors->has('postal_code') ||
                    $errors->has('city') ||
                    $errors->has('country') ||
                    $errors->has('state'))
                $('#addModal').modal('show');
            @endif

            @if (
                $errors->has('address_edit') ||
                    $errors->has('postal_code_edit') ||
                    $errors->has('city_edit') ||
                    $errors->has('country_edit') ||
                    $errors->has('state_edit'))
                $('#updateModal').modal('show');
            @endif
        }
    </script>
    <script src="{{ asset('js/address/address.js') }}"></script>
@endsection
