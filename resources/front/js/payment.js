/*
    Create conekta pay method by card
*/

var conektaSuccessResponseHandler = function (token) {

    let nombre = $('#nombre').val();
    let apellido = $('#apellido').val();
    let telefono = $('#telefono').val();
    let correo = $('#correo').val();

    const data = {
        token: token.id,
        nombre: nombre,
        apellido: apellido,
        telefono: telefono,
        correo: correo,
        tipo: 'conekta-card'
    }

    createOrderConektaCard(data);
};

$(function () {
    $("#conekta-card").on('click', function (event) {

        if ($("#accept-terms-card-conekta").is(":checked")) {
            var $form = $("#card-form-conekta");
            $(this).prop("disabled", true);
            Conekta.Token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
            return false;
        } else {
            printErrorProcess('Debe aceptar los terminos y condiciones')
            $(this).removeAttr("disabled");
        }
    });
});

var conektaErrorResponseHandler = function (response) {
    console.log(response.message_to_purchaser);
    $("#conekta-card").removeAttr("disabled");
    printErrorProcess(response.message_to_purchaser)
};

export function createOrderConektaCard(data) {

    RequestObject.AjaxJson('POST', '/payment', data).then(
        function (response) {

            $("#conekta-card").removeAttr("disabled");
            
            if ($.isEmptyObject(response.errors)) {
                window.location = response.data.redirect;
            } else {
                
                $("#conekta-card").removeAttr("disabled");
                if(response.type == 'validation'){
                    printErrorValidation(response.errors);
                }
                
                if(type == 'process'){
                    printErrorProcess(daresponse.errorsta);
                }
                
                if(type == 'redirect'){
                    printErrorRedirect(response.errors, response.place);
                }
            }

            console.log(response);
        },
        function (xhrObj, textStatus, err) {

            if (!$.isEmptyObject(xhrObj.responseJSON.data.errors)){                
                const type = xhrObj.responseJSON.data.type;              
                const data = xhrObj.responseJSON.data.errors;
                
                if(type == 'validation'){
                    printErrorValidation(data);
                }
                
                if(type == 'process'){
                    printErrorProcess(data);
                }
                
                if(type == 'redirect'){           
                    const place = xhrObj.responseJSON.data.place;
                    printErrorRedirect(data, place);
                }
            }
        });
};

export function createConektaOxxoOrder() {

    $("#conekta-oxxo").prop("disabled", true);

    if (!$("#accept-terms-oxxo-conekta").is(":checked")) {
        $("#conekta-oxxo").removeAttr("disabled");
        printErrorProcess('Debe aceptar los terminos y condiciones')
    }

    let nombre = $('#nombre').val();
    let apellido = $('#apellido').val();
    let telefono = $('#telefono').val();
    let correo = $('#correo').val();

    const data = {
        nombre: nombre,
        apellido: apellido,
        telefono: telefono,
        correo: correo,
        tipo: 'conekta-oxxo'
    }

    RequestObject.AjaxJson('POST', '/payment', data).then(
        function (response) {

            $("#conekta-oxxo").removeAttr("disabled");

            if ($.isEmptyObject(response.errors)) {
                window.location = response.data.redirect;
            } else {
                if(response.type == 'validation'){
                    printErrorValidation(response.errors);
                }
                
                if(type == 'process'){
                    printErrorProcess(daresponse.errorsta);
                }
                
                if(type == 'redirect'){
                    printErrorRedirect(response.errors, response.place);
                }
            }
        },
        function (xhrObj, textStatus, err) {

            if (!$.isEmptyObject(xhrObj.responseJSON.data.errors)){                
                const type = xhrObj.responseJSON.data.type;              
                const data = xhrObj.responseJSON.data.errors;
                
                if(type == 'validation'){
                    printErrorValidation(data);
                }
                
                if(type == 'process'){
                    printErrorProcess(data);
                }
                
                if(type == 'redirect'){           
                    const place = xhrObj.responseJSON.data.place;
                    printErrorRedirect(data, place);
                }
            }
        });
}

function printErrorValidation(msg) {
    if ($('#modal-json .modal-body ol').length > 0) {
        $('#modal-json .modal-body ol').remove();
    }
    $('#modal-json .modal-body').append('<ol></ol>');
    $("#modal-json .modal-body").find("ol").html('');

    $.each(msg, function (key, value) {
        $("#modal-json .modal-body").find("ol").append('<li>' + value + '</li>');
    });

    $("#modal-json .modal-title").html('¡Error!');
    $("#modal-json").modal('show');
}

function printErrorProcess(msg) {
    if ($('#modal-json .modal-body ol').length > 0) {
        $('#modal-json .modal-body ol').remove();
    }
    $('#modal-json .modal-body').append('<ol></ol>');
    $("#modal-json .modal-body").find("ol").html('');
    $("#modal-json .modal-body").find("ol").append('<li>' + msg + '</li>');
    $("#modal-json .modal-title").html('¡Error!');
    $("#modal-json").modal('show');
}

function printErrorRedirect(msg, place) {
    if ($('#modal-json .modal-body ol').length > 0) {
        $('#modal-json .modal-body ol').remove();
    }
    $('#modal-json .modal-body').append('<ol></ol>');
    $("#modal-json .modal-body").find("ol").html('');
    $("#modal-json .modal-body").find("ol").append('<li>' + msg + '</li>');
    $("#modal-json .modal-title").html('¡Error!');
    $("#modal-json").modal('show');

    setTimeout(function(){
        window.location.href = place;
    }, 5000);
}

