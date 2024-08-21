$(function () {
    $('#products').DataTable({
        "ajax": 'datatable/getProducts',
        "columns": [{
            data: 'id',
            searchable: false
        }, {
            data: 'name',
            searchable: false
        }, {
            data: 'description',
            orderable: false,
        }, {
            data: 'price',
            orderable: false,
        }, {
            data: 'stock_quantity',
            orderable: false,
        }, {
            data: 'catName',
            orderable: false,
        }, {
            data: 'subcat',
            orderable: false,
        }, {
            data: null,
            orderable: false
        }],
        "columnDefs": [{
            "targets": -1,
            "data": "id",
            "render": function (data, type, row, meta) {
                return `<button type='button' class='btn btn-link'title='Update this product'>
                    <a href='products/edit/${data.id}'><i class='bi bi-gear'></i></a></button>
                    <button type='button' class='btn btn-link' data-bs-toggle='modal' title='Delete this product'
                    data-bs-target='#deleteModal' data-id='${data.id}'><i class='bi bi-trash'></i></button>`
            }
        },],
        "language": {
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

    //Delete a product's data through a confirmation message
    let deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget;
        let id = button.getAttribute('data-id');
        $('#deleteProduct').attr('action', 'products/destroy/' + id);
    });
});
