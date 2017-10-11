<?php
namespace Student\Helpers;

/**
* 
*/
class Pager
{
	public $totalRecords;
	public $recordsPerPage;
	public function __construct($totalRecords, $recordsPerPage)
	{
		$this->totalRecords = $totalRecords;
		$this->recordsPerPage = $recordsPerPage;
	}
	
	public function getTotalPages()
	{
		if ($this->totalRecords < $this->recordsPerPage) {
			return 1;
		}
		elseif ($this->totalRecords == $this->recordsPerPage) {
			return 1;
		}
		elseif ($this->totalRecords > $this->recordsPerPage) {
			return ($this->totalRecords - ($this->totalRecords % $this->recordsPerPage)) / $this->recordsPerPage +1;
		}	
	}
}