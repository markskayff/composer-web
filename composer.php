<?php
error_reporting('E_ALL');
ini_set("display_errors", true);

if(!isset($_GET['action'])){
	echo "Can't find action param";
	exit;
}

if(!isset($_GET['action']) || !in_array($_GET['action'], array('install', 'require'))){
	die("Invalid action commands");
}

$action = trim($_GET['action']);

// ----------------------------------------------------------------------------------------
// This is a composer.phar requirement
// ----------------------------------------------------------------------------------------
putenv("HOME=" . dirname(__FILE__));

switch ($action) {
	case 'install':
		// ----------------------------------------------------------------------------------------
		// Run composer install
		// ----------------------------------------------------------------------------------------
		exec("php composer.phar install");
		break;

	case 'require':
		if(!isset($_GET['repo'])){
			die("El comando repo requiere un valor de repositorio valido");
		}

		$repo = $_GET['repo'];
		exec("php composer.phar require {$repo} 2>&1", $output);
		// ----------------------------------------------------------------------------------------
		// Test output
		// ----------------------------------------------------------------------------------------
		//$output = shell_exec('php composer.phar list 2>&1');
		//print $output;
		
		// ----------------------------------------------------------------------------------------
		// Output the result
		// ----------------------------------------------------------------------------------------
		foreach ($output as $o) {
			print $o . "<br>";
		}
		break;
	
	default:
		# code...
		break;
}


