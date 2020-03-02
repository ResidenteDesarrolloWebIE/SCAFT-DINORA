$(document).ready(function() {
    $("#moreInformation").on('hidden.bs.modal', function() {
        cleanModalMoreInformation();
    });
    $("#financialAdvance").on('hidden.bs.modal', function() {
        cleanModalFinancialAdvance();
    });
    $("#technicalAdvanceService").on('hidden.bs.modal', function() {
        cleanModalTechnicalAdvanceService();
    });
    $("#technicalAdvanceSupply").on('hidden.bs.modal', function() {
        cleanModalTechnicalAdvanceSupply();
    });
    $("#imagesGallery").on('hidden.bs.modal', function() {
        cleanModalImagesGalery();
    }); 
});



function cleanModalMoreInformation() {
    $('#idFolio').html("");
    $('#idFolioAux').html("");
    $('#idFolioProject').html("");
    $('#idDate').html("");
    $('#idTotal').html("")
    $('#idDescription').html("");
    $('#idNotes').html("");
}
function moreInformation (id, button) {
        if(button == "btnInfoSupply"){
        var ruta = "/supplies/moreInformation";
        var type = "Suministro";
    }else if(button == "btnInfoService"){ 
        var ruta = "/services/moreInformation";
        var type = "Servicio";
    }
    var token = $('#tokenMoreInformation').val();
    $.ajax({
        url: ruta,
        headers: { 'X-CSRF-TOKEN': token },
        dataType: 'JSON',
        type: 'GET',
        data: { id: id },
        success: function(data) {
            console.log(data[0])
            $('#idFolio').html(data[0].folio);
            $('#idLabelFolio').html("Folio del "+type+":");
            $('#idFolioAux').html(data[0].folio);
            $('#idFolioProject').html(data[0].project.folio);
            $('#idDate').html(data[0].created_at);
            $('#idTotal').html(data[0].ordered_reviews[0].final_amount + " " + data[0].ordered_reviews[0].coin.code)
            $('#idDescription').html(data[0].description);
            $('#idNotes').html(data[0].notes);
        },
        error: function(data) {/* Si falla la peticion Ajax */}
    });
}



function cleanModalFinancialAdvance() {
    $('#idFolioEconomic').html("")
    $('#idEconomic').val("");
    $('#idTypeEconomic').html("");
    $('#idDescriptionEconomic').html("");
    $('#idTotalEconomic').html("");
    $('#idPayments').html("");

    $('#idPercentageEconomic').html('0.00 %'); 
    $('#idAdvanceEconomic').css("width", parseFloat(5).toFixed(2) + "%");  
}
function financialAdvance(id,button) {
    if(button == "btnEconomicSupply"){
        var ruta = "/supplies/financialAdvance";
        var type = "Suministro";
    }else if(button == "btnEconomicService"){ 
        var ruta = "/services/financialAdvance";
        var type = "Servicio";
    }
    var token = $('#idTokenEconomic').val();

    $.ajax({
        url: ruta,
        headers: { 'X-CSRF-TOKEN': token },
        dataType: 'JSON',
        type: 'GET',
        data: { id: id },
        success: function(data) {
            $('#idEconomic').val(data[0].id);
            $('#idFolioEconomic').html(data[0].folio);
            $('#idTypeEconomic').html(type);
            $('#idDescriptionEconomic').html(data[0].description);
            console.log(data[0]);
            if (data[0].ordered_reviews[0].coin.code == "USD") {
                $('#idTotalEconomic').html('$ ' + parseFloat((data[0].ordered_reviews[0].final_amount / data[0].ordered_reviews[0].exchange_rate)).toFixed(2) + ' ' + data[0].ordered_reviews[0].coin.code);
            } else if (data[0].ordered_reviews[0].coin.code == "MXN") {
                $('#idTotalEconomic').html('$ ' + parseFloat(data[0].ordered_reviews[0].final_amount).toFixed(2) + ' ' + data[0].ordered_reviews[0].coin.code);
            }

            $('#idPayments').html("");
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
                    $('#idPayments').append(
                        "<tr>" + "<td>" + NumberOfPayments++ + "</td>" +
                        "<td>" + "$" + parseFloat(amountPay).toFixed(2) + ' ' + pay + "</td>" +
                        "<td>" + type + "</td>" +
                        "<td>" + data[0].payments[i].date_amount + "</td>");
                    i++;
                });
            } else {
                console.log("No hay pagos");
                totalPaid = 0;
                Mensaje = 'No hay datos de pagos';
                $('#idPayments').append("<tr><td colspan='5' class='text-center'>" + Mensaje + "</td></tr>");
            }


            var liquidate = 0;
            if (data[0].ordered_reviews[0].coin.code == "MXN") {
                var totalToPay = data[0].ordered_reviews[0].final_amount;
            } else if (data[0].ordered_reviews[0].coin.code == "USD") {
                var totalToPay = (data[0].ordered_reviews[0].final_amount / data[0].ordered_reviews[0].exchange_rate);
            } else {
                alert("fff");
            }

            liquidate = totalToPay /* total a pagar */ - totalPaid /* total pagado */ ;

            var paymentPercentage = (totalPaid * 100) / totalToPay;
            console.log(paymentPercentage);
            if (paymentPercentage > 0) {

                $('#idPercentageEconomic').html(parseFloat(paymentPercentage).toFixed(2) + ' %');
                $('#idAdvanceEconomic').css("width", parseFloat(paymentPercentage).toFixed(2) + "%");
            }
        },
        error: function(data) {
            alert("No se encontro codigo d emoneda");
        }
    });
}




function cleanModalTechnicalAdvanceService() {
    $('.progress-content .circle .active').removeClass().addClass('circle');
    $('.progress-content .circle .done').removeClass().addClass('circle');
    $('.progress-content .circle').removeClass().addClass('circle');
    $('.progress-content .bar .active').removeClass().addClass('bar');
    $('.progress-content .bar .done').removeClass().addClass('bar');
    $('.progress-content .bar').removeClass().addClass('bar');
    $('.progress-content .tooltip-stage-bottom').removeAttr('style');
    $('.progress-content .bar').removeAttr('style');

    $('#idTechnical').val(""); 
    $('#idFolioTechnical').html(""); 
    $('#idTotalTechnical').html(""); 
    $('#idTypeTechnical').html(""); 
    $('#idDescriptionTecnical').html(""); 

    $('#idStage0TechnicalService').html(""); 
    $('#idStage1TechnicalService').html("");
    $('#idStage2TechnicalService').html("");
    $('#idStage3TechnicalService').html();
    $('#idStage4TechnicalService').html("");

    $('#idDateStage2TechnicalService').html("");
    $('#idDateStage3TechnicalService').html("");
    $('#idDateStage4TechnicalService').html("");

    $('#idProgressTechnical').css("width", parseFloat(10).toFixed(2) + "%");
    $('#idProgressTechnical').removeClass().addClass('progress-bar');
    $('#idAdvanceTechnical').html('0.00 %');
}


function cleanModalTechnicalAdvanceSupply() {
    $('.progress-content .circle .active').removeClass().addClass('circle');
    $('.progress-content .circle .done').removeClass().addClass('circle');
    $('.progress-content .circle').removeClass().addClass('circle');
    $('.progress-content .bar .active').removeClass().addClass('bar');
    $('.progress-content .bar .done').removeClass().addClass('bar');
    $('.progress-content .bar').removeClass().addClass('bar');
    $('.progress-content .tooltip-stage-bottom').removeAttr('style');
    $('.progress-content .bar').removeAttr('style');

    $('#idTechnical').val(""); 
    $('#idFolioTechnical').html(""); 
    $('#idTotalTechnical').html(""); 
    $('#idTypeTechnical').html(""); 
    $('#idDescriptionTecnical').html(""); 

    $('#idStage0TechnicalSupply').html(""); 
    $('#idStage1TechnicalSupply').html("");
    $('#idStage2TechnicalSupply').html("");
    $('#idStage3TechnicalSupply').html();
    $('#idStage4TechnicalSupply').html("");
    $('#idStage5TechnicalSupply').html("");

    $('#idDateStage2TechnicalSupply').html("");
    $('#idDateStage3TechnicalSupply').html("");
    $('#idDateStage4TechnicalSupply').html("");
    $('#idDateStage5TechnicalSupply').html("");

    $('#idProgressTechnical').css("width", parseFloat(10).toFixed(2) + "%");
    $('#idProgressTechnical').removeClass().addClass('progress-bar');
    $('#idAdvanceTechnical').html('0.00 %');
}


function graphicSum(progress) {
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
            $('.progress-content .circle:nth-of-type(' + i + ')').addClass('active');
            $('.progress-content .circle:nth-of-type(' + (i - 1) + ')').removeClass('active').addClass('done');
            $('.progress-content .bar:nth-of-type(' + (i - 1) + ')').addClass('active');
            $('.progress-content .bar:nth-of-type(' + (i - 2) + ')').addClass('done').removeClass('active');
        }
        if (i == j - 1) {
            $('.progress-content .circle:nth-of-type(' + (i - 1) + ') .label-icon p').css('opacity', '1');
            $('.progress-content .circle:nth-of-type(' + (i - 1) + ') .label-icon p').css('visibility', 'visible');
            $('.progress-content .circle:nth-of-type(' + (i) + ') .label-icon p').css('opacity', '1');
            $('.progress-content .circle:nth-of-type(' + (i) + ') .label-icon p').css('visibility', 'visible');
            $('.progress-content .bar:nth-of-type(' + (i - 1) + ')').css('background', 'linear-gradient(to right, #81CE97 ' + p + '%, #FFF ' + (p + 20) + '%');
            if (progress.etapa6 < 100 || progress.etapa5 < 100 || progress.etapa4 < 100 || progress.etapa3 < 100) {
                $('.progress-content .circle:nth-of-type(' + (i) + ')').attr('data-toggle', 'modal');
                $('.progress-content .circle:nth-of-type(' + (i) + ')').attr('data-target', '#percentageModal');
                $('.progress-content .circle:nth-of-type(' + (i) + ')').attr('onclick', 'percentageSum(' + progress.idperc + ')');
            }
        }
        i++;
        if (i == 0) {
            $('.progress-content .bar').removeClass().addClass('bar');
            $('.progress-content div.circle').removeClass().addClass('circle');
            i = 1;
        }
    }, 0); /* 1000 */
    return;
}
function technicalAdvanceSupply(id) {
    var ruta = "/supplies/technicalAdvance";
    var type = "Suministro";
    var token = $('#idTokenTechnical').val();
    $.ajax({
        url: ruta,
        headers: { 'X-CSRF-TOKEN': token },
        dataType: 'JSON',
        type: 'GET',
        data: { id: id },
        success: function(data) {
            console.log(data[0]);
            $('#idTechnical').val(data[0].id);
            $('#idFolioTechnical').html(data[0].folio);
            $('#idTypeTechnical').html(type);
            $('#idDescriptionTechnical').html(data[0].description);

            if (data[0].code == "USD") {
                $('#idTotalTechnical').html('$ ' + parseFloat((data[0].ordered_reviews[0].final_amount / data[0].ordered_reviews[0].exchange_rate)).toFixed(2) + ' ' + data[0].ordered_reviews[0].coin.code);
            } else {
                $('#idTotalTechnical').html('$ ' + parseFloat(data[0].ordered_reviews[0].final_amount).toFixed(2) + ' ' + data[0].ordered_reviews[0].coin.code);
            }


            //percentages
            $('#idStage0TechnicalSupply').html(data[0].progress.etapa1 + "%");
            $('#idStage1TechnicalSupply').html(data[0].progress.etapa2 + "%");
            $('#idStage2TechnicalSupply').html(data[0].progress.etapa3 + "%");
            $('#idStage3TechnicalSupply').html(data[0].progress.etapa4 + "%");
            $('#idStage4TechnicalSupply').html(data[0].progress.etapa5 + "%");
            $('#idStage5TechnicalSupply').html(data[0].progress.etapa6 + "%");

            //percentages dates
            $('#idDateStage2TechnicalSupply').html(data[0].progress.date_etapa3);
            $('#idDateStage3TechnicalSupply').html(data[0].date_etapa4);
            $('#idDateStage4TechnicalSupply').html(data[0].progress.date_etapa5);
            $('#idDateStage5TechnicalSupply').html(data[0].date_etapa6);

            //graphic
            graphicSum(data[0].progress);

            var generalAdvance = 0;
            generalAdvance = (parseFloat(data[0].progress.etapa1) + parseFloat(data[0].progress.etapa2) + parseFloat(data[0].progress.etapa3) +
                parseFloat(data[0].progress.etapa4) + parseFloat(data[0].progress.etapa5) + parseFloat(data[0].progress.etapa6)) / 6;

            $('#idAdvanceTechnical').html(parseFloat(generalAdvance).toFixed(2) + ' %');
            $('#idProgressTechnical').css("width", parseFloat(generalAdvance).toFixed(2) + "%");

            if (generalAdvance >= 0 && generalAdvance <= 49) {
                $('#idProgressTechnical').removeClass("progress-bar bg-success");
                $('#idProgressTechnical').removeClass("progress-bar bg-warning");
                $('#idProgressTechnical').addClass("progress-bar bg-danger");
            } else if (generalAdvance >= 50 && generalAdvance < 95) {
                $('#idProgressTechnical').removeClass("progress-bar bg-danger");
                $('#idProgressTechnical').removeClass("progress-bar bg-success");
                $('#idProgressTechnical').addClass("progress-bar bg-warning");
            } else if (generalAdvance >= 95 && generalAdvance <= 100) {
                $('#idProgressTechnical').removeClass("progress-bar bg-danger");
                $('#idProgressTechnical').removeClass("progress-bar bg-warning");
                $('#idProgressTechnical').addClass("progress-bar bg-success");
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function technicalAdvanceService(id) {
    var ruta = "/services/technicalAdvance";
    var type = "Servicio";
    var token = $('#idTokenTechnical').val();
    $.ajax({
        url: ruta,
        headers: { 'X-CSRF-TOKEN': token },
        dataType: 'JSON',
        type: 'GET',
        data: { id: id },
        success: function(data) {
            console.log(data);
            $('#idTechnical').val(data[0].id);
            $('#idFolioTechnical').html(data[0].folio);
            $('#idTypeTechnical').html(type);
            $('#idDescriptionTechnical').html(data[0].description);

            if (data[0].code == "USD") {
                $('#idTotalTechnical').html('$ ' + parseFloat((data[0].ordered_reviews[0].final_amount / data[0].ordered_reviews[0].exchange_rate)).toFixed(2) + ' ' + data[0].ordered_reviews[0].coin.code);
            } else {
                $('#idTotalTechnical').html('$ ' + parseFloat(data[0].ordered_reviews[0].final_amount).toFixed(2) + ' ' + data[0].ordered_reviews[0].coin.code);
            }

            //percentages
            $('#idStage0TechnicalService').html(data[0].progress.etapa1 + "%");
            $('#idStage1TechnicalService').html(data[0].progress.etapa2 + "%");
            $('#idStage2TechnicalService').html(data[0].progress.etapa3 + "%");
            $('#idStage3TechnicalService').html(data[0].progress.etapa4 + "%");
            $('#idStage4TechnicalService').html(data[0].progress.etapa5 + "%");

            //percentages dates
            $('#idDateStage2TechnicalService').html(data[0].progress.date_etapa3);
            $('#idDateStage3TechnicalService').html(data[0].date_etapa4);
            $('#idDateStage4TechnicalService').html(data[0].progress.date_etapa5);

            //graphic
            graphicSum(data[0].progress);

            var generalAdvance = 0;
            generalAdvance = (parseFloat(data[0].progress.etapa1) + parseFloat(data[0].progress.etapa2) + parseFloat(data[0].progress.etapa3) +
                parseFloat(data[0].progress.etapa4) + parseFloat(data[0].progress.etapa5)) / 5;

            $('#idAdvanceTechnical').html(parseFloat(generalAdvance).toFixed(2) + ' %');
            $('#idProgressTechnical').css("width", parseFloat(generalAdvance).toFixed(2) + "%");

            if (generalAdvance >= 0 && generalAdvance <= 49) {
                $('#idProgressTechnical').removeClass("progress-bar bg-success");
                $('#idProgressTechnical').removeClass("progress-bar bg-info"); 
                $('#idProgressTechnical').addClass("progress-bar bg-danger");
            } else if (generalAdvance >= 50 && generalAdvance < 95) {
                $('#idProgressTechnical').removeClass("progress-bar bg-danger");
                $('#idProgressTechnical').removeClass("progress-bar bg-success");
                $('#idProgressTechnical').addClass("progress-bar bg-info");
            } else if (generalAdvance >= 95 && generalAdvance <= 100) {
                $('#idProgressTechnical').removeClass("progress-bar bg-danger");
                $('#idProgressTechnical').removeClass("progress-bar bg-info");
                $('#idProgressTechnical').addClass("progress-bar bg-success");
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}




function cleanModalImagesGalery() {
    $('#idFolioGallery').html("");
    $('#images').html("");
}
function imagesGallery(id,button, folioSupply) {
    if(button == "btnGallerySupply"){
        var ruta = "/supplies/imagesGallery"
    }
    else if(button == "btnGalleryService"){
        var ruta = "/services/imagesGallery";
    }
    var token = $('#idTokenGallery').val();

    $.ajax({
        url: ruta,
        headers: { 'X-CSRF-TOKEN': token },
        dataType: 'JSON',
        type: 'GET',
        data: { id: id },
        success: function(data) {
            console.log(data.images)
            $('#idFolioGallery').html(folioSupply);
            var i = 0;
            if(data.images.length > 0){
                $(data.images).each(function() {
                    console.log();
                    $('#images').append(
                        /* '<a href="storage/imagesProjects/' + data.images[i].name + '"><img  src="storage/imagesProjects/' + data.images[i].name + '" width="120" height="96"></a>' */
                        '<img  src="storage/imagesProjects/' + data.images[i].name + '" width="120" height="96">'
                    );i++;
                });
            }else{
                $('#images').append(
                    '<div class="alert text-center" style="margin:27px 39px;background-color:gray; color:black" role="alert">'+
                        '<strong>No existen imagenes disponibles</strong>'+
                    '</div>'
                );
            }


        },
        error: function(data) {/* Si falla la peticion Ajax */}
    });
}