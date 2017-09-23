<?php
namespace Student\Classes;

use \PDO;

/**
* 
*/
class PageController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function sort()
	{
		$thisStudent = '';
		$pager = new Pager($this->dataGateway->getCount(),10);
		$totalPages = $pager->getTotalPages();

		if ($_SERVER['REQUEST_METHOD']=="GET"){
			$request = $this->getValuesFromGet();
			$linkPrev = $this->createPrev($request);
			$linkNext = $this->createNext($request);
			$rows = $this->dataGateway->makeSearchSortOrder($request);
			$this->dataGateway->returnResult($rows);
		}
		include("../src/View/List.php");
	}

    public function getValuesFromGet()
    {
    	$searchPattern = "/([-а-яёА-ЯЁ0-9])/ui";
    	$sortPattern = "/^(name|surname|points|groupnumber)$/ui";
    	$orderPattern = "/^(ASC|DESC)$/ui";
    	$numPattern = "/(0-9)*/ui";
    	$request = [];
    	$request['search'] = array_key_exists('search', $_GET) ? trim(strval($_GET['search'])) : '';
    	$request['sort'] = array_key_exists('sort', $_GET) ? trim(strval($_GET['sort'])) : 'score';
    	$request['sort'] = (preg_match($sortPattern,$request['sort'])) ? $request['sort'] : 'score';
    	$request['order'] = array_key_exists('order', $_GET) ? trim(strval($_GET['order'])) : 'DESC';
    	$request['order'] = (preg_match($orderPattern, $request['order'])) ? $request['order'] : 'DESC';
    	$request['offset'] = array_key_exists('num', $_GET) ? trim(strval($_GET['num'])) : 1;
    	$request['offset'] = preg_match($numPattern, $request['offset']) ? $request['offset'] : 1;
    	return $request;
    }
    
    public function createNext($request)
    {
    	return $link = "?num=".urlencode($request['offset']+1)."&search=".urlencode($request['search'])."&sort=".urlencode($request['sort'])."&order=".urlencode($request['order']);	
    }

    public function createPrev($request)
    {
    	return $link = "?num=".urlencode($request['offset']-1)."&search=".urlencode($request['search'])."&sort=".urlencode($request['sort'])."&order=".urlencode($request['order']);
    }

    public function setClassForPrev($request)
    {
    	if ($request['offset']==1){
    		return "disabled";
    	}
    	else{
    		return '';
    	}
    }

    public function setClassForNext($request,$totalPages)
    {
    	if ($request['offset']==$totalPages){
    		return "disabled";
    	}
    	else{
    		return '';
    	}

    }

    public function createUrlforPager($request,$num)
    {
    	return $link = "?num=".urlencode($num)."&search=".urlencode($request['search'])."&sort=".urlencode($request['sort'])."&order=".urlencode($request['order']);
    }
}