<html>
    <head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/estilo.css">
  </head>
 <body>
 	<h4 style="color: white;">Conexión a bases de datos orientado a grafos: Usando Neo4j</h4>
 	<!--Botones-->
 	<div id="botones">
 		<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#crearNodos">Crear nodo</button>
 		<button class="btn btn-danger btn-lg" data-toggle="modal" data-target="#eliminarNodo">Eliminar nodo</button>
 	</div>
 	<!--Zona de la tabla-->
	  <div class="tablita">
	  	<section class="features_table">
        <div class="container ">
        	<div class="col-sm-8 col-2 col-xs-12 no-padding">
            	<div class="features-table">
                	<ul>
                    	<h1>Empleado</h1>
                    	<?php 
						    foreach ($nodos as $row) {
						    echo '<li>'.($row['n']->nombre).'</li>';
							}
						?>
                    </ul>
                </div>
            </div>
            <div class="col-sm-2 col-2 col-xs-12 no-padding">
            <div class="features-table-free">
                	<ul>
                    	<h1>Ciudad</h1>
                        <?php 
						    foreach ($nodos as $row2) {
						    echo '<li>'.($row2['n']->Ciudad).'</li>';
							}
						?>
                    </ul>
                </div>
            
            </div>
             <div class="col-sm-2 col-2 col-xs-12 no-padding">
             	 <div class="features-table-paid">
                	<ul>
                    	<h1>Salario</h1>
                        <?php 
						    foreach ($nodos as $row3) {
						    echo '<li> $'.($row3['n']->sal).'</li>';
							}
						?>
                    </ul>
                </div>
             </div>
        	</div>
   		 </section>
	  </div>
	  <!--Modales-->
	  <div id="crearNodos" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Crear nuevo nodo</h4>
		      </div>
		      <div class="modal-body">
		      		<label for="nombre">Nombre: 
						<input type="text" name="nombre" id="inputdenombre" required="true">
		      		</label>
		      		<label for="ciudad">Ciudad: 
						<input type="text" name="ciudad" id="inputdeciudad" required="true">
		      		</label>
		      		<label for="salario">Salario: 
						<input type="text" name="salario" id="inputdesalario" required="true">
		      		</label>
		      </div>
		      <div class="modal-footer">
		      	<button type="button" class="btn btn-primary" id="guardanodo">Guardar</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
	   </div>

	  <div id="eliminarNodo" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Crear nuevo nodo</h4>
		      </div>
		      <div class="modal-body">
		      		<label for="nombreDelete">Nombre del empleado a eliminar: 
						<input type="text" name="nombreDelete" id="inpuBorraNombre" required="true">
		      		</label>
		      </div>
		      <div class="modal-footer">
		      	<button type="button" class="btn btn-danger" id="eliminarNodoBoton">Elimina</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
	   </div>

	   <script type="text/javascript">
	   	$('#guardanodo').click(function (){
	   		var nombreInput = $('#inputdenombre').val();
	   		var ciudadInput = $('#inputdeciudad').val();
	   		var salarioInput = $('#inputdesalario').val();
	   			$.ajax({
			   		url: 'index.php/Principal/guardar',
			   		type: 'POST',
			   		dataType: 'json',
			   		data: {nombre: nombreInput, ciudad: ciudadInput, salario: salarioInput},
			   	})
			   	.done(function(data) {
			   		console.log("success");
			   		location.reload();
			   	})
			   	.fail(function() {
			   		console.log("error");
			   	})
			   	.always(function(){
			   		location.reload();
			   	});
	   	});


	   	$('#eliminarNodoBoton').click(function (){
	   		var nombreInputBorrar = $('#inpuBorraNombre').val();
	   			$.ajax({
			   		url: 'index.php/Principal/eliminar',
			   		type: 'POST',
			   		dataType: 'json',
			   		data: {nombreBorra: nombreInputBorrar},
			   	})
			   	.done(function(data) {
			   		console.log("success");
			   	})
			   	.fail(function() {
			   		console.log("error");
			   	})
			   	.always(function(){
			   		location.reload();
			   	});
	   	});
	   
	   	

	   </script>

  </body>   
</html>  