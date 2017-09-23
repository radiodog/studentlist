<?php
namespace Student\Classes;

/**
* 
*/
class Pager
{
	public $totalPages;
	public $recordsPerPage;
	public function __construct($totalRecords, $recordsPerPage)
	{
		$this->totalRecords = $totalRecords;
		$this->recordsPerPage = $recordsPerPage;
	}
	
	public function getTotalPages()
	{
		if (($this->totalRecords % $this->recordsPerPage) > 0){
			$pages = 1;
		}
		elseif (($this->totalRecords % $this->recordsPerPage) == 0){
			$pages = 0;
		}
	$pages = $pages + (($this->totalRecords -($this->totalRecords % $this->recordsPerPage)) / $this->recordsPerPage);
	return $pages;
	}
}