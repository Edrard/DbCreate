<?php
namespace edrard\DbCreate;

use edrard\Log\MyLog;
use Pixie\Connection;

class DBStatic
{
    protected static $dbs = array();
    protected static $logInit = false;

    public static function initDb(array $config,$name, $type = 'mysql'){
        static::logInit();
        MyLog::info("Init Static. DB type ".$type.' with name '.$name,array());
        $connection = new \Pixie\Connection($type, $config);
        static::$dbs[$name] = new \Pixie\QueryBuilder\QueryBuilderHandler($connection);
    }
    public static function getDbConnection($type){
        static::logInit();
        return static::$dbs[$type];
    }
    protected static function logInit(){
        if($logInit === false){
            MyLog::init();
            static::$logInit = true;
        }
    }
}