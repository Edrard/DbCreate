<?php

header("Content-type: text/html; charset=utf-8");
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../vendor/autoload.php';

use edrard\DbCreate\DB;
use edrard\DbCreate\DBStatic;

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
$db = new DB($config);

$query = $db->table('regular_china_AT-SPG')->where('id','>','2000000')->get();

//dd($query);

//-------------------------------------------------------------//
//--------------Static------------------//

DBStatic::initDb($config,'Dbname');
$db = DBStatic::getDbConnection('Dbname');
$query = $db->table('regular_china_AT-SPG')->where('id','>','2000000')->get();

dd($query);