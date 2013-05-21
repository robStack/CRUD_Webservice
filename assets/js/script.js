$(function() {

	/* Configuración de la ventanas */
	$('#altaUsuario').dialog({
		draggable: false,
	    autoOpen: false,
	    modal:true,
	    width:'auto',
	    height:'auto',
	    resizable: false,
	    close:function(){	    	
			$('#altaUsuario input[type="text"]').val('');						                
			load_table();
	    }
	});

    $('#editarUsuario').dialog({
		draggable: false,
        autoOpen: false,
        modal:true,
        width:'auto',
        height:'auto',
        resizable: false,
        close:function(){
        	$('#editarUsuario input[type="text"]').val('');	
        	load_table();				                
        }
    });

    $('#eliminarUsuario').dialog({
		draggable: false,
        autoOpen: false,
        modal:true,
        width:'auto',
        height:'auto',
        resizable: false,
        buttons: {
			"Confirmar": function() {
				var id = $( this ).attr('name');
				$.ajax({
					cache: false,
					type: "POST",
					url: "includes/delete.php",
					data: 'id=' + id,
					success: function(msg){
						var mensaje = $.parseJSON(msg);
						alert(mensaje);
						load_table();
					}
			    });
			    $( this ).dialog( "close" );
			},
			"Cancelar": function() {
				$( this ).dialog( "close" );
			}
		}
    });

    /* Eventos Click en botones de agregar, editar y eliminar */

    $(document).on('click','#add', function(){
    /*$('#add').click(function(){*/
		$( "#altaUsuario" ).dialog( "open" );
	});

    $(document).on('click','.edit', function(){
	/*$('.edit').click(function(){*/	
		var id = $(this).attr('name');	
		$.ajax({
			cache: false,
			type: "GET",
			url: "includes/read.php",
			data: 'fn=read_data&id=' + id,
			success: function(response){
				var r = jQuery.parseJSON(response);
				$('#editarUsuario #editNombre').val(r['nombre']);
				$('#editarUsuario #editTelefono').val(r['telefono']);
				$('#editarUsuario #editDireccion').val(r['direccion']);
			},
			error:function(){
	            alert('Error del sistema, intente más tarde');
	        }
	    });
	    $("#editarUsuario").attr('name',id);
		$("#editarUsuario").dialog("open");
	});

	/*$('.delete').click(function(){*/
	$(document).on('click','.delete', function(){
		var name = $(this).attr('id');
		$('#eliminarUsuario').attr('name',name);
		$('#eliminarUsuario').dialog("open");
	});

	$(document).on('click','#reload', function(){
	/*$('#reload').click(function(){*/
		load_table();
	});

	/* Validación de información en formulario */

	$('#registroUsuarios').validate({
		submitHandler: function(){
			$.ajax({
				beforeSend: function(){
					$('#registroUsuarios #loader').removeClass('hide');
					$('#enviar').hide();
			},
			cache: false,
			type: "POST",
			url:"includes/create.php",
			data: $('#registroUsuarios').serialize(),
            success: function(msg){
            	var m = jQuery.parseJSON(msg);
            	alert(m);
	            $('#registroUsuarios #loader').addClass('hide');
	            $('#enviar').show();
	            $('#registroUsuarios input[type="text"]').val('');
	            $('#registroUsuarios input[type="password"]').val('');
	            $( "#altaUsuario" ).dialog('close');
	        },
            error:function(){
                alert('Error del sistema, intente más tarde');
            }
        });
		return false;
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.prev("span").append());
        }
	});

	$('#editUsuarios').validate({
		submitHandler: function(){
			var id = $('#editarUsuario').attr('name');
			$.ajax({
				beforeSend: function(){
				$('#editarUsuarios #eloader').removeClass('hide');
				$('#editEnviar').hide();
			},
			cache: false,
			type: "POST",
			url:"includes/update.php",
			data: $('#editUsuarios').serialize()+"&id="+id,
            success: function(msg){
            	var m = jQuery.parseJSON(msg);
            	console.log(m);
	            $('#editarUsuarios #loader').addClass('hide');
	            $('#enviar').show();
	            $('#editar input[type="text"]').val('');
	            $('#editar input[type="password"]').val('');
	            $( "#editarUsuario" ).dialog('close');
	        },
            error:function(){
                alert('Error del sistema, intente más tarde');
            }
        });
		return false;
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.prev("span").append());
        }
	});

	$('#pass2').keyup(function(){			
		var val1 = $('#pass1').val();
		var val2 = $('#pass2').val();
		var element = $('#pass1');
		var error;
		element.prev("span").children().remove();
		if(val1 != val2)
			error = '<p class="errorFalse">Las contraseñas no coinciden</p>';
		else
			error = '<p class="errorTrue">Las contraseñas coinciden</p>';			
		element.prev("span").append(error);		
	});

	function load_table(){
		$.ajax({
			cache:false,
			type:'GET',
			url: "includes/read.php",
			data: 'fn=read',
			/*data: 'fn=' + funcion,*/
			success: function(datos){
				var data = $.parseJSON(datos);
				$('.tabla').html(data);
			},
			error:function(){
	           $('.tabla').append("Error estableciendo conexión con la base de datos");
	        }
	    });
	
	}
});