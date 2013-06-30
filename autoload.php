<?php
/**
* autoload Ace lib classes
*/
spl_autoload_register(function ($class) {
	$name = str_replace('\\', '/', $class);

	$class_file = dirname(__FILE__). '/lib/' . $name . '.php';
	if (is_readable($class_file)){
		include $class_file;
	}
});
