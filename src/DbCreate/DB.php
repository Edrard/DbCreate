<?php
namespace edrard\DbCreate;

use edrard\Log\MyLog;
use Pixie\Connection;
use Pixie\QueryBuilder\QueryBuilderHandler;
use edrard\Atm\Exception\CriticalAtmException;

class DB
{
    private $config = array();
    private $db_connect = FALSE;

    function __construct(array $config){
        MyLog::init();
        $connection = new Connection('mysql', $config);
        try{
            $this->db_connect = new QueryBuilderHandler($connection);
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
