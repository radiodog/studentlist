<?php
namespace Student\Classes;
use \PDO;

/**
* 
*/
class Controller 
{	
	public $dataGateway;
	public $hashUser;
	function __construct()
	{
		$dbn = $this->createPDO();
		$this->dataGateway = new UserDataGateway($dbn); 
		$this->hashUser = $this->getCookie();
	}
	private function createPDO()
	{
		require "../src/configdb.php";
		try
		{
        $dbn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname; user=$user; password=$password");
    	}
		catch (PDOException $e)
 		{
    	echo $e->getMessage();
    	}
    	return $dbn;
	}
	public function getCookie()
    {
        return $hash = array_key_exists('hash', $_COOKIE) ? trim(strval($_COOKIE['hash'])) : '';
    }
}