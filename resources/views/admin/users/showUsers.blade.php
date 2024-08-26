@extends('nav')
@section('content')
    <div class="container">
        <table class="table table-striped" id="users">
            {{-- <caption></caption> --}}
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Type of User</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="warning"></p>
                </div>
                <div class="modal-footer">
                    <form action="" method="POST" id="deleteUser">
                        @csrf
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="{{ asset('js/users/showUsers.js') }}"></script>
@endsection