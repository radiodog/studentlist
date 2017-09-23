<?php
namespace Student\Classes;

use \PDO;

class UserDataGateway
{
	private $dbn;
	public $data;

	public function __construct(PDO $dbn)
	{
		$this->data = [];
		$this->dbn = $dbn;
	}
	
	public function getAll()
	{
		return $row = $this->dbn->query('SELECT * from student ORDER BY score');
	}

	public function returnResult($row)
	{
		$this->data = [];
		while ($result= $row->fetch(PDO::FETCH_ASSOC)) {
			$this->data[] =  new Student($result['name'],$result['surname'],$result['gender'],$result['groupnumber'],$result['e_mail'],$result['score'],$result['dob'],$result['locality'],$result['id']);
		}
		return $this;
	}

	public function GetTen($index){
		
		return $stmt = $this->dbn->query("SELECT * FROM student ORDER BY score LIMIT 10 OFFSET $index");
	}

	public function makeSearchSortOrder($request)
	{
		$search = $request['search'];
		$sort = $request['sort'];
		$order = $request['order'];
		$offset = ($request['offset']-1)*10;
		if ($search <> ''){
			$stmt = $this->dbn->prepare("SELECT * FROM student WHERE name LIKE :search OR surname LIKE :search OR groupnumber LIKE :search ORDER BY $sort $order LIMIT 10 OFFSET $offset");
			$stmt->bindValue(':search',$search);
			$search = "%" . $search . "%";
			$stmt->execute();
		}
		elseif ($search == ''){
			$stmt = $this->dbn->prepare("SELECT * FROM student ORDER BY $sort $order LIMIT 10 OFFSET $offset");
			$stmt->execute();
		}
		return $stmt;	
	}

	public function addStudent(Student $student, $hash)
	{
		$name = $student->getName();
		$surname = $student->getSurname();
		$gender = $student->getGender();
		$groupnumber = $student->getGroupNumber();
		$e_mail = $student->getEmail();
		$score = $student->getScore();
		$dob = $student->getDob();
		$locality = $student->getLocality();
		$id = $student->getId();
		
		$stmt = $this->dbn->prepare("INSERT INTO student VALUES(:name,:surname,:gender,:groupnumber,:e_mail,:score,:dob,:locality,:id,:hash)");
		$stmt->bindValue(':name', $name);
		$stmt->bindValue(':surname', $surname);
		$stmt->bindValue(':gender', $gender);
		$stmt->bindValue(':groupnumber', $groupnumber);
		$stmt->bindValue(':e_mail', $e_mail);
		$stmt->bindValue(':score', $score);
		$stmt->bindValue(':dob', $dob);
		$stmt->bindValue(':locality', $locality);
		$stmt->bindValue(':id', $id);
		$stmt->bindValue(':hash', $hash);
    	$stmt->execute();
	}

	public function rewriteStudent(Student $student, $hash)
	{
		$name = $student->getName();
		$surname = $student->getSurname();
		$gender = $student->getGender();
		$groupnumber = $student->getGroupNumber();
		$e_mail = $student->getEmail();
		$score = $student->getScore();
		$dob = $student->getDob();
		$locality = $student->getLocality();
		
		$stmt = $this->dbn->prepare("UPDATE student SET
			name = :name,
			surname = :surname,
			gender = :gender,
			groupnumber = :groupnumber,
			e_mail = :e_mail,
			score = :score,
			dob = :dob,
			locality = :locality
			WHERE hash =:hash");
		$stmt->bindValue(':name', $name);
		$stmt->bindValue(':surname', $surname);
		$stmt->bindValue(':gender', $gender);
		$stmt->bindValue(':groupnumber', $groupnumber);
		$stmt->bindValue(':e_mail', $e_mail);
		$stmt->bindValue(':score', $score);
		$stmt->bindValue(':dob', $dob);
		$stmt->bindValue(':locality', $locality);
		$stmt->bindValue(':hash', $hash);
    	$stmt->execute();
	}

	public function getByHash($hash)
	{
		$stmt = $this->dbn->prepare("SELECT * FROM student WHERE hash=?");
		$stmt->execute(array($hash));
		return $result = $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function checkEmailUnique($e_mail)
	{
		$stmt = $this->dbn->prepare("SELECT name FROM student WHERE e_mail=?");
		$stmt->execute(array($e_mail));
		if ($stmt->fetchColumn()){
			return false;
		}
		else{
			return true;
		}
	}
	
	public function getCount()
	{
		$stmt = $this->dbn->prepare("SELECT COUNT(id) FROM student");
		$stmt->execute();
		$result = $stmt->fetch();
		return $result['count'];
	}
}