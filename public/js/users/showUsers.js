$(function () {
    $('#users').DataTable({
        "ajax": 'datatable/getUsers',
        "columns": [
            {
                data: 'id',
                searchable: false
            },
            {
                data: 'name',
                searchable: false
            },
            {
                data: 'email',
                orderable: false,
            },
            {
                data: 'type',
                orderable: false,
            },
            {
                data: 'phone_number',
                orderable: false
            },
            {
                data: null,
                orderable: false
            }
        ],
        "columnDefs": [
            {
                "targets": -1,
                "data": "id",
                "render": function (data, type, row, meta) {
                    if (data.id != 1) {
                        return `<button type='button' class='btn btn-link' data-bs-toggle='modal'
                        data-bs-target='#deleteModal' data-id='${data.id}' data-name='${data.name}'>
                        <i class="bi bi-person-dash"></i></button>`;
                    } else {
                        return null;
                    }
                }
            },
            {
                "targets": 3,
                "render": function (data, type, row, meta) {
                    return data == 0 ? 'Admin' : 'Normal User';
                }
            }], "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar: _MENU_",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando _END_ registros de _TOTAL_",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
        "pageLength": 10,
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
    });

    //Delete a user's data through a confirmation message
    let deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget;
        let id = button.getAttribute('data-id');
        let name = button.getAttribute('data-name');
        $('#warning').text('Do you want delete the user "' + name + '"?');
        $('#deleteUser').attr('action', 'show-users/delete/' + id);
    });
});
