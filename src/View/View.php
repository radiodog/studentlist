<?php
	namespace Student\View;
	/**
	* 
	*/
	class View
	{
		public $services;

		public $header;
		public $button;

		public $placeholders;
		public $classes;
		public $errors;
		public $values;

		public $listData;
		public $request;

		function __construct($services)
		{
			$this->services = $services;
		}

		public function renderForm()
		{
			include('Parts/Header.php');
			include('Parts/Form.php');
			include('Parts/Footer.php');
		}

		public function renderList($totalPages)
		{
			$request = $this->request;
			$linkPrev = $this->createPrev($request);
			$linkNext = $this->createNext($request);
			$totalPages = $totalPages;
			include('Parts/Header.php');
			include('Parts/List.php');
			include('Parts/Footer.php');
		}

		public function renderSuccess($message)
		{
			$successMessage = $message;
			include('Parts/Success.php');	
		}

		public function emptyErrorsForm()
		{
			return $this->emptyClassesForm();
		}

		public function emptyClassesForm()
		{
			$class['name'] = '';
	        $class['surname'] = "";
    	    $class['gender'] = "";
       	    $class['groupnumber'] = "";
        	$class['e_mail'] = "";
        	$class['score'] = "";
        	$class['dob'] = "";
        	$class['locality'] = "";
        	return $class;
		}

		public function emptyPlaceholdersForm()
		{
			$placeholder['name'] = "Имя";
        	$placeholder['surname'] = "Фамилия";
            $placeholder['gender'] = "Пол";
        	$placeholder['groupnumber'] = "Номер группы";
        	$placeholder['e_mail'] = "user@host.ru";
        	$placeholder['score'] = "Суммарное число баллов ЕГЭ";
        	$placeholder['dob'] = "Дата рождения";
        	$placeholder['locality'] = "Прописка";
        	return $placeholder;
		}

		public function PrepareForm()
		{
			$this->errors = $this->emptyErrorsForm();
			$this->classes = $this->emptyClassesForm();
			$this->placeholders = $this->emptyPlaceholdersForm();
		}

		public function setRequest($request)
		{
			$this->request = $request;
		}
		public function setHeader($header)
		{
			$this->header = $header;
		}

		public function setButton($button)
		{
			$this->button = $button;
		}

		public function setValues($values)
		{
			$this->values = $values;
		}

		public function setErrors($errors)
		{
			$this->errors = $errors;
		}

		public function setClasses($classes)
		{
			$this->classes = $classes;
		}

		public function getMarks($errors)
		{
			$classes = $this->emptyClassesForm();

        	foreach ($errors as $key => $value) {
	            if ($value<>''){
    	            $classes[$key]= "is-invalid";
       		    }
            	else {
                	$classes[$key] = "is-valid";
            	}
			}
        	$this->setClasses($classes);
		}

		public function getListData($data)
		{
			$this->listData = $data;
		}

    	public function createUrlforPager($request,$num)
    	{
    		return $link = "?num=".urlencode($num)."&search=".urlencode($request['search'])."&sort=".urlencode($request['sort'])."&order=".urlencode($request['order']);
    	}

		public function setClassForPrev()
    	{
    		$request = $this->request;
    		if ($request['offset']==1){
    			return "disabled";
    		}
    		else{
    			return '';
    		}
    	}
    	public function createPrev($request)
    	{
    		return $link = "?num=".urlencode($request['offset']-1)."&search=".urlencode($request['search'])."&sort=".urlencode($request['sort'])."&order=".urlencode($request['order']);
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

    	public function createNext($request)
    	{
    		return $link = "?num=".urlencode($request['offset']+1)."&search=".urlencode($request['search'])."&sort=".urlencode($request['sort'])."&order=".urlencode($request['order']);	
    	}
	}