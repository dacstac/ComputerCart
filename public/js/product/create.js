$(function () {
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
});
