<?php
require_once("dbcontroller.php");
Class Employee {
	private $employees = array();
	public function getAllEmployees(){
		if(isset($_GET['first_name']) && isset($_GET['last_name'])){
			$first_name = $_GET['first_name'];
			$last_name = $_GET['last_name'];
			$query = 'SELECT * FROM employees WHERE first_name LIKE "%' .$first_name. '%" AND last_name LIKE "%' .$first_name. '%"';
		} else {
			$query = 'SELECT * FROM employees';
		}
		$dbcontroller = new DBController();
		$this->employees = $dbcontroller->executeSelectQuery($query);
		return $this->employees;
	}

	public function addEmployee(){
		if(isset($_POST['first_name'])){
			$first_name = $_POST['first_name'];
			if(isset($_POST['last_name'])){
				$last_name = $_POST['last_name'];
			}
			if(isset($_POST['email'])){
				$email = $_POST['email'];
			}	
			if(isset($_POST['birthday'])){
				$birthday = $_POST['birthday'];
			}	
			$query = "insert into employees (first_name,last_name,email,birthday) values ('" . $first_name ."','". $last_name ."','" . $email ."', '". $birthday ."')";
			$dbcontroller = new DBController();
			$result = $dbcontroller->executeQuery($query);
			if($result != 0){
				$result = array('success'=>1);
				return $result;
			}
		}
	}
	
	public function deleteEmployee(){
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$query = 'DELETE FROM employees WHERE id = '.$id;
			$dbcontroller = new DBController();
			$result = $dbcontroller->executeQuery($query);
			if($result != 0){
				$result = array('success'=>1);
				return $result;
			}
		}
	}
	
	public function editEmployee(){
		if(isset($_POST['first_name']) && isset($_GET['id'])){
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$birthday = $_POST['birthday'];
			$query = "UPDATE employees SET first_name = '".$first_name."',last_name ='". $last_name ."',birthday ='". $birthday ."',email = '". $email ."' WHERE id = ".$_GET['id'];
		}
		$dbcontroller = new DBController();
		$result= $dbcontroller->executeQuery($query);
		if($result != 0){
			$result = array('success'=>1);
			return $result;
		}
	}
	
}
?>