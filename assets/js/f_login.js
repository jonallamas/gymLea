$(document).ready(function() {
    $('#f_login_correo').focus();
});

$('#btnIngresar').on('click', function(e){
	e.preventDefault();

	let f_login_correo = $('#f_login_correo').val();
	let f_login_pass = $('#f_login_pass').val();

	$('#alerta_login').fadeOut('fast');

	if(f_login_correo == ''){
		$('#alerta_login').fadeIn('fast', function(){
			$('#alerta_login').html('<p><b>Atención:</b> Debe rellenar el correo</p>');
			$('#f_login_correo').focus();
		});
		return false;
	}

	if(validarCorreo(f_login_correo) == false){
        $("#alerta_login").fadeIn('fast', function(){
            $('#alerta_login').html("<p><b>Atención:</b> La dirección de email es incorrecta</p>");
            $("#f_login_correo").focus();
        });
        return false;
    }
    if(f_login_pass == ''){
        $("#alerta_login").fadeIn('fast', function(){
            $('#alerta_login').html('<p><b>Atención:</b> Campo incompleto</p>');
            $('#f_login_pass').focus();
        });
         return false;
    }

    $.ajax({
        type: 'POST',
        data: {
            'f_login_correo': f_login_correo,
            'f_login_pass'	: f_login_pass
        },
        url: base_url+'panel/ingreso',
        success: function(data){
        var data = jQuery.parseJSON(data);
        console.log(data);
        if(data.conectado == 1){
        	if(data.usuario_tipo == 1){
                $("#alerta_login").fadeOut('fast');
                window.location.replace(base_url+'panel');
        	}else{
        		$("#alerta_login").fadeOut('fast');
                window.location.replace(base_url);
        	}
        }
        else{
            if(data.error){
                $("#alerta_login").fadeIn('fast');
                $('#alerta_login').html('<p><b>Atención:</b> '+data.error_texto+'</p>');
            }
        }
      }
    });
});

function validarCorreo(valor) {
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if(reg.test(valor)) { return true; }else{ return false; }
}