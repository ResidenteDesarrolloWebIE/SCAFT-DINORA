$(document).ready(function () {
    $("#createQuoteProduct").on('hidden.bs.modal', function () {
        location.reload();
    });
    $('#quotation_customer').change(function () {
        $.get("{{ url('contactsbycustomer')}}", { option: $(this).val() }, function (data) {
            $('#slt_quotation_contact').empty();
            $('#slt_quotation_contact').append("<option value>Selecciona un contacto</option>");
            $.each(data, function (key, element) {
                $('#slt_quotation_contact').append("<option value='" + element.id + "'>" + element.name + " </option>");
            });
            $('#btn_mdl_contact').show();
        });
    });
    $("#clientQuoteProduct").change(function () {
        if ($(this).val() != "-1") {
            $("#contactQuoteProduct").prop("disabled", false); 
            $("#optionContactQuoteProduct").html("Selecciona un contacto"); 
        } else {
            $("#contactQuoteProduct").val("-1");
            $("#contactQuoteProduct").prop("disabled", true);
        }
    });
});


function validationExtension() {
    var fileInput = document.getElementById('fileQuotesProduct');
    var filePath = fileInput.value;
    var allowedExtensions = /(.jpg|.jpeg|.png|.pdf|.txt|.gif)$/i;
    if (!allowedExtensions.exec(filePath)) {
        Swal.fire({
            type: 'error',
            title: 'Ops!!!',
            text: 'La extension del archivo no es permitidae!!!',
            preConfirm: () => {
                $('#errorFileQuotesProduct').html("Archivos no permitidos.");
            },
        })
        fileInput.value = '';
        return false;
    } else {
        $('#errorFileQuotesProduct').html("");
    }
}

function save(formulario) {
    $.ajax({
        type: 'post',
        url: 'project/create',
        headers: { 'X-CSRF-TOKEN': $('#token').val() },
        /* data: $("#formulario").serialize(),  */
        data: new FormData(formulario),
        dataType: 'JSON',
        processData: false,
        cache: false,
        success: function (data) {
            Swal.fire({
                type: 'success',
                title: 'En hora buena!!!',
                text: 'La cotizacion se ha creado correctamente!!!',
                preConfirm: () => {
                    location.reload();
                },
            })
        },
        error: function (data) {
            Swal.fire({
                type: 'error',
                title: 'Ops!!!',
                text: 'La cotizacion no se ha podido crear correctamente!!!',
                preConfirm: () => {
                    /* location.reload(); */
                    if (data.responseJSON) {
                        console.log(data.responseJSON.errors)
                        if (data.responseJSON.errors.fileQuotesProduct != 'undefined') {
                            $('#errorFileQuotesProduct').html(data.responseJSON.errors.fileQuotesProduct);
                        }
                    }
                },
            })
        }
    })
}