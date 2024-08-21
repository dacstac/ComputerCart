$(function () {
    function subcategorySelector() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: '/products/edit/' + $('#idProduct').val() + '/subcategorySelector',
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
                            selected: element.id == $('#idCategory').val() ? true : false,
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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    $.ajax({
        url: '/products/edit/' + $('#idProduct').val() + '/searchCategory',
        type: 'POST',
        data: {
            'id': $('#idCategory').val(),
        },
        success: function (response) {
            $('#dropCategory option').each(function () {
                $(this).val() == response.name ? $(this).attr('selected', true) : '';
            });
            subcategorySelector();
        },
    });

    //Delete a image through a confirmation message
    let deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget;
        let id = button.getAttribute('data-id');
        let idProduct = $('#idProduct').val();
        $('#deleteImage').attr('action', '/products/edit/' + idProduct + '/images/destroy/' + id);
    });
});