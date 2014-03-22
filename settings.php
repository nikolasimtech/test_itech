<?php

// Show only critical errors.
ini_set("display_errors","1");
if (version_compare(phpversion(), "5.0.0", ">")==1) {
	ini_set("error_reporting", E_ALL | E_STRICT);
	//ini_set("error_reporting", E_ERROR | E_STRICT);
} else {
	ini_set("error_reporting", E_ALL);
	//ini_set("error_reporting", E_ERROR);
};

$config['db_host'] = 'localhost';
$config['db_name'] = 'itech_test_nikolaychenko_autocreate';
$config['db_user'] = 'root';
$config['db_password'] = '1111';
$config['db_type'] = 'mysql';


define('ADMIN_PASSWORD', 'admin');
define('ADMIN_LOGIN', 'admin');