@extends('nav')
@section('content')
    <div class="container">
        <form action="{{ route('storeProducts') }}" method="POST" enctype="multipart/form-data">
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
                <label class="input-group-text col-form-label">Description *</label>
                <textarea type="text" class="form-control" name="description">{{ old('description') }}</textarea>
            </div>
            @if ($errors->has('description'))
                <div class="alert alert-danger msg-error">
                    <p class="text-danger fw-bold"> {{ $errors->first('description') }}</p>
                </div>
            @endif
            <div class="mb-3 input-group">
                <label class="input-group-text col-form-label">Price *</label>
                <input type="number" class="form-control" name="price" value="{{ old('price') }}" step=".01"
                    min="0">
            </div>
            @if ($errors->has('price'))
                <div class="alert alert-danger msg-error">
                    <p class="text-danger fw-bold"> {{ $errors->first('price') }}</p>
                </div>
            @endif
            <div class="mb-3 input-group">
                <label class="input-group-text col-form-label">Stock *</label>
                <input type="number" class="form-control" name="stock" value="{{ old('stock') }}" step=".01"
                    min="0">
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
                @dd('error en imagenes')
                <div class="alert alert-danger msg-error">
                    <p class="text-danger fw-bold"> {{ $errors->first('images') }}</p>
                </div>
            @endif
            <button type="submit" class="btn btn-primary ">Create Product</button>
        </form>
    </div>
    <script src="{{ asset('js/product/create.js') }}"></script>
@endsection
