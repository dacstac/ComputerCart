$(function () {
    $('#categories').DataTable({
        "ajax": 'datatable/getCategories',
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
                data: 'subcategory',
                orderable: false,
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
                        return `<button type='button' class='btn btn-link' data-bs-toggle='modal' title='Delete only this'
                        data-bs-target='#updateModal' data-id='${data.id}' data-name='${data.name}' data-sub='${data.subcategory}'>
                        <i class='bi bi-gear'></i></button>
                        <button type='button' class='btn btn-link' data-bs-toggle='modal' title='Delete this category'
                        data-bs-target='#deleteModal' data-id='${data.id}' data-action='category'><i class='bi bi-trash'></i></button>
                        <button type='button' class='btn btn-link' data-bs-toggle='modal' title='Delete this subcategory'
                        data-bs-target='#deleteModal' data-id='${data.id}' data-action='subcategory'><i class='bi bi-trash'></i></button>`;
                    } else {
                        return null;
                    }
                }
            },
        ], "language": {
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
        let action = button.getAttribute('data-action');
        $('#deleteModalLabel').text(action == "category" ? "Delete Category" : "Delete Subcategory");
        $('#warning').text(action == "category" ? "Do you want to delete this category and its subcategories?" : "Do you want to delete this subcategory?")
        $('#deleteCategory').attr('action', 'show-categories/delete/' + id + '/' + action);
    });

    let updateModal = document.getElementById('updateModal');
    updateModal.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget;
        let id = button.getAttribute('data-id');
        let name = button.getAttribute('data-name');
        let sub = button.getAttribute('data-sub');
        $("#category").val(name);
        $("#subcategory").val(sub != "null" ? sub : "");
        $('#recover').val('show-categories/update/' + id);
        $('#updateCategory').attr('action', 'show-categories/update/' + id);
    });
});
