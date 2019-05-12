<?php 

//a spl autoload irá receber os métodos da classe e deixar a disposiçao qdo requisitadas
spl_autoload_register(function($class_name){

	$filename = "Class".DIRECTORY_SEPARATOR.$class_name.".php";

	if (file_exists(($filename))){

		require_once ($filename);

	}

});


?>