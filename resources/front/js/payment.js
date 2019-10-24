/*
    Create conekta pay method by card
*/
  
var conektaSuccessResponseHandler = function(token) {

    let nombre = $('#nombre').val();
    let apellido = $('#apellido').val();
    let telefono = $('#telefono').val();
    let correo = $('#correo').val();

    const data = {
        token: token.id,
        nombre: nombre,
        apellido: apellido,
        telefono: telefono,
        correo: correo
    }

    createOrderConektaCard(data);
};

var conektaErrorResponseHandler = function(response) {

    console.log(response);
};

$(function () {
  $("#conekta-card").on('click', function(event) {

    if($("#accept-terms-card-conekta").is(":checked")){
        var $form = $("#card-form-conekta");
        $(this).prop("disabled", true);
        Conekta.Token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
        return false;
    }else{
        alert('Debe aceptar los terminos y condiciones');
    }
  });
});

export function createOrderConektaCard(data) {

    RequestObject.AjaxJson('POST', 'payment/conekta/cart', data).then(
        function (response) {

            //window.location = URL_WEB + '/payment/order-process/' + response.data.order_code;
            //window.location = response.data.redirect;
            
            if($.isEmptyObject(response.error)){
                alert(response.success);
            }else{
                printErrorMsg(response.error);
            }

            console.log(response);
        },
        function (xhrObj, textStatus, err) {
            const data = xhrObj.responseJSON.errors;
            console.log(xhrObj.responseJSON.errors);

            printErrorMsg(data);
        });
};

function printErrorMsg (msg) {
    $(".print-error-msg").find("ul").html('');
    $.each( msg, function( key, value ) {
        console.log(msg);
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });

    $('#error-payment').modal('show')
}

export function createOrderConektaOxxo() {
    $('.btn-payment-total').attr('disabled', true);
    $('.spinner-payment-total').fadeIn();

    if ($("#receiver_store").is(':checked')) {
        $('#user_email').val($('#email_receiver_store').val());
    }

    let type_payment = $('#type_payment').val();
    let user_id = $('#user_id').val();
    let user_email = $('#user_email').val();
    let receiver_store = ($('#receiver_store').is(':checked')) ? 1 : null;
    let shipping_id = $('#id_shipping').val();
    let invoice_id = $('#id_invoice').val();
    let email_receiver_store = $('#email_receiver_store').val();
    let name_receiver_store = $('#name_receiver_store').val();
    let phone_receiver_store = $('#phone_receiver_store').val();
    let sucursal_receiver_store = $('#sucursal_receiver_store').val();

    const data = {
        id_local: local_uuid,
        user_id: user_id,
        type_payment: type_payment,
        shipping_id: shipping_id,
        invoice_id: invoice_id,
        user_email: user_email,
        email_receiver_store: email_receiver_store,
        name_receiver_store: name_receiver_store,
        phone_receiver_store: phone_receiver_store,
        sucursal_receiver_store: sucursal_receiver_store,
        receiver_store: receiver_store
    }

    RequestObject.AjaxJson('POST', 'payment/conekta/oxxo', data).then(
        function (response) {

            window.location = URL_WEB + '/payment/order-process/' + response.data.order_code;
        },
        function (xhrObj, textStatus, err) {
            const data = xhrObj.responseJSON.data;
            
            $('.spinner-payment-total').fadeOut();
            $('.btn-payment-total').removeAttr('disabled');

            if (typeof data !== 'undefined') {
                $("#payment-modal .body-msg").html(data.msg);
                $("#payment-modal").modal();
            }
        });
}