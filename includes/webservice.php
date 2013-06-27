<?php
	require_once('conexion.class.php');
	require_once("lib/nusoap.php");	

	$namespace = "http://localhost/webservice/includes/webservice.php";

	$server = new soap_server();
	$server->configureWSDL("simpleService");
	$server->soap_defencoding = 'utf-8';
	$server->wsdl->schemaTargetNamespace = $namespace;
	$server->wsdl->addComplexType(
        					'createComplex', 
        					'complexType',
        					'struct',
        					'all',
        					'',
        					array(
        						'nombre' => array('name' => 'nombre','type' => 'xsd:string'),
        						'telefono' => array('name' => 'telefono','type' => 'xsd:string'),
        						'direccion' => array('name' => 'direccion','type' => 'xsd:string'),
        						'email' => array('name' => 'email','type' => 'xsd:string')));
	$server->wsdl->addComplexType(
        					'udpateComplex', 
        					'complexType',
        					'struct',
        					'all',
        					'',
        					array(
        						'id' => array('name' => 'id','type' => 'xsd:int'),
        						'nombre' => array('name' => 'nombre','type' => 'xsd:string'),
        						'telefono' => array('name' => 'telefono','type' => 'xsd:string'),
        						'direccion' => array('name' => 'direccion','type' => 'xsd:string')));
	$server->register("conexionMysql.create",
						array('datos' => 'tns:createComplex'),
						array('return'=>'xsd:string'),
						$namespace,
						true,
						'rpc',
						'encoded',
						'Insert record in table'
						);
	$server->register("conexionMysql.read",
						array(),
						array('return'=>'xsd:string'),
						$namespace,
						false,
						'rpc',
						'encoded',
						'Return content from table Usuarios_datos');
	$server->register("conexionMysql.update",
						array('datos' => 'tns:updateComplex'),
						array('return'=>'xsd:string'),
						$namespace,
						false,
						'rpc',
						'encoded',
						'Update selected record');
	$server->register("conexionMysql.delete",
						array('id' => 'xsd:int'),
						array('return'=>'xsd:string'),
						$namespace,
						false,
						'rpc',
						'encoded',
						'Delete selected record');	
	$POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
	$server->service($POST_DATA);   
	exit();
?>