
<!DOCTYPE html>
<html>
  <head>
 
    
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="theme-color" content="#000000" />

    <style type="text/css">
      #mapa {
            height: 79vh;
      }
      .h2s {
        font-size: 3vh;
      }
    </style> 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfpU5g8M7W7KzG41zVHAbGQo_4uKUGWPk&callback=initMap">></script>         

  </head>

  <body> 
<!--
    <div class="pccp mt-5 mb-3" align="center">
            
              <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
              
              <ins class="adsbygoogle"
                   style="display:block"
                   data-ad-client="ca-pub-2390065838671224"
                   data-ad-slot="1441100372"
                   data-ad-format="auto"
                   data-full-width-responsive="true"></ins>
              <script>
              (adsbygoogle = window.adsbygoogle || []).push({});
              </script>
    </div>
--> 
    <main role="main">

        <div class="container text-center mt-2">

          <div class="row">

            <div class="col-md-12">

              <!-- Contenedor del Mapa de Google --> 
              <div id="mapa"></div>               

            </div>

          </div>

          <div class="row mt-3">

            <div class="col-md-12">

              <!-- Archivo PHP con la lógica para mostrar una tabla con las ubicaciones -->
              <?php //include('app.php'); ?> 
              
            </div>
            
          </div> 

    </main> 

    <script type="text/javascript">
      function initMap() {
          var map;
          var bounds = new google.maps.LatLngBounds();
          var mapOptions = {
              mapTypeId: 'roadmap'
          };

          map = new google.maps.Map(document.getElementById('mapa'), {
              mapOptions
          });

          map.setTilt(50);

          // Crear múltiples marcadores desde la Base de Datos 
          var marcadores = [
              <?php include('marcadores.php'); ?>
          ];

          // Creamos la ventana de información para cada Marcador
          var ventanaInfo = [
              <?php include('info_marcadores.php'); ?>
          ];

          // Creamos la ventana de información con los marcadores 
          var mostrarMarcadores = new google.maps.InfoWindow(),
              marcadores, i;

          // Colocamos los marcadores en el Mapa de Google 
          for (i = 0; i < marcadores.length; i++) {
              var position = new google.maps.LatLng(marcadores[i][1], marcadores[i][2]);
              bounds.extend(position);
              marker = new google.maps.Marker({
                  position: position,
                  map: map,
                  title: marcadores[i][0]
              });

              // Colocamos la ventana de información a cada Marcador del Mapa de Google 
              google.maps.event.addListener(marker, 'click', (function(marker, i) {
                  return function() {
                      mostrarMarcadores.setContent(ventanaInfo[i][0]);
                      mostrarMarcadores.open(map, marker);
                  }
              })(marker, i));

              // Centramos el Mapa de Google para que todos los marcadores se puedan ver 
              map.fitBounds(bounds);
          }

          // Aplicamos el evento 'bounds_changed' que detecta cambios en la ventana del Mapa de Google, también le configramos un zoom de 14 
          var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
              this.setZoom(13);
              google.maps.event.removeListener(boundsListener);
          });

      }

      // Lanzamos la función 'initMap' para que muestre el Mapa con Los Marcadores y toda la configuración realizada 
      google.maps.event.addDomListener(window, 'load', initMap);
    </script>
    
  </body>
</html>

