<?php 
spl_autoload_register(function($file)
{
		$route=__DIR__.DS.$file.'.php';
		// print_r($route);
		if (is_readable($route)) 
		{
			require $route;	
		}
});