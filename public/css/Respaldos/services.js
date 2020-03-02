$(document).ready(function() {
    $("#moreInformationService").on('hidden.bs.modal', function() {
        cleanModalMoreInformation();
    });
    $("#financialAdvanceService").on('hidden.bs.modal', function() {
        cleanModalFinancialAdvance();
    });
    $("#technicalAdvanceService").on('hidden.bs.modal', function() {
        cleanModalTechnicalAdvance();
    });
    $("#imagesGalleryService").on('hidden.bs.modal', function() {
        cleanModalImagesGalery();
    }); 
});


function cleanModalMoreInformation() {
    $('#idFolioService').html("");
    $('#idFolioProjectService').html("");
    $('#idDateService').html("");
    $('#idTotalService').html("")
    $('#idDescriptionService').html("");
    $('#idNotesService').html("");
}
function moreInformationService(id) {
    var ruta = "/services/moreInformation";
    var token = $('#tokenMoreInformationService').val();
    $.ajax({
        url: ruta,
        headers: { 'X-CSRF-TOKEN': token },
        dataType: 'JSON',
        type: 'GET',
        data: { id: id },
        success: function(data) {
            $('#idFolioService').html(data[0].folio);
            $('#idFolioProjectService').html(data[0].project.folio);
            $('#idDateService').html(data[0].created_at);
            $('#idTotalService').html(data[0].ordered_reviews[0].final_amount + " " + data[0].ordered_reviews[0].coin.code)
            $('#idDescriptionService').html(data[0].descripction);
            $('#idNotesService').html(data[0].notes);
        },error: function(data) {
            /* Si falla la peticion Ajax */
        }
    });
}



function cleanModalFinancialAdvance() {
    $('#idFolioServiceEco').html("")
    $('#idServiceEco').val("");
    $('#idTypeServiceEco').html("");
    $('#idDescriptionServiceEco').html("");
    $('#idTotalServiceEco').html("");
    $('#idPaymentsService').html("");

    $('#idPercentageServiceEco').html('0.00 %'); 
    $('#idAdvanceServiceEco').css("width", parseFloat(70).toFixed(2) + "%");
}


function financialAdvanceService(id) {
    var ruta = "/services/financialAdvance";
    var token = $('#idTokenServiceEco').val();
    var type = "Suministro";
    $.ajax({
        url: ruta,
        headers: { 'X-CSRF-TOKEN': token },
        dataType: 'JSON',
        type: 'GET',
        data: { id: id },
        success: function(data) {
            $('#idServiceEco').val(data[0].id);
            $('#idFolioServiceEco').html(data[0].folio);
            $('#idTypeServiceEco').html(type);
            $('#idDescriptionServiceEco').html(data[0].descripction);

            if (data[0].ordered_reviews[0].coin.code == "USD") {
                $('#idTotalServiceEco').html('$ ' + parseFloat((data[0].ordered_reviews[0].final_amount / data[0].ordered_reviews[0].exchage_rate)).toFixed(2) + ' ' + data[0].ordered_reviews[0].coin.code);
            } else if (data[0].ordered_reviews[0].coin.code == "MXN") {
                $('#idTotalServiceEco').html('$ ' + parseFloat(data[0].ordered_reviews[0].final_amount).toFixed(2) + ' ' + data[0].ordered_reviews[0].coin.code);
            }

            $('#idPaymentsService').html("");
            var NumberOfPayments = 1;
            var i = 0;
            var totalPaid = 0;
            console.log(data[0].payments.length != 0);
            if (data[0].payments.length != 0) {
                $(data[0].payments).each(function() {
                    if (data[0].payments[i].cat_coin_id == 1) { /* Peso mexicano   "MXN" */
                        totalPaid += data[0].payments[i].amount * 1;
                        var amountPay = data[0].payments[i].amount;
                        var pay = "MXN";
                        if (data[0].payments[i].exchange == 1) {
                            var type = "N/A";
                        } else {
                            var type = data[0].payments[i].exchange;
                        }
                    } else if (data[0].payments[i].cat_coin_id == 2) { /* Dolar estaunidense "USD" */
                        totalPaid += data[0].payments[i].amount / data[0].payments[i].exchange;
                        var pay = "USD";
                        var amountPay = data[0].payments[i].amount / data[0].payments[i].exchange;
                        var type = data[0].payments[i].exchange;
                    }
                    $('#idAdvanceServiceEco').append(
                        "<tr>" + "<td>" + NumberOfPayments++ + "</td>" +
                        "<td>" + "$" + parseFloat(amountPay).toFixed(2) + ' ' + pay + "</td>" +
                        "<td>" + type + "</td>" +
                        "<td>" + data[0].payments[i].date_amount + "</td>" +
                        "<td>" +
                        "<a data-toggle='modal' data-target='#modalDocuments' onclick=getDocuments('" + data[0].folio + "'," + data[0].payments[i].id + ") >" +
                        "<button type='button' class='btn btn-default' aria-label='Left Align'>" +
                        "<span class='fas fa-cloud-download-alt' aria-hidden='true'></span>" +
                        "</button>" + "</a>" + "</td>" + "</tr>");
                    i++;
                });
            } else {
                console.log("No hay pagos");
                totalPaid = 0;
                Mensaje = 'No hay datos de pagos';
                $('#idPaymentsService').append("<tr><td colspan='5' class='text-center'>" + Mensaje + "</td></tr>");
            }


            var liquidate = 0;
            if (data[0].ordered_reviews[0].coin.code == "MXN") {
                var totalToPay = data[0].ordered_reviews[0].final_amount;
            } else if (data[0].ordered_reviews[0].coin.code == "USD") {
                var totalToPay = (data[0].ordered_reviews[0].final_amount / data[0].ordered_reviews[0].exchage_rate);
            } else {
                alert("fff");
            }

            liquidate = totalToPay /* total a pagar */ - totalPaid /* total pagado */ ;

            var paymentPercentage = (totalPaid * 100) / totalToPay;
            if (paymentPercentage > 0) {
                $('#idPercentageSupply').html(parseFloat(paymentPercentage).toFixed(2) + ' %');
                $('#idAdvanceServiceEco').css("width", parseFloat(paymentPercentage).toFixed(2) + "%");
            }
        },
        error: function(data) {
            alert("No se encontro revisiones");
        }
    });
}





function cleanModalTechnicalAdvance() {
    $('.progress2 .circle .active').removeClass().addClass('circle');
    $('.progress2 .circle .done').removeClass().addClass('circle');
    $('.progress2 .circle').removeClass().addClass('circle');
    $('.progress2 .bar .active').removeClass().addClass('bar');
    $('.progress2 .bar .done').removeClass().addClass('bar');
    $('.progress2 .bar').removeClass().addClass('bar');
    $('.progress2 .globo').removeAttr('style');
    $('.progress2 .bar').removeAttr('style');

    $('#idServiceTec').val(""); 
    $('#idFolioServiceTec').html(""); 
    $('#idTypeServiceTec').html(""); 
    $('#idDescriptionTec').html(""); 

    $('#idStage0ServiceTec').html(""); 
    $('#idStage1ServiceTec').html("");
    $('#idStage2ServiceTec').html("");
    $('#idStage3ServiceTec').html();
    $('#idStage4ServiceTec').html("");
    $('#idStage5ServiceTec').html("");

    $('#idDateStage2ServiceTec').html("");
    $('#idDateStage3ServiceTec').html("");
    $('#idDateStage4ServiceTec').html("");
    $('#idDateStage5ServiceTec').html("");

    $('#idProgressServiceTec').css("width", parseFloat(10).toFixed(2) + "%");
    $('#idProgressServiceTec').removeClass().addClass('progress-bar');
    $('#idAdvanceServiceTec').html('0.00 %');
}


function graphicSum(progress) {
    console.log("Dato:   ->   ", progress)
        //Cálculo de los porcentajes de las distintas etapas
    var i = 1;
    if (progress.etapa1 > 0 && progress.etapa1 < 100) {
        var j = 2;
        var p = progress.etapa1;
    } else if (progress.etapa1 == 100) {
        var j = 3;
        var p = 0;
        if (progress.etapa2 > 0 && progress.etapa2 < 100) {
            var j = 3;
            var p = progress.etapa2;
        } else if (progress.etapa2 == 100) {
            var j = 4;
            var p = 0;
            if (progress.etapa3 > 0 && progress.etapa3 < 100) {
                var j = 4;
                var p = progress.etapa3;
            } else if (progress.etapa3 == 100) {
                var j = 5;
                var p = 0;
                if (progress.etapa4 > 0 && progress.etapa4 < 100) {
                    var j = 5;
                    var p = progress.etapa4;
                } else if (progress.etapa4 == 100) {
                    var j = 6;
                    var p = 0;
                    if (progress.etapa5 > 0 && progress.etapa5 < 100) {
                        var j = 6;
                        var p = progress.etapa5;
                    } else if (progress.etapa5 == 100) {
                        var j = 7;
                        var p = 0;
                        if (progress.etapa6 > 0 && progress.etapa6 < 100) {
                            var j = 7;
                            var p = progress.etapa6;
                        } else if (progress.etapa6 == 100) {
                            var j = 8;
                            var p = 0;
                        }
                    }
                }
            }
        }

    } else {
        var j = 1;
    }
    setInterval(function() {
        if (i < j) {
            $('.progress2 .circle:nth-of-type(' + i + ')').addClass('active');
            $('.progress2 .circle:nth-of-type(' + (i - 1) + ')').removeClass('active').addClass('done');
            $('.progress2 .bar:nth-of-type(' + (i - 1) + ')').addClass('active');
            $('.progress2 .bar:nth-of-type(' + (i - 2) + ')').addClass('done').removeClass('active');
        }
        if (i == j - 1) {
            $('.progress2 .circle:nth-of-type(' + (i - 1) + ') .label-icon p').css('opacity', '1');
            $('.progress2 .circle:nth-of-type(' + (i - 1) + ') .label-icon p').css('visibility', 'visible');
            $('.progress2 .circle:nth-of-type(' + (i) + ') .label-icon p').css('opacity', '1');
            $('.progress2 .circle:nth-of-type(' + (i) + ') .label-icon p').css('visibility', 'visible');
            $('.progress2 .bar:nth-of-type(' + (i - 1) + ')').css('background', 'linear-gradient(to right, #81CE97 ' + p + '%, #FFF ' + (p + 20) + '%');
            if (progress.etapa6 < 100 || progress.etapa5 < 100 || progress.etapa4 < 100 || progress.etapa3 < 100) {
                $('.progress2 .circle:nth-of-type(' + (i) + ')').attr('data-toggle', 'modal');
                $('.progress2 .circle:nth-of-type(' + (i) + ')').attr('data-target', '#percentageModal');
                $('.progress2 .circle:nth-of-type(' + (i) + ')').attr('onclick', 'percentageSum(' + progress.idperc + ')');
            }
        }
        i++;
        if (i == 0) {
            $('.progress2 .bar').removeClass().addClass('bar');
            $('.progress2 div.circle').removeClass().addClass('circle');
            i = 1;
        }
    }, 0); /* 1000 */
    return;
}

function technicalAdvanceService(id) {
    var ruta = "/services/technicalAdvance";
    var type = "Servicio";
    var token = $('#idTokenServiceTec').val();

    $.ajax({
        url: ruta,
        headers: { 'X-CSRF-TOKEN': token },
        dataType: 'JSON',
        type: 'GET',
        data: { id: id },
        success: function(data) {
            console.log(data[0]);
            $('#idServiceTec').val(data[0].id);
            $('#idFolioServiceTec').html(data[0].folio);
            $('#idTypeServiceTec').html(type);
            $('#idDescriptionServiceTec').html(data[0].descripction);

            if (data[0].code == "USD") {
                $('#idTotalServiceTec').html('$ ' + parseFloat((data[0].ordered_reviews[0].final_amount / data[0].ordered_reviews[0].exchage_rate)).toFixed(2) + ' ' + data[0].ordered_reviews[0].coin.code);
            } else {
                $('#idTotalServiceTec').html('$ ' + parseFloat(data[0].ordered_reviews[0].final_amount).toFixed(2) + ' ' + data[0].ordered_reviews[0].coin.code);
            }


            //percentages
            $('#idStage0ServiceTec').html(data[0].progress.etapa1 + "%");
            $('#idStage1ServiceTec').html(data[0].progress.etapa2 + "%");
            $('#idStage2ServiceTec').html(data[0].progress.etapa3 + "%");
            $('#idStage3ServiceTec').html(data[0].progress.etapa4 + "%");
            $('#idStage4ServiceTec').html(data[0].progress.etapa5 + "%");

            //percentages dates
            $('#idDateStage2ServiceTec').html(data[0].progress.date_etapa3);
            $('#idDateStage3ServiceTec').html(data[0].date_etapa4);
            $('#idDateStage4ServiceTec').html(data[0].progress.date_etapa5);

            //graphic
            graphicSum(data[0].progress);
            var generalAdvance = 0;
            generalAdvance = (parseFloat(data[0].progress.etapa1) + parseFloat(data[0].progress.etapa2) + parseFloat(data[0].progress.etapa3) +
                parseFloat(data[0].progress.etapa4) + parseFloat(data[0].progress.etapa5) + parseFloat(data[0].progress.etapa6)) / 6;

            $('#idProgressServiceTec').html(parseFloat(generalAdvance).toFixed(2) + ' %');
            $('#idProgressServiceTec').css("width", parseFloat(generalAdvance).toFixed(2) + "%");

            if (generalAdvance >= 0 && generalAdvance <= 49) {
                $('#idProgressServiceTec').removeClass("progress-bar bg-success");
                $('#idProgressServiceTec').removeClass("progress-bar bg-warning");
                $('#idProgressServiceTec').addClass("progress-bar bg-danger");
            } else if (generalAdvance >= 50 && generalAdvance < 95) {
                $('#idProgressServiceTec').removeClass("progress-bar bg-danger");
                $('#idProgressServiceTec').removeClass("progress-bar bg-success");
                $('#idProgressServiceTec').addClass("progress-bar bg-warning");
            } else if (generalAdvance >= 95 && generalAdvance <= 100) {
                $('#idProgressServiceTec').removeClass("progress-bar bg-danger");
                $('#idProgressServiceTec').removeClass("progress-bar bg-warning");
                $('#idProgressServiceTec').addClass("progress-bar bg-success");
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}


function cleanModalImagesGalery() {
    $('#idFolioServiceGal').html("");
    $('#images').html("");
}
function imagesGalleryService(id, folioService) {
    var ruta = "/services/imagesGallery"; /* {{URL('moreInformation')}} */
    var token = $('#idTokenGalleryService').val();
    $.ajax({
        url: ruta,
        headers: { 'X-CSRF-TOKEN': token },
        dataType: 'JSON',
        type: 'GET',
        data: { id: id },
        success: function(data) {
            console.log(data.images)
            $('#idFolioServiceGal').html(folioService);
            var i = 0;
            $(data.images).each(function() {
                console.log();
                $('#images').append(
                    /* '<a href="storage/imagesProjects/' + data.images[i].name + '"><img  src="storage/imagesProjects/' + data.images[i].name + '" width="120" height="96"></a>' */
                    '<img  src="storage/imagesProjects/' + data.images[i].name + '" width="120" height="96">'
                );
                i++;
            });
        },
        error: function(data) {
            /* Si falla la peticion Ajax */
        }
    });
}
