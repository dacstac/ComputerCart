@extends('welcome')
@section('content')
    <div class="container">
        <table class="table table-striped" id="products">
            {{-- <caption></caption> --}}
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Category</th>
                    <th scope="col">Subcategory</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="warning">Do you want this product?</p>
                </div>
                <div class="modal-footer">
                    <form action="" method="POST" id="deleteProduct">
                        @csrf
                        <button type="submit" class="btn btn-primary">Delete</button>
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
                    <h5 class="modal-title" id="UpdateModalTitle">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ old('recover') }}" method="POST" id="updateCategory">
                        @csrf
                        <input type="hidden" name="recover" id="recover" value="{{ old('recover') }}">
                        <div class="mb-3 input-group">
                            <label class="input-group-text col-form-label">Name *</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                id="name">
                        </div>
                        @if ($errors->has('name'))
                            <div class="alert alert-danger msg-error">
                                <p class="text-danger fw-bold"> {{ $errors->first('name') }}</p>
                            </div>
                        @endif
                        <div class="mb-3 input-group">
                            <label class="input-group-text col-form-label">Description *</label>
                            <textarea type="text" class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                        </div>
                        @if ($errors->has('description'))
                            <div class="alert alert-danger msg-error">
                                <p class="text-danger fw-bold"> {{ $errors->first('description') }}</p>
                            </div>
                        @endif
                        <div class="mb-3 input-group">
                            <label class="input-group-text col-form-label">Price *</label>
                            <input type="number" class="form-control" name="price" value="{{ old('price') }}"
                                step=".01" min="0" id="price">
                        </div>
                        @if ($errors->has('price'))
                            <div class="alert alert-danger msg-error">
                                <p class="text-danger fw-bold"> {{ $errors->first('price') }}</p>
                            </div>
                        @endif
                        <div class="mb-3 input-group">
                            <label class="input-group-text col-form-label">Stock *</label>
                            <input type="number" class="form-control" name="stock" value="{{ old('stock') }}"
                                step=".01" min="0" id="stock">
                        </div>
                        @if ($errors->has('stock'))
                            <div class="alert alert-danger msg-error">
                                <p class="text-danger fw-bold"> {{ $errors->first('stock') }}</p>
                            </div>
                        @endif
                        <div class="mb-3 input-group">
                            <label class="input-group-text col-form-label">Category *</label>
                            <select class="form-select" name="category" id="dropCategory">
                                @isset($categories)
                                    @foreach ($categories->unique('name') as $item)
                                        <option value="{{ $item->name }}"
                                            {{ old('category') == $item->name ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        @if ($errors->has('category'))
                            <div class="alert alert-danger msg-error">
                                <p class="text-danger fw-bold"> {{ $errors->first('category') }}</p>
                            </div>
                        @endif
                        <div id="display_subcategory">
                            <div class="mb-3 input-group">
                                <label class="input-group-text col-form-label">Subcategory *</label>
                                <select class="form-select" name="subcategory" id="dropSubcategory">
                                </select>
                            </div>
                            @if ($errors->has('subcategory'))
                                <div class="alert alert-danger msg-error">
                                    <p class="text-danger fw-bold"> {{ $errors->first('subcategory') }}</p>
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
    <script>
        window.onload = function() {
            @if (
                $errors->has('name') ||
                    $errors->has('description') ||
                    $errors->has('price') ||
                    $errors->has('stock') ||
                    $errors->has('category') ||
                    $errors->has('subcategory'))
                $('#updateModal').modal('show');
            @endif
        }
    </script>
    <script src="{{ asset('js/product/index.js') }}"></script>
@endsection
