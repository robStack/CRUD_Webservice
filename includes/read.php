<?php
	require_once('conexion.class.php');
	$function = $_GET['fn'];
	$crud = new conexionMysql();
	switch ($function) {
		case 'read':
			$read = $crud -> read();
			break;
		
		case 'read_data':
			$id = $_GET['id'];
			$read = $crud -> read_data($id);
			break;
	}	
	echo json_encode($read);
?>