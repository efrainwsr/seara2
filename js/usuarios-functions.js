
		function agregaDatosUsuario(idusuario){

			$.ajax({
				type:"POST",
				data:"idusuario=" + idusuario,
				url:"../procesos/usuarios/obtenDatosUsuario.php",
				success:function(r){
					dato=jQuery.parseJSON(r);

					$('#idUsuario').val(dato['id_usuario']);
					$('#nombreU').val(dato['nombre']);
					$('#apellidoU').val(dato['apellido']);
					$('#usuarioU').val(dato['email']);
					$('#passwordU').val(dato['password']);
					$('#tipoU').val(dato['tipo']);
				}
			});
		}

		function eliminarUsuario(idusuario){
			alertify.confirm('¿Desea eliminar este usuario?', function(){ 
				$.ajax({
					type:"POST",
					data:"idusuario=" + idusuario,
					url:"../procesos/usuarios/eliminarUsuario.php",
					success:function(r){
						if(r==1){
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
							alertify.success("Eliminado con exito.");
						}else{
							alertify.error("No se pudo eliminar.");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelado.')
			});
		}

		function ocultarUsuario(idusuario){
			alertify.confirm('¿Desea eliminar este usuario?', function(){ 
				$.ajax({
					type:"POST",
					data:"idusuario=" + idusuario,
					url:"../procesos/usuarios/removerUsuario.php",
					success:function(r){
						if(r==1){
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
							alertify.success("Eliminado con exito.");
						}else{
							alertify.error("No se pudo eliminar.");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelado.')
			});
		}


	
		$(document).ready(function(){
			$('#btnActualizaUsuario').click(function(){

				vacios=validarFormVacio('frmRegistroU');

				if(vacios > 0){
					//alertify.alert("Debes llenar todos los campos!");
					return false;
				}

				datos=$('#frmRegistroU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/usuarios/actualizaUsuario.php",
					success:function(r){

						if(r==1){
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
							alertify.success("Modificacion exitosa.");
						}else{
							alertify.error("No se pudo modificar.");
						}
					}
				});
			});
		});



		$(document).ready(function(){

			$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');

			$('#registro').click(function(){

				vacios=validarFormVacio('frmRegistro');

				if(vacios > 0){
					//alertify.alert("Debes llenar todos los campos!");
					return false;
				}

				datos=$('#frmRegistro').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/regLogin/registrarUsuario.php",
					success:function(r){
			

						if(r==1){
							$('#frmRegistro')[0].reset();
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
							alertify.success("Agregado con exito.");
						}else{
							alertify.error("Fallo al agregar.");
						}
					}
				});
			});
		});

        
        $(document).ready(function(){
            //función click
            $("#registro").click(function(){
                var nombre = $("#nombre").val();
                var apellido = $("#apellido").val();
                var usuario = $("#usuario").val();
                var password = $("#password").val();
                var tipo = $("#tipo").val();
               
                if(nombre == ""){
                    var errornombre = document.getElementById('divname');
                    errornombre.className = "input-group has-error form-group";
                }
                    if(apellido == ""){
                        //document.frmRegistro.apellido.focus()
                        let errorapellido = document.getElementById('divapellido');
                    	errorapellido.className = "input-group has-error form-group";
                    }
                    if(usuario == ""){
                        let errorusuario = document.getElementById('divusuario');
                    	errorusuario.className = "input-group has-error form-group";
                        }
                  
                    if(password == ""){
                        let divpassword = document.getElementById('divpassword');
                    	divpassword.className = "input-group has-error form-group";
                        }

                     if(tipo == "A" ){
                        var errorcargo = document.getElementById('divcargo');
                    	errorcargo.className = "input-group has-error form-group";
                    }
            });//click
       });//ready
  
        
        $(document).ready(function(){
            //función click
            $("#btnActualizaUsuario").click(function(){
                var nombreU = $("#nombreU").val();
                var apellidoU = $("#apellidoU").val();
                var usuarioU = $("#usuarioU").val();         
                if(nombreU == ""){
                    $("#mensaje11").fadeIn("slow");
                    document.frmRegistroU.nombre.focus()
                    return false;
                }else{
                	$("#mensaje1").fadeOut();
                }
                    if(apellidoU == ""){
                        $("#mensaje22").fadeIn("slow");
                        document.frmRegistroU.apellidoU.focus()
                        return false;
                    }
                    else{
                        $("#mensaje2").fadeOut();
 			}
                        if(usuarioU == ""){
                            $("#mensaje33").fadeIn("slow");
                            document.frmRegistroU.usuarioU.focus()
                            return false;
                        }
                        else{
                            $("#mensaje33").fadeOut();
                        }
                    
            });//click
       });//ready