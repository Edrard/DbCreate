<?php

header("Content-type: text/html; charset=utf-8");
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../vendor/autoload.php';

use edrard\DbCreate\DBNew;
use edrard\DbCreate\DBStaticNew;

$config = array(
    'driver'    => 'mysql', // Db driver
    'host'      => 'localhost',
    'database'  => 'test',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8', // Optional
    'collation' => 'utf8_unicode_ci', // Optional
    'prefix'    => '', // Table prefix, optional
);
$db = new DBNew($config);

$query = $db->table('regular_china_AT-SPG')->where('id','>','2000000')->get();

//dd($query);

//-------------------------------------------------------------//
//--------------Static------------------//

DBStaticNew::initDb($config,'Dbname');
$db = DBStaticNew::getDbConnection('Dbname');
$query = $db->table('regular_china_AT-SPG')->where('id','>','2000000')->get();

dd($query);