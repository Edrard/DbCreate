<?php
namespace edrard\DbCreate;

use edrard\Log\MyLog;
use Pecee\Pixie\Connection;

class DBNew
{
    private $config = array();
    private $db_connect = FALSE;

    function __construct(array $config, $type = 'mysql'){
        MyLog::init();
        MyLog::info("Init. DB type ".$type.' with name '.$config['database'],array());
        $connection = new Connection($type, $config);
        try{
            $this->db_connect = $connection->getQueryBuilder();
        }Catch(\Exception $e){
            MyLog::critical("[".get_class($this)."] Can't connect to Database");
            die($e->getMessage());
        }
    }
    function getDbConnect(){
        return $this->db_connect;
    }
    function __invoke(){
        return $this->getDbConnect();
    }
    function __call($name, $arguments){
        return call_user_func_array(array($this->getDbConnect(),$name),$arguments);
    }
}
