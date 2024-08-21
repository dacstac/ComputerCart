@extends('welcome')
@section('content')
    <div class="container">
        <input type="hidden" value="{{ $product->id }}" id="idProduct">
        <input type="hidden" value="{{ $product->category_id }}" id="idCategory">
        <form action="{{ route('updateProducts', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 input-group">
                <label class="input-group-text col-form-label">Name *</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}">
            </div>
            @if ($errors->has('name'))
                <div class="alert alert-danger msg-error">
                    <p class="text-danger fw-bold"> {{ $errors->first('name') }}</p>
                </div>
            @endif
            <div class="mb-3 input-group">
                <label class="input-group-text col-form-label">Description *</label>
                <textarea type="text" class="form-control" name="description">{{ old('description', $product->description) }}</textarea>
            </div>
            @if ($errors->has('description'))
                <div class="alert alert-danger msg-error">
                    <p class="text-danger fw-bold"> {{ $errors->first('description') }}</p>
                </div>
            @endif
            <div class="mb-3 input-group">
                <label class="input-group-text col-form-label">Price *</label>
                <input type="number" class="form-control" name="price" value="{{ old('price', $product->price) }}"
                    step=".01" min="0">
            </div>
            @if ($errors->has('price'))
                <div class="alert alert-danger msg-error">
                    <p class="text-danger fw-bold"> {{ $errors->first('price') }}</p>
                </div>
            @endif
            <div class="mb-3 input-group">
                <label class="input-group-text col-form-label">Stock *</label>
                <input type="number" class="form-control" name="stock"
                    value="{{ old('stock', $product->stock_quantity) }}" step=".01" min="0">
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
                            <option value="{{ $item->name }}" {{ old('category') == $item->name ? 'selected' : '' }}>
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
            <div class="mb-3 input-group">
                <label class="input-group-text col-form-label w-25">Choose Images</label>
                <input type="file" name="images[]" class="form-control" multiple>
            </div>
            @if ($errors->has('images'))
                <div class="alert alert-danger msg-error">
                    <p class="text-danger fw-bold"> {{ $errors->first('images') }}</p>
                </div>
            @endif
            <button type="submit" class="btn btn-primary ">Update Product</button>
        </form>
        <div class="row">
            @foreach ($images as $value)
                <div class="col-sm-4 border">
                    <img src="{{ asset('storage/images/' . $value->image_path) }}" class="img-fluid">
                    <button class="btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-toggle='modal'
                        data-id="{{ $value->id }}"><i class="bi bi-trash-fill"></i></button>
                </div>
            @endforeach
        </div>
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="warning">Do you want this image?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="" method="POST" id="deleteImage">
                            @csrf
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/product/edit.js') }}"></script>
@endsection
