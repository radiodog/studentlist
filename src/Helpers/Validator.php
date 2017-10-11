<?php
namespace Student\Helpers;

class Validator
	{
		
		private	$name_pattern = "/^[А-ЯЁ]([а-яё]*)([ '-][А-ЯЁ]([а-яё]*))?/u";
		private	$surname_pattern = "/^[А-ЯЁ]([а-яё]*)([ '-][А-ЯЁ]([а-яё]*))?/u";
		private	$gender_pattern = "/male|female/";
		private	$groupNumber_pattern = "/([-а-яёА-ЯЁ0-9]+)/";
		private	$e_mail_pattern = "/\@/u";
		private	$score_pattern = "/([0-9])+/";
		private	$dob_pattern = "/^[1-2][90][78910][0-9][-][01][0-9][-][0-3][0-9]$/";
		private	$locality_pattern = "/resident|nonresident/";
		private	$digits_pattern = "/[0-9]+/";
		private $tag_pattern = "/[<>]+/";
		public $message = [];
		private $services;
		public function __construct($services)
		{
			$this->services = $services;
		}

		public function validate($form)
		{
			$message=[];
			$tag_pattern = $this->tag_pattern;
			$digits_pattern = $this->digits_pattern;
			$name_pattern = $this->name_pattern;
			$surname_pattern = $this->surname_pattern;
			$gender_pattern = $this->gender_pattern;
			$groupNumber_pattern = $this->groupNumber_pattern;
			$e_mail_pattern = $this->e_mail_pattern;
			$score_pattern = $this->score_pattern;
			$dob_pattern = $this->dob_pattern;
			$locality_pattern = $this->locality_pattern;

			//name validate	
			if ((mb_strlen($form['name'])==0)  OR ($form['name']=='Имя'))
			{
				$message['name'] = "Заполните строку имя";
			}
			elseif (preg_match($digits_pattern, $form['name'])==1) {
				$message['name'] = "Вы ввели цифры в поле имя, можно только буквы пробел и апостроф!";
			}
			elseif (preg_match($tag_pattern, $form['name'])==1) {
				$message['name'] = "Вы ввели недопустимые символы < или >, можно только буквы пробел и апостроф";
			}
			elseif (preg_match($name_pattern, $form['name'])==0) 
			{
				$message['name'] = "Имя должно быть не длиннее 40 символов и может содержать пробел, дефис и апостроф!";
			}
			elseif ((preg_match($name_pattern, $form['name'])==1)&(mb_strlen($form['name'])>40)) {
				$message['name'] = "Имя должно быть не длиннее 40-ка символов!";
			}
			elseif ((preg_match($name_pattern, $form['name'])==1)&(mb_strlen($form['name'])>40)) {
				$message['name'] = "Имя должно быть не длиннее 40-ка символов!";
			}
			elseif ((preg_match($name_pattern, $form['name'])==1) &(preg_match($tag_pattern, $form['name'])==0) &(preg_match($digits_pattern,$form['name'])==0) &(40>mb_strlen($form['name'])) & (mb_strlen($form['name'])>0)){
				$message['name'] = '';
			}
			//surname validate	
			if ((mb_strlen($form['surname'])==0) OR ($form['surname']=='Фамилия')){
				$message['surname'] = "Заполните строку фамилия";
			}
			elseif (preg_match($digits_pattern, $form['surname'])==1) {
				$message['surname'] = "Вы ввели цифры в поле фамилия, можно только буквы пробел и апостроф!";
			}
			elseif (preg_match($tag_pattern, $form['surname'])==1) {
				$message['surname'] = "Вы ввели недопустимые символы < или >, можно только буквы пробел и апостроф";
			}
			elseif (preg_match($name_pattern, $form['surname'])==0) {
				$message['surname'] = "Фамилия должна быть не длиннее 40 символов и может содержать пробел, дефис и апостроф!";
			}
			elseif ((preg_match($name_pattern, $form['surname'])==1)&(mb_strlen($form['surname'])>40)) {
				$message['surname'] = "Фамилия  должно быть не длиннее 40-ка символов!";
			}
			elseif ((preg_match($name_pattern, $form['surname'])==1)&(mb_strlen($form['surname'])>40)) {
				$message['surname'] = "Фамилия должно быть не длиннее 40-ка символов!";
			}
			elseif ((preg_match($name_pattern, $form['surname'])==1) & (40>mb_strlen($form['surname'])) & (mb_strlen($form['surname'])>0) &(preg_match($digits_pattern, $form['surname'])==0) & (preg_match($tag_pattern, $form['surname'])==0)) {
				$message['surname'] = '';
			}
			//validate gender
			if (preg_match($gender_pattern, $form['gender'])==0){
				$message['gender'] = "Укажите пол!";
			}	
			elseif (preg_match($gender_pattern, $form['gender'])==1){
				$message['gender'] = '';
			}
			//validate groupnumber
			if ((mb_strlen($form['groupnumber'])==0) OR ($form['groupnumber']=='Номер группы')){
				$message['groupnumber'] = "Введите Номер группы!";
			}
			elseif (mb_strlen($form['groupnumber'])<2){
				$message['groupnumber'] = "Номер группы должен быь длиннее двух символов!";
			}
			elseif (mb_strlen($form['groupnumber'])>5) {
				$message['groupnumber'] = "Номер группы должен быь короче пяти символов!";
			}
			elseif (preg_match($groupNumber_pattern, $form['groupnumber'])==0){
				$message['groupnumber'] = "Номер группы должен состоять из букв и цифр и может содержать дефис!";
			}
			elseif (preg_match($groupNumber_pattern, $form['groupnumber'])==1) {
				$message['groupnumber'] = '';
			}
			//validate e_mail
			if ((mb_strlen($form['e_mail'])==0) OR ($form['e_mail']=='user@host.ru')){
				$message['e_mail'] = "Введите адресс электронной почты!";
			}
			elseif (mb_strlen($form['e_mail'])>40){
				$message['e_mail'] = "Адресс электронной почты ограничен 40 символами!";
			}
			elseif (preg_match($e_mail_pattern, $form['e_mail'])==0){
				$message['e_mail'] = "Адресс электронной почты должен содержать символ @!";
			}
			elseif ($this->services['UserDataGateway']->checkEmailUnique($form['e_mail'])){
				$message['e_mail'] = "Данный емейл уже зарегистрирован!";
			}
			elseif ((40>mb_strlen($form['e_mail'])) & (mb_strlen($form['e_mail'])>3)& (preg_match($e_mail_pattern, $form['e_mail'])==1)){
				$message['e_mail'] = '';
			}
			//score validate
			
			if ($form['score']=='') {
				$message['score'] = "Введите количество баллов!";
			}
			elseif ($form['score']<30){
				$message['score'] = "Вы ввели слишком маленькое значение баллов за ЕГЭ!";
			}	
			elseif ($form['score']==30) {
				$message['score'] = "Введите количество баллов!";
			}
			elseif ($form['score']>300){
				$message['score'] = "Вы ввели слишком большое значение баллов за ЕГЭ!";
			}
			elseif (preg_match($score_pattern, $form['score'])==0){
				$message['score'] = "Вы ввели не число!";
			}
			elseif ((preg_match($score_pattern, $form['score'])==1) & (300>$form['score']) & ($form['score']>30)){
				$message['score'] = '';
			}
			//validate dob
			if ($form['dob']==""){
				$message['dob'] = "Введите дату рождения!";
			}
			elseif (preg_match($dob_pattern, $form['dob'])==1){
				$message['dob'] = '';
			}
			//validate locality
			if (preg_match($locality_pattern, $form['locality'])==0){
				$message['locality'] = "Выберите прописку!";
			}
			elseif (preg_match($locality_pattern, $form['locality'])==1){
				$message['locality'] = '';
			}
				return $message;
		}
		public function checkArr($message)
		{
			foreach ($message as $key => $value) {
				if ($value<>''){
					return false;
				}
			}
			return true;

		}	
	}
/**
* 
*/