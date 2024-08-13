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
                return `<button type='button' class='btn btn-link' data-bs-toggle='modal' title='Update this product'
                    data-bs-target='#updateModal' data-id='${data.id}' data-name='${data.name}' data-cat='${data.category_id}'
                    data-desc='${data.description}' data-price='${data.price}' data-stock='${data.stock_quantity}'>
                    <i class='bi bi-gear'></i></button>
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


    //Update the product's data
    function subcategorySelector() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: 'subcategorySelector',
            type: 'POST',
            data: {
                'name': $('#dropCategory').val(),
            },
            success: function (response) {
                if (response[0].subcategory != null) {
                    $('#display_subcategory').hasClass('d-none') ? $('#display_subcategory').removeClass('d-none') : '';
                    response.forEach(element => {
                        $("#dropSubcategory").append($('<option>', {
                            value: element.subcategory,
                            text: element.subcategory,
                        }));
                    });
                } else {
                    $('#display_subcategory').addClass('d-none');
                }
            }
        });
    }

    $("#dropCategory").change(function () {
        $('#dropSubcategory option').each(function () {
            $(this).remove();
        });
        subcategorySelector();
    });

    subcategorySelector();

    let updateModal = document.getElementById('updateModal');
    updateModal.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget;
        let id = button.getAttribute('data-id');
        let name = button.getAttribute('data-name');
        let categoryId = button.getAttribute('data-cat');
        let description = button.getAttribute('data-desc');
        let price = button.getAttribute('data-price');
        let stock = button.getAttribute('data-stock');

        $("#name").val(name);
        $("#description").val(description);
        $("#price").val(price);
        $("#stock").val(stock);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: 'searchCategory',
            type: 'POST',
            data: {
                'id': categoryId,
            },
            success: function (response) {
                $("#dropCategory option").each(function () {
                    $(this).val() == response.name ? $(this).attr('selected', true) : '';
                });
                $("#dropSubcategory option").each(function () {
                    $(this).val() == response.subcategory ? $(this).attr('selected', true) : '';
                });
            }
        });
        $('#recover').val('products/update/' + id);
        $('#updateCategory').attr('action', 'products/update/' + id);
    });
});
