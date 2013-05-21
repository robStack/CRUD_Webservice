<?php
	require_once('conexion.class.php');
	$id = $_POST['id'];
	$crud = new conexionMysql();
	echo json_encode($crud -> delete($id));
?>