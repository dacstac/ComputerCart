$(function () {
    // check old after request for create new category and subcategory
    function checkAddCategory() {
        if ($("#dropCategory").val() == "newCategory") {
            $('#hiddenNameCategory').removeClass('d-none');
        } else {
            $('#hiddenNameCategory').addClass('d-none');
        }

        if ($("#dropSubcategory").val() == "newSubcategory") {
            $('#hiddenNameSubcategory').removeClass('d-none');
        } else {
            $('#hiddenNameSubcategory').addClass('d-none');
        }
    }

    // Check if you can create a new category and subcategory
    $("#dropCategory").change(function () {
        $('#dropSubcategory option').each(function () {
            $(this).remove();
        });
        $("#dropSubcategory").append($('<option>', {
            id: "newSubcategory",
            value: "newSubcategory",
            text: "Create new subcategory",
        }));
        if ($('#newCategory').is(':selected')) {
            $('#hiddenNameCategory').removeClass('d-none');
        } else {
            $('#hiddenNameCategory').addClass('d-none');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            $.ajax({
                url: 'dataSubcategory',
                type: 'POST',
                data: {
                    'name': $(this).val(),
                },
                success: function (response) {
                    response.forEach(element => {
                        if (element.subcategory != null) {
                            $("#dropSubcategory").append($('<option>', {
                                value: element.subcategory,
                                text: element.subcategory,
                            }));
                        }
                    });

                }
            });
        }
        checkAddCategory();
    });

    $("#dropSubcategory").change(function () {
        checkAddCategory();
    });

    checkAddCategory();
});