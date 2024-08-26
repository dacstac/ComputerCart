@extends('nav')
@section('content')
    <div class="container">
        <table class="table table-striped" id="categories">
            {{-- <caption></caption> --}}
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
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
                    <h5 class="modal-title" id="deleteModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="warning"></p>
                </div>
                <div class="modal-footer">
                    <form action="" method="POST" id="deleteCategory">
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
                    <h5 class="modal-title" id="UpdateModalTitle">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ old('recover') }}" method="POST" id="updateCategory">
                        @csrf
                        <input type="hidden" name="recover" id="recover" value="{{ old('recover') }}">
                        <div class="mb-3 input-group">
                            <label class="input-group-text col-form-label">Category</label>
                            <input type="text" class="form-control" name="category" id="category"
                                value="{{ old('category') }}">
                        </div>
                        @if ($errors->has('category'))
                            <div class="alert alert-danger msg-error">
                                <p class="text-danger fw-bold"> {{ $errors->first('category') }}</p>
                            </div>
                        @endif
                        <div class="mb-3 input-group">
                            <label class="input-group-text col-form-label">Subcategory</label>
                            <input type="text" class="form-control" name="subcategory" id="subcategory"
                                value="{{ old('subcategory') }}">
                        </div>
                        @if ($errors->has('subcategory'))
                            <div class="alert alert-danger msg-error">
                                <p class="text-danger fw-bold"> {{ $errors->first('subcategory') }}</p>
                            </div>
                        @endif
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update address</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            @if ($errors->has('category') || $errors->has('subcategory'))
                $('#updateModal').modal('show');
            @endif
        }
    </script>
    <script src="{{ asset('js/category/showCategory.js') }}"></script>
@endsection
