$(function () {
    $('.deleteOrder').on('click', function () {
        $('#deleteAddress').attr('action', $(this).data('delete-link'));
    });

    $('.updateOrder').on('click', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: 'dataAddress',
            type: 'POST',
            data: {
                'id': $(this).data('id'),
            },
            success: function (response) {
                response.forEach(value => {
                    $('#updateAddress').attr('action', 'address/update/' + value.id);
                    $('#recover').val('address/update/' + value.id);
                    $('#address_1').val(value.address_line1);
                    $('#address_2').val(value.address_line2);
                    $('#postal_code').val(value.postal_code);
                    $('#city').val(value.city);
                    $('#state').val(value.state);
                    $('#' + value.country).prop('selected', true);
                });
            }
        });
    });
});