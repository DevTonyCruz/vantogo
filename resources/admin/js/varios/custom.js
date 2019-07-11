export function mostrar_password() {
    var cambio = document.getElementById("password");
    if (cambio.type == "password") {
        cambio.type = "text";
        $('.view-password i').removeClass('mdi-eye-off-outline').addClass('mdi-eye-outline');
    } else {
        cambio.type = "password";
        $('.view-password i').removeClass('mdi-eye-outline').addClass('mdi-eye-off-outline');
    }
}

export function modal_permissions() {
    $('#modal-permiso').modal();
}

$('#select-all').click(function(event) {

    if (this.checked) {
        $(':checkbox').each(function() {
            this.checked = true;
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;
        });
    }
});