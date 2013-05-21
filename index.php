<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Usuarios en el sistema</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-responsive.min.css">
	<link href="assets/css/ui-lightness/jquery-ui-1.10.3.custom.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="row">
		<div class="span3"></div>
		<div class="span8">
			<div class="panel">
				Simple CRUD
			</div>
			<div class="crud">				
				<div class="tabla">
					<?php
						require_once('includes/conexion.class.php');
						$crud = new conexionMysql();
						echo $crud -> read();
					?>
				</div>
			</div>
		</div>
		<div class="span2"></div>
	</div>
	<div id="altaUsuario" title="Agregar nuevo usuario" style="width:500px;display: none;">
		<form id="registroUsuarios" action="#" method="post">
			<p><label><b>Nombre</b></label>
			<span></span>
			<input type="text" name="nombre" placeholder="Nombre Completo" class="{required:true} span3"></p>
			<p><label><b>Teléfono</b></label>
			<span></span>
			<input type="text" name="telefono" placeholder="Telefóno" class="{required:true,number:true,minlength:10,maxlength:10} span3"></p>
			<p><label><b>Dirección</b></label>
			<span></span>
			<input type="text" name="direccion" placeholder="Dirección" class="{required:true} span3"></p>
			<p><label><b>Contraseña (Mínimo 6 carácteres, máximo 10 carácteres)</b></label>
			<span></span>
			<input type="password" id="pass1" name="pass1" placeholder="Contraseña" class="{required:true,minlength:6,maxlength:10} span3"></p>
			<p><label><b>Confirmar contraseña</b></label>
			<span></span>		
			<input type="password" id="pass2" name="pass2" placeholder="Repetir contraseña" class="{required:true,minlength:6,maxlength:10} span3"></p>
			<p><label><b>Correo electrónico</b></label>
			<span></span>
			<input type="text" name="email" placeholder="Correo electrónico" class="{required:true,email:true} span3"></p>
			<p><input id="enviar" type="submit" value="Enviar"></p>
			<div id="loader" class="hide"><img src="assets/img/loader.gif" alt="loader"></div>
		</form>
	</div>
	<div id="editarUsuario" title="Editar usuario" style="width:500px;display: none;">
		<form id="editUsuarios" action="#" method="post">
			<p><label><b>Nombre</b></label>
			<span></span>
			<input type="text" id="editNombre" name="editNombre" placeholder="Nombre Completo" class="{required:true} span3"></p>
			<p><label><b>Teléfono</b></label>
			<span></span>
			<input type="text" id="editTelefono" name="editTelefono" placeholder="Telefóno" class="{required:true,number:true,minlength:10,maxlength:10} span3"></p>
			<p><label><b>Dirección</b></label>
			<span></span>
			<input type="text" id="editDireccion" name="editDireccion" placeholder="Dirección" class="{required:true} span3"></p>
			<p><input type="submit" id="editEnviar" value="Enviar"></p>
			<div id="eloader" class="hide"><img src="assets/img/loader.gif" alt="loader"></div>
		</form>
	</div>
	<div id="eliminarUsuario" title="Eliminar usuario" style="width:500px;display: none;">
		<p>¿Deseas eliminar la información de este usuario?</p>		
	</div>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="assets/js/jquery-validation/lib/jquery.metadata.js"></script>
	<script src="assets/js/jquery-validation/localization/messages_es.js"></script>
	<script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
	<script src="assets/js/script.js"></script>
</body>
</html>