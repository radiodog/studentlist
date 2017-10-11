<?php
	namespace Student\Controllers;

	use Student\Helpers\Utils;
	use Student\Helpers\Pager;
/**
* 
*/
class ListController
{
	private $services;
	
	function __construct($services)
	{
		$this->services = $services;
	}

	public function sort()
	{
		$request = $this->getValuesFromGet();
		$this->services['View']->setRequest($request);
		$this->services['UserDataGateway']->makeSearchSortOrder($request);
		$pager = new Pager($this->services['UserDataGateway']->countRequest($request),10);
	    $totalPages = $pager->getTotalPages();
		$this->services['View']->renderList($totalPages);
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

    public function trimArray($arr)
    {
    	foreach ($arr as $key => $value) {
    		$value = trim($value);
    	}
    	return $arr;
    }
}