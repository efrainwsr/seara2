<?php $hoy=date("Y/m/d");  ?>

<div class="row">
				<div class="col-sm-8"></div>
				<div class="col-sm-4">
					
<div>
<label for="inicio">Desde:</label>
<label for="fin">Hasta:</label>
</div>
					<form class="form-inline" method="POST" action="">
					<!--<label for="inicio">Desde:</label>-->
					<input type="date" id="inicio" name="trip-start"
					       value=""
					       min="<?php echo $hoy; ?>" max="<?php echo $hoy; ?>">

					<input type="date" id="fin" name="trip-end"
					 		value=""
					       min="<?php echo $hoy; ?>" max="<?php echo $hoy; ?>">

					       <br>
					       
					<button class="btn btn-primary btn-sm" name="search">Buscar</button>
				</form>

				</div>
			</div>