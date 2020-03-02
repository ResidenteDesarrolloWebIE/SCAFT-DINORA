$(document).ready(function() {
    $("#moreInformationSupply").on('hidden.bs.modal', function() {
        cleanModalMoreInformation();
    });
    $("#financialAdvanceSupply").on('hidden.bs.modal', function() {
        cleanModalFinancialAdvance();
    });
    $("#technicalAdvanceSupply").on('hidden.bs.modal', function() {
        cleanModalTechnicalAdvance();
    });
    $("#imagesGallerySupply").on('hidden.bs.modal', function() {
        cleanModalImagesGalery();
    }); 
});

function cleanModalMoreInformation() {
    $('#idFolioSupply').html("");
    $('#idFolioAuxSupply').html("");
    $('#idFolioProjectSupply').html("");
    $('#idDateSupply').html("");
    $('#idTotalSupply').html("")
    $('#idDescriptionSupply').html("");
    $('#idNotesSupply').html("");
}
function moreInformationSupply (id) {
    var ruta = "/supplies/moreInformation"; /* {{URL('moreInformation')}} */
    var token = $('#tokenMoreInformation').val();
    $.ajax({
        url: ruta,
        headers: { 'X-CSRF-TOKEN': token },
        dataType: 'JSON',
        type: 'GET',
        data: { id: id },
        success: function(data) {
            console.log(data[0])
            $('#idFolioSupply').html(data[0].folio);
            $('#idFolioAuxSupply').html(data[0].folio);
            $('#idFolioProjectSupply').html(data[0].project.folio);
            $('#idDateSupply').html(data[0].created_at);
            $('#idTotalSupply').html(data[0].ordered_reviews[0].final_amount + " " + data[0].ordered_reviews[0].coin.code)
            $('#idDescriptionSupply').html(data[0].descripction);
            $('#idNotesSupply').html(data[0].notes);
        },
        error: function(data) {
            /* Si falla la peticion Ajax */
        }
    });
}




function cleanModalFinancialAdvance() {
    $('#idFolioSupplyEco').html("")
    $('#idSupplyEco').val("");
    $('#idTypeSupplyEco').html("");
    $('#idDescriptionSupplyEco').html("");
    $('#idTotalSupplyEco').html("");
    $('#idPaymentsSupply').html("");

    $('#idPercentageSupplyEco').html('0.00 %'); 
    $('#idAdvanceSupplyEco').css("width", parseFloat(70).toFixed(2) + "%");  
}

function financialAdvanceSupply(id) {
    var ruta = "/supplies/financialAdvance";
    var token = $('#idTokenSupplyEco').val();
    var type = "Suministro";
    $.ajax({
        url: ruta,
        headers: { 'X-CSRF-TOKEN': token },
        dataType: 'JSON',
        type: 'GET',
        data: { id: id },
        success: function(data) {
            $('#idSupplyEco').val(data[0].id);
            $('#idFolioSupplyEco').html(data[0].folio);
            $('#idTypeSupplyEco').html(type);
            $('#idDescriptionSupplyEco').html(data[0].descripction);

            if (data[0].ordered_reviews[0].coin.code == "USD") {
                $('#idTotalSupplyEco').html('$ ' + parseFloat((data[0].ordered_reviews[0].final_amount / data[0].ordered_reviews[0].exchage_rate)).toFixed(2) + ' ' + data[0].ordered_reviews[0].coin.code);
            } else if (data[0].ordered_reviews[0].coin.code == "MXN") {
                $('#idTotalSupplyEco').html('$ ' + parseFloat(data[0].ordered_reviews[0].final_amount).toFixed(2) + ' ' + data[0].ordered_reviews[0].coin.code);
            }

            $('#idPaymentsSupply').html("");
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
                    $('#idPaymentsSupply').append(
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
                $('#idPaymentsSupply').append("<tr><td colspan='5' class='text-center'>" + Mensaje + "</td></tr>");
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
                
                $('#idPercentageSupplyEco').html(parseFloat(paymentPercentage).toFixed(2) + ' %');
                $('#idAdvanceSupplyEco').css("width", parseFloat(paymentPercentage).toFixed(2) + "%");
            }
        },
        error: function(data) {
            alert("Error");
        }
    });
}



function cleanModalTechnicalAdvanceSupply() {
    $('.progress2 .circle .active').removeClass().addClass('circle');
    $('.progress2 .circle .done').removeClass().addClass('circle');
    $('.progress2 .circle').removeClass().addClass('circle');
    $('.progress2 .bar .active').removeClass().addClass('bar');
    $('.progress2 .bar .done').removeClass().addClass('bar');
    $('.progress2 .bar').removeClass().addClass('bar');
    $('.progress2 .globo').removeAttr('style');
    $('.progress2 .bar').removeAttr('style');

    $('#idSupplyTec').val(""); 
    $('#idFolioSupplyTec').html(""); 
    $('#idTotalSupplyTec').html(""); 
    $('#idTypeSupplyTec').html(""); 
    $('#idDescriptionTec').html(""); 

    $('#idStage0SupplyTec').html(""); 
    $('#idStage1SupplyTec').html("");
    $('#idStage2SupplyTec').html("");
    $('#idStage3SupplyTec').html();
    $('#idStage4SupplyTec').html("");
    $('#idStage5SupplyTec').html("");

    $('#idDateStage2SupplyTec').html("");
    $('#idDateStage3SupplyTec').html("");
    $('#idDateStage4SupplyTec').html("");
    $('#idDateStage5SupplyTec').html("");

    $('#idProgressSupplyTec').css("width", parseFloat(10).toFixed(2) + "%");
    $('#idProgressSupplyTec').removeClass().addClass('progress-bar');
    $('#idAdvanceSupplyTec').html('0.00 %');
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

    $('#idSupplyTec').val(""); 
    $('#idFolioSupplyTec').html(""); 
    $('#idTotalSupplyTec').html(""); 
    $('#idTypeSupplyTec').html(""); 
    $('#idDescriptionTec').html(""); 

    $('#idStage0SupplyTec').html(""); 
    $('#idStage1SupplyTec').html("");
    $('#idStage2SupplyTec').html("");
    $('#idStage3SupplyTec').html();
    $('#idStage4SupplyTec').html("");
    $('#idStage5SupplyTec').html("");

    $('#idDateStage2SupplyTec').html("");
    $('#idDateStage3SupplyTec').html("");
    $('#idDateStage4SupplyTec').html("");
    $('#idDateStage5SupplyTec').html("");

    $('#idProgressSupplyTec').css("width", parseFloat(10).toFixed(2) + "%");
    $('#idProgressSupplyTec').removeClass().addClass('progress-bar');
    $('#idAdvanceSupplyTec').html('0.00 %');
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

function technicalAdvanceSupply(id) {
    var ruta = "/supplies/technicalAdvance";
    var type = "Suministro";
    var token = $('#idTokenSupplyTec').val();

    $.ajax({
        url: ruta,
        headers: { 'X-CSRF-TOKEN': token },
        dataType: 'JSON',
        type: 'GET',
        data: { id: id },
        success: function(data) {
            console.log(data[0]);
            $('#idSupplyTec').val(data[0].id);
            $('#idFolioSupplyTec').html(data[0].folio);
            $('#idTypeSupplyTec').html(type);
            $('#idDescriptionSupplyTec').html(data[0].descripction);

            if (data[0].code == "USD") {
                $('#idTotalSupplyTec').html('$ ' + parseFloat((data[0].ordered_reviews[0].final_amount / data[0].ordered_reviews[0].exchage_rate)).toFixed(2) + ' ' + data[0].ordered_reviews[0].coin.code);
            } else {
                $('#idTotalSupplyTec').html('$ ' + parseFloat(data[0].ordered_reviews[0].final_amount).toFixed(2) + ' ' + data[0].ordered_reviews[0].coin.code);
            }


            //percentages
            $('#idStage0SupplyTec').html(data[0].progress.etapa1 + "%");
            $('#idStage1SupplyTec').html(data[0].progress.etapa2 + "%");
            $('#idStage2SupplyTec').html(data[0].progress.etapa3 + "%");
            $('#idStage3SupplyTec').html(data[0].progress.etapa4 + "%");
            $('#idStage4SupplyTec').html(data[0].progress.etapa5 + "%");
            $('#idStage5SupplyTec').html(data[0].progress.etapa6 + "%");
            //percentages dates
            $('#idDateStage2SupplyTec').html(data[0].progress.date_etapa3);
            $('#idDateStage3SupplyTec').html(data[0].date_etapa4);
            $('#idDateStage4SupplyTec').html(data[0].progress.date_etapa5);
            $('#idDateStage5SupplyTec').html(data[0].date_etapa6);

            //graphic
            graphicSum(data[0].progress);

            var generalAdvance = 0;
            generalAdvance = (parseFloat(data[0].progress.etapa1) + parseFloat(data[0].progress.etapa2) + parseFloat(data[0].progress.etapa3) +
                parseFloat(data[0].progress.etapa4) + parseFloat(data[0].progress.etapa5) + parseFloat(data[0].progress.etapa6)) / 6;

            $('#idAdvanceSupplyTec').html(parseFloat(generalAdvance).toFixed(2) + ' %');
            $('#idProgressSupplyTec').css("width", parseFloat(generalAdvance).toFixed(2) + "%");

            if (generalAdvance >= 0 && generalAdvance <= 49) {
                $('#idProgressSupplyTec').removeClass("progress-bar bg-success");
                $('#idProgressSupplyTec').removeClass("progress-bar bg-warning");
                $('#idProgressSupplyTec').addClass("progress-bar bg-danger");
            } else if (generalAdvance >= 50 && generalAdvance < 95) {
                $('#idProgressSupplyTec').removeClass("progress-bar bg-danger");
                $('#idProgressSupplyTec').removeClass("progress-bar bg-success");
                $('#idProgressSupplyTec').addClass("progress-bar bg-warning");
            } else if (generalAdvance >= 95 && generalAdvance <= 100) {
                $('#idProgressSupplyTec').removeClass("progress-bar bg-danger");
                $('#idProgressSupplyTec').removeClass("progress-bar bg-warning");
                $('#idProgressSupplyTec').addClass("progress-bar bg-success");
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}



function cleanModalImagesGalery() {
    $('#idFolioSupplyGal').html("");
    $('#images').html("");
}
function imagesGallerySupply(id, folioSupply) {
    var ruta = "/supplies/imagesGallery"; /* {{URL('moreInformation')}} */
    var token = $('#idTokenGallerySupply').val();
    $.ajax({
        url: ruta,
        headers: { 'X-CSRF-TOKEN': token },
        dataType: 'JSON',
        type: 'GET',
        data: { id: id },
        success: function(data) {
            console.log(data.images)
            $('#idFolioSupplyGal').html(folioSupply);
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