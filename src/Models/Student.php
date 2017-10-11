<?php
namespace Student\Models;

class Student
	{
		private $name;
		private $surname;
		private $gender;
		private $groupnumber;
		private $e_mail;
		private $score;
		private $dob;
		private $locality;
		private $id;

		public function __construct($name,$surname,$gender,$groupnumber,$e_mail,$score,$dob,$locality)
		{
			$this ->name = $name;
			$this ->surname = $surname;
			$this ->gender = $gender;
			$this ->groupnumber = $groupnumber;
			$this ->e_mail = $e_mail;
			$this ->score = $score;
			$this ->dob = $dob;
			$this ->locality = $locality;
		}
		public function getName(){
			return $this->name;
		}
		public function setName($name){
			$this->name = $name;
		}
		public function getSurname(){
			return $this->surname;
		}
		public function setSurname($surname){
			$this->surname=$surname;
		}
		public function getGender(){
			return $this->gender;
		}
		public function setGender($gender){
			$this->gender = $gender;
		}
		public function getGroupNumber(){
			return $this->groupnumber;
		}
		public function setGroupNumber($groupnumber){
			$this->groupnumber = $groupnumber;
		}
		public function getEmail(){
			return $this->e_mail;
		}
		public function setEmail($e_mail){
			$this->e_mail = $e_mail;
		}
		public function getScore(){
			return $this->score;
		}
		public function setScore($score){
			$this->score = $score;
		}
		public function getDob(){
			return $this->dob;
		}
		public function setDob($dob){
			$this->dob = $dob;
		}
		public function getLocality(){
			return $this->locality;
		}
		public function setLocality($locality){
			$this->locality = $locality;
		}
		public function getId(){
			return $this->id;
		}
		public function setId($id){
			$this->id = $id;
		}
	}
/**
* 
*/