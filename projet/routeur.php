<?php
	require_once("controller/handler.php");

	session_start();
	$action = "Recettes";

	if (isset($_GET["action"]) && in_array($_GET["action"],get_class_methods("handler")))
	{
		$action = $_GET["action"];
	}
	if (isset($_POST["action"]) && in_array($_POST["action"],get_class_methods("handler")))
	{
		$action = $_POST["action"];
	};
	if(isset($_GET["id"])){
		handler::$action($_GET["id"]);
	}else{
		handler::$action();
	}
	
?>