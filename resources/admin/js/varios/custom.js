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

export function modal_action_delete(url) {
    $("#form-delete").attr('action', url);
    $('#modal-action-delete').modal();
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

$(document).ready(function(){
  
    $('#file_driver').change(function(e) {
        addImageChofer(e);
    });
  
    function addImageChofer(e){
      var file = e.target.files[0],
      imageType = /image.*/;
  
      if (!file.type.match(imageType))
         return;
  
      var reader = new FileReader();
      reader.onload = fileOnloadChofer;
      reader.readAsDataURL(file);
    }
  
    function fileOnloadChofer(e) {
      var result=e.target.result;
      $('#chofer-img-out').css('display', 'initial');
      $('#chofer-img-out').removeClass('d-none');
      $('#chofer-img-out').attr("src", result);
      $('#chofer-img-out').css("vertical-align", "unset");
    }
  
    $('#file_license').change(function(e) {
        addImageLicencia(e);
    });
  
    function addImageLicencia(e){
      var file = e.target.files[0],
      imageType = /image.*/;
  
      if (!file.type.match(imageType))
         return;
  
      var reader = new FileReader();
      reader.onload = fileOnloadLicencia;
      reader.readAsDataURL(file);
    }
  
    function fileOnloadLicencia(e) {
      var result=e.target.result;
      $('#licencia-img-out').css('display', 'initial');
      $('#licencia-img-out').removeClass('d-none');
      $('#licencia-img-out').attr("src", result);
      $('#licencia-img-out').css("vertical-align", "unset");
    }
  })