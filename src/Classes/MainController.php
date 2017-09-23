<?php
namespace Student\Classes;

use \PDO;

class MainController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function register()
    {
        $placeholder=$this->prepareFormPlaceholders();
        $values=$this->prepareFormClasses();
        $errors=$this->prepareFormClasses();
        $header = "Регистрация!";
        $button = "Зарегистрироваться";

        if ($this->getCookie()<>''){
            $header = "Редактирование данных";
            $button = "сохранить";
            $this->hashUser = $this->getCookie();
            $values = $this->dataGateway->getByHash($this->hashUser);
        }
        if ($_SERVER['REQUEST_METHOD']=="POST"){
            $values=$this->getValuesFromPost();
            $errors=$this->validateValues($values,$this->dataGateway);

            if ($this->getCookie()<>''){
                $valuesFromDB = $this->dataGateway->getByHash($this->hashUser);

                if ($values['e_mail']==$valuesFromDB['e_mail']) {
                   $errors['e_mail'] ='';
                }
            }
            $class = $this->getMarks($errors);
            
            if ($this->emptyArr($errors) &($this->getCookie()<>'')){
                $student = $this->createStudent($values);
                $this->dataGateway->rewriteStudent($student,$this->hashUser);
                $successMessage = "Поздравляю вы успешно отредактировали данные!";
                include("../src/View/Success.php");
            }
            elseif ($this->emptyArr($errors) & ($this->getCookie()=='')){
                $this->createHash();
                $this->createCookie($this->hashUser);
                $student = $this->createStudent($values);
                $student->setId($this->dataGateway->getCount()+1);
                $this->dataGateway->addStudent($student,$this->hashUser);
                $successMessage = "Поздравляю вы успешно Зарегистрировались!";
                include("../src/View/Success.php");
            }
        }    
        include("../src/View/Form.php");
    }

    //Функция заполняет значения placeholder в форме
    public function prepareFormPlaceholders()
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
    //Функция создает пустой массив для хранения ошибок и хранения меток-классов для формы
    public function prepareFormClasses()
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

    public function validateValues($values,$dataGateway)
    {
        $validator = new Validator();
        $validator->validate($values,$dataGateway);
        $message = $validator->message;
        return $message;
    }

    public function emptyArr($errors)
    {
        foreach ($errors as $key => $value) {
                if ($value<>''){
                    return false;
                }
            }
            return true;
    }

    public function getMarks($placeholder)
    {
        $class = $this->prepareFormClasses();
        foreach ($placeholder as $key => $value) {
            if ($value<>''){
                $class[$key]= "is-invalid";
            }
            else {
                $class[$key] = "is-valid";
            }
        }
        return $class;
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

	private function genRandString($length)
	{
		$chars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+/';
		$str = '';
		$keysize = strlen($chars) -1;
		for ($i = 0; $i < $length; ++$i) {
			$str .= $chars[random_int(0, $keysize)];
		}
		return $str;
    }

    private function createHash()
    {
        $this->hashUser = $this->genRandString(20);
    }
}