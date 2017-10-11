<?php
	namespace Student\Helpers;

	use \PDO;
/**
* 
*/
class Utils
{
	
	function __construct()
	{
		echo "this is Utils";
	}

	public static function getCookie()
	{
		if ( isset($_COOKIE) ) {
			return $_COOKIE['hash'];
		}
		else {
			return '';
		}
	}

	public static function isCookieSet()
	{
		if ( isset($_COOKIE) ) {
			return true;
		}
		else {
			return false;	
		} 
	}

	public static function genRandString20()
	{
		$chars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+/';
		$str = '';
		$keysize = strlen($chars) -1;
		for ($i = 0; $i < 20; ++$i) {
			$str .= $chars[random_int(0, $keysize)];
		}
		return $str;
    }

    public static function createPDO()
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

    public static function isArrEmpty($arr)
    {
    	foreach ($arr as $key => $value) {
            if ($value<>''){
                return false;
            }
        }
        return true;
    }
}
