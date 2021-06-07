<?php
    
    /* ***************************************** */	
	#error_reporting(E_ALL);
    ini_set('display_errors', false);
    header("Access-Control-Allow-Origin: *");
    /* ***************************************** */
    date_default_timezone_set( 'America/Sao_Paulo' );
    /* ***************************************** */
    $servidor 	= 'localhost';									    
	$usuario 	= 'root';											
	$pass	 	= '';								        
	$bd 		= 'busca_endereco';
	/* ***************************************** */
	define('DB_HOST', "$servidor");
	define('DB_USER', "$usuario");
	define('DB_PASS', "$pass");
	define('DB_NAME', "$bd");
    /* ***************************************** */
    try {
	
        $con = new PDO("mysql:host=$servidor; dbname=$bd", "$usuario", "$pass");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->exec("set names utf8");
        $con->exec("set GLOBAL event_scheduler = ON");
	
	 } catch (PDOException $e) {
	   
		echo $e->getMessage();
		die();
	
	 }
     
?>