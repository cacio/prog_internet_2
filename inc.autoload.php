<?php
	date_default_timezone_set('America/Sao_Paulo');
		
	spl_autoload_register(function($class_name) {
		require('class.'.$class_name.'.php');
	});

?>