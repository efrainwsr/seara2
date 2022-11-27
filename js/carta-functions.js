                $(document).ready(function(){
            //función click
            $("#btnAgregaItem").click(function(){
                var nombre = $("#nombre").val();
                var precio = $("#precio").val();
                //var desc = $("#desc").val();
                var categoria = $("#categoria").val();
                //var variante = $("#").val();
                //var status = $("#tipo").val();
               
                if(nombre == ""){
                    var errornombre = document.getElementById('divname');
                    errornombre.className = "input-group has-error form-group";
                }
                    if(precio == ""){
                        //document.frmRegistro.apellido.focus()
                        let errorprecio = document.getElementById('divprecio');
                    	errorprecio.className = "input-group has-error form-group";
                    }
                    if(categoria == "A"){
                        let errorcategoria = document.getElementById('divcategoria');
                    	errorcategoria.className = "input-group has-error form-group";
                        }
            });//click
       });//ready
  
        
     