<?php
namespace Student\Models;

use \PDO;
use Student\Models\Student;

class UserDataGateway
{
	private $dbn;
	public $data;

	public function __construct($dbn)
	{
		$this->dbn = $dbn;
	} 

	public function createPdo()
	{
		require "../src/configdb.php";

		try {
        $dbn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname; user=$user; password=$password");
    	}

		catch (PDOException $e) {
    	echo $e->getMessage();
    	}

    	return $dbn;
	}

	public function makeSearchSortOrder($request)
	{
		$search = $request['search'];
		$sort = $request['sort'];
		$order = $request['order'];
		$offset = ($request['offset']-1)*10;
		if ($search <> '') {
			$sql =  "SELECT * FROM student WHERE name LIKE :search OR surname LIKE :search OR groupnumber LIKE :search ORDER BY ".$sort." ".$order."  LIMIT 10 OFFSET :offset";
			$stmt = $this->dbn->prepare($sql);
			$stmt->bindValue(':offset',$offset,PDO::PARAM_INT);	
			$search = "%" . $search . "%";
			$stmt->bindValue(':search',$search,PDO::PARAM_STR);
			$stmt->execute();
		}
		elseif ($search == '') {
			$sql = "SELECT * FROM student ORDER BY ".$sort." ".$order." LIMIT 10 OFFSET :offset";
			$stmt = $this->dbn->prepare($sql);
			
			$stmt->bindValue(':offset',$offset,PDO::PARAM_INT);	
			$stmt->execute();
		}
		$this->data = [];
		while ( $result= $stmt->fetch(PDO::FETCH_ASSOC) ) {
			$this->data[] =  new Student($result['name'],$result['surname'],$result['gender'],$result['groupnumber'],$result['e_mail'],$result['score'],$result['dob'],$result['locality'],$result['id']);
		}
		return $this;	
	}


	public function countRequest($request)
	{
		$search = $request['search'];
		if ($search <> ''){
			$sql =  "SELECT * FROM student WHERE name LIKE :search OR surname LIKE :search OR groupnumber LIKE :search ORDER BY";
			$stmt = $this->dbn->prepare($sql);
			$search = "%" . $search . "%";
			$stmt->bindValue(':search',$search,PDO::PARAM_STR);
			$stmt->execute();
		}
		elseif ($search == '') {
			$sql = "SELECT * FROM student ";
			$stmt = $this->dbn->prepare($sql);
			$stmt->execute();
		}

		return count($stmt->fetchAll());
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
		$id = $this->getCount()+1;
		
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
		if ($stmt->fetchColumn()) {
			return false;
		}
		else {
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