function agregaDatosMesa(idmesa){

			$.ajax({
				type:"POST",
				data:"idmesa=" + idmesa,
				url:"../procesos/mesa/obtenDatosMesa.php",
				success:function(r){
					dato=jQuery.parseJSON(r);

					$('#idmesa').val(dato['id_mesa']);
				}
			});
		}