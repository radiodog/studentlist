<?php
	namespace Student\Controllers;

	use Student\Helpers\Utils;
	use Student\Helpers\Validator;
	use Student\Models\Student;
/**
* 
*/
class FormController
{
	private $services;

	function __construct($services)
	{
		$this->services = $services;
	}

	public function register()
	{
        $this->services['View']->PrepareForm();
        $this->services['View']->setHeader('Регистрация!');
        $this->services['View']->setButton('Зарегистрироваться');

        if (Utils::isCookieSet()){
            $this->services['View']->setHeader('Редактирование данных');
            $this->services['View']->setButton('сохранить');
            $this->services['View']->setValues($this->services['UserDataGateway']->getByHash(Utils::getCookie()));
            $this->services['View']->getMarks($this->services['View']->errors);
        }
        
        if ($_SERVER['REQUEST_METHOD']=="POST"){
            $this->services['View']->setValues($this->getValuesFromPost());
            $this->services['View']->setErrors($this->validateValues($this->services['View']->values));

            if (Utils::getCookie()<>''){
                $valuesFromDB = $this->services["UserDataGateway"]->getByHash(Utils::getCookie());
                if ($this->services['View']->values['e_mail']==$valuesFromDB['e_mail']) {
                   $this->services['View']->errors['e_mail'] ='';
                }
            }

            $this->services['View']->getMarks($this->services['View']->errors);
            
            if (Utils::isArrEmpty($this->services['View']->errors) & (Utils::getCookie()<>'')) {
                $student = $this->createStudent($this->services['View']->values);
                $this->services['UserDataGateway']->rewriteStudent($student,Utils::getCookie());
                header('Location: /index.php?edited', true, 302);
            }
            elseif (Utils::isArrEmpty($this->services['View']->errors) & (Utils::getCookie()=='')){
                $this->createCookie(Utils::genRandString20());
                $student = $this->createStudent($values);
                $this->services['UserDataGateway']->addStudent($student,Utils::getCookie());
                header('Location: /index.php?registred', true, 302);
            }
        }
        $this->services['View']->renderForm();
        if ($this->isSuccess()) {
            $this->services['View']->renderSuccess($this->getSuccessMessage());
        }
    }

    //Функция создает массив значений из переменной POST
    public function getValuesFromPost()
    {
        $form =[];
        $form['name'] = array_key_exists('name', $_POST) ? trim(strval($_POST['name'])) : '';
        $form['surname'] = array_key_exists('surname', $_POST) ? trim(strval($_POST['surname'])) : '';
        $form['gender'] = array_key_exists('gender', $_POST) ? trim(strval($_POST['gender'])) : '';
        $form['groupnumber'] = array_key_exists('groupnumber', $_POST) ? strtolower(trim(strval($_POST['groupnumber']))) : '';
        $form['e_mail'] = array_key_exists('e_mail', $_POST) ? strtolower(trim(strval($_POST['e_mail']))) : '';
        $form['score'] = array_key_exists('score', $_POST) ? trim(strval($_POST['score'])) : '';
        $form['dob'] = array_key_exists('dob', $_POST) ? trim(strval($_POST['dob'])) : '';
        $form['locality'] = array_key_exists('locality', $_POST) ? trim(strval($_POST['locality'])) : '';
        return $form;
    }

    public function validateValues($values)
    {
    	return $this->services['Validator']->validate($values);
    }

	public function createStudent($values)
    {
        $student = new Student($values['name'],$values['surname'],$values['gender'],$values['groupnumber'],$values['e_mail'],$values['score'],$values['dob'],$values['locality']);
        return $student;
	}

    public function createCookie($hash)
    {
        setcookie('hash',$hash,time()+3600*12*365,'/',null,false,true);
    }

    public function isSuccess()
    {
        if (preg_match('/^(registred|edited)$/', $_SERVER['QUERY_STRING'])) {
            return true;
        }
        else {
            return false;
        }
    }

    public function getSuccessMessage()
    {
        if (preg_match('/^(registred)$/', $_SERVER['QUERY_STRING'])) {
            return "Поздравляю вы успешно Зарегистрировались!";
        }

        elseif (preg_match('/^(edited)$/', $_SERVER['QUERY_STRING'])) {
            return "Поздравляю вы успешно отредактировали данные!";

        }
    }
}