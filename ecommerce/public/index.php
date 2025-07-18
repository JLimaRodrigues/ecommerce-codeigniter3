<?php

$system_path = '../ci/system/';
$application_folder = '../ci/application/';

define('BASEPATH', str_replace("\\", "/", $system_path));
define('APPPATH', str_replace("\\", "/", $application_folder . '/'));
define('VIEWPATH', APPPATH . 'views/');
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');

require_once BASEPATH . '/core/CodeIgniter.php';