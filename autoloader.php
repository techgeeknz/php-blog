<?php
namespace App;

spl_autoload_register(function ($class) {
	// Adapted from <https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader-examples.md>

	$prj_basedir = __DIR__;

	$app_prefix = 'App\\';
	$app_basedir = $prj_basedir . '/app/';
	$lib_basedir = $prj_basedir . '/lib/';

	$app_prefix_len = strlen($app_prefix);
	if (strncmp($app_prefix, $class, $app_prefix_len) == 0) {
		// Class belongs to local namespace
		$basedir = $app_basedir;
		$rel_class = substr($class, $app_prefix_len);
	}
	else {
		// Class maybe belongs to app-local library
		$basedir = $lib_basedir;
		$rel_class = $class;
	}
	$file = $basedir . str_replace('\\', '/', $rel_class) . '.php';
	if (file_exists($file)) {
		require $file;
	}
	else {
		// Try the next autoloader
		return;
	}
});