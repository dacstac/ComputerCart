@extends('welcome')
@section('content')
    <div class="container">
        <form action="{{ route('storeCategories') }}" method="POST">
            @csrf
            <div class="mb-3 input-group">
                <label class="input-group-text col-form-label">Category *</label>
                <select class="form-select" name="category" id="dropCategory">
                    <option id="newCategory" value="newCategory">Create new category</option>
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
            <div id="hiddenNameCategory" class="d-none">
                <div class="mb-3 input-group">
                    <label class="input-group-text col-form-label">Name for category *</label>
                    <input type="text" class="form-control" name="name_category" value="{{ old('name_category') }}">
                </div>
                @if ($errors->has('name_category'))
                    <div class="alert alert-danger msg-error">
                        <p class="text-danger fw-bold"> {{ $errors->first('name_category') }}</p>
                    </div>
                @endif
            </div>
            <div class="mb-3 input-group">
                <label class="input-group-text col-form-label">Subcategory *</label>
                <select class="form-select" name="subcategory" id="dropSubcategory">
                    <option id="newSubcategory" value="newSubcategory">Create new subcategory</option>
                </select>
            </div>
            @if ($errors->has('subcategory'))
                <div class="alert alert-danger msg-error">
                    <p class="text-danger fw-bold"> {{ $errors->first('subcategory') }}</p>
                </div>
            @endif
            <div id="hiddenNameSubcategory" class="d-none">
                <div class="mb-3 input-group">
                    <label class="input-group-text col-form-label">Name for subcategory *</label>
                    <input type="text" class="form-control" name="name_subcategory"
                        value="{{ old('name_subcategory') }}">
                </div>
                @if ($errors->has('name_subcategory'))
                    <div class="alert alert-danger">
                        <p class="text-danger fw-bold"> {{ $errors->first('name_subcategory') }}</p>
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary ">Create Category</button>
        </form>
    </div>
    <script src="{{ asset('js/category/createCategory.js') }}"></script>
@endsection
