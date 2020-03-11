$(document).ready(function () {
    $("#loadImages").on('hidden.bs.modal', function () {
        $('#dropzonePreview').html("");
    });
});

function imagesProject(project) {
    console.log(project);
    $('#idFolioProject').html(project.folio);
    $('#idProject').val(project.id);
    $('#folioProject').val(project.folio);

    if (project.product != null) {
        $('#folioOffer').val(project.product.folio)
        $('#typeProject').val("Suministro");
    } else {
        $('#folioOffer').val(project.service.folio)
        $('#typeProject').val("Servicio");
    }
    var objDZ = Dropzone.forElement("#real-dropzone");
    objDZ.emit("initFiles");
}


var photo_counter = 0;
Dropzone.options.realDropzone = {
    uploadMultiple: false,
    parallelUploads: 100,
    maxFilesize: 100,
    previewsContainer: '#dropzonePreview',
    previewTemplate: document.querySelector('#preview-template').innerHTML,
    addRemoveLinks: true,
    dictRemoveFile: 'Eliminar',
    dictFileTooBig: 'La imagen es más grande que 100 MB',
    dictRemoveFileConfirmation: "¿Estas seguro de eliminar esta imagen?",

    // The setting up of the dropzone
    init: function () {
        var myDropzone = this;
        // Add server images
        this.on("initFiles", function (file) {
            $.get('/server-images?id=' + $('#idProject').val(), function (data) {
                console.log(data);
                $.each(data.images, function (key, value) {
                    console.log("archivo:  ", value.server);
                    var file = { name: value.original, size: value.size };
                    myDropzone.options.addedfile.call(myDropzone, file);
                    myDropzone.createThumbnailFromUrl(file, value.server);
                    myDropzone.emit("complete", file);
                    $('.serverfilename', file.previewElement).val(value.server);
                    photo_counter++;
                    $("#photoCounter").text("(" + photo_counter + ")");
                });
            });
        });
        this.on("removedfile", function (file) {
            console.log(file.name);
            console.log($('.serverfilename', file.previewElement).val())
            var folioProject = $('#folioProject').val()
            var typeProject = $('#typeProject').val()
            var folioOffer = $('#folioOffer').val()
            $.ajax({
                type: 'POST',
                url: 'upload/delete',
                data: { id: file.name, folioOffer: folioOffer, folioproject: folioProject, typeProject: typeProject, _token: $('#csrf-token').val() },
                /* $('.serverfilename', file.previewElement).val() */
                dataType: 'html',
                success: function (data) {
                    console.log(data);
                    var rep = JSON.parse(data);
                    if (rep.code == 200) {
                        photo_counter--;
                        $("#photoCounter").text("(" + photo_counter + ")");
                    }
                }
            });
        });
        this.on("resetFiles", function (file) {
            console.log(myDropzone.getAcceptedFiles());
            $.each(myDropzone.getAcceptedFiles(), function (key, value) {
                console.log(value.previewElement);
                $('.serverfilename', value.previewElement).val("");
            });
            /* this.removeAllFiles(true); */
        });

        /* this.on('complete', function(file) {
            this.removeAllFiles(true);
        }); */
        /* this.on('success', function(file, json) {
        }); */
    },
    error: function (file, response) {
        if ($.type(response) === "string")
            var message = response; //dropzone sends it's own error messages in string
        else
            var message = response.message;
        file.previewElement.classList.add("dz-error");
        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
        _results = [];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i];
            _results.push(node.textContent = message);
        }
        return _results;
    },
    success: function (file, response) {
        $('.serverfilename', file.previewElement).val(response.filename);
    }
}


function statusProject(project) {
    $('#folio').html(project.folio);
    $('#status').val(project.status);
    $('#project').val(project.id);
}

function changeStatus() {
    ruta = "project/changeStatus";
    token = $('#token').val();
    status = $('#status').val();
    project = $('#project').val();
    $.ajax({
        url: ruta,
        headers: { 'X-CSRF-TOKEN': token },
        dataType: 'JSON',
        type: 'POST',
        data: { id: project, status: status },
        success: function (data) {
            console.log(data)
            $('#changeStatus').hide();
            $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
            $('.modal-backdrop').remove();
            Swal.fire({
                type: 'success',
                title: 'Correcto!!!',
                text: 'El status se ha ha cambiado correctamente!!!',
                preConfirm: () => {
                    location.reload();
                },
            })
        },
        error: function (data) {
            Swal.fire({
                type: 'error',
                title: 'Ops..',
                text: 'El status no se ha cambiado!!!',
            })
        }
    });
}