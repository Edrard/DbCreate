<?php
namespace edrard\DbCreate;

use edrard\Log\MyLog;
use Pecee\Pixie\Connection;

class DBStaticNew
{
    protected static $dbs = array();
    protected static $logInit = false;

    public static function initDb(array $config,$name = 'default', $type = 'mysql'){
        static::logInit();
        MyLog::info("Init Static. DB type ".$type.' with name '.$name,array());
        $connection = new Connection($type, $config);
        static::$dbs[$name] = $connection->getQueryBuilder();
    }
    public static function getDbConnection($name = 'default'){
        static::logInit();
        return static::$dbs[$name];
    }
    protected static function logInit(){
        if($logInit === false){
            MyLog::init();
            static::$logInit = true;
        }
    }
}