<?php


/**
 * 
 */
class database {
	
	private $db_resource;
	private $last_error = null;
	private $last_result;

	public function __construct($host, $user, $password, $name) {
		$this->db_resource = mysqli_connect($host,$user,$password,$name);
		mysqli_set_charset($this->db_resource,"utf8");

		if (!$this->db_resource){
			$this->last_error = mysqli_connect_error();
		}
	}

	public function executeQuery($sql){
		$this->last_error = null;
		$query = mysqli_query($this->db_resource, $sql);

		if ($query){
			$this->last_result = $query;
			$result = true;
		}
		else {
			$this->last_error = mysqli_error($this->db_resource);
			$result = false;
		}
		return $result;
	}

	public function getLastError(){
		return $this->last_error;
	}

	public function getResultAsArray(){
		return mysqli_fetch_all($this->last_result, MYSQLI_ASSOC);
	}

	public function getLastId(){
		return mysqli_insert_id($this->db_resource);
	}
	
	public function getNumRows(){
		return mysqli_num_rows($this->last_result);
	}

}



?>