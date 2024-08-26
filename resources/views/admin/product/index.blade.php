@extends('nav')
@section('content')
    <div class="container">
        <table class="table table-striped" id="products" data-route="{{ route('editImages', ['id' => '0']) }}">
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
