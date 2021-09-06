<?php
class AssignedCrew{
	// Connection
	private $conn;

	// Table
	private $db_table = "cam_assign_crew";

	// Columns
	public $assign_crew_id;
	public $position_id;
	public $line_id;
	public $user_id;
	public $assign_crew_transaction_id;
	public $resource_type;
	public $email_notification;
	public $created_at;

	// Db connection
	public function __construct($db){
		$this->conn = $db;
	}

	// GET ALL
	public function getAllAssignedCrew(){
		$sqlQuery = "SELECT assign_crew_id, position_id, line_id , user_id , assign_crew_transaction_id , resource_type, email_notification, created_at FROM " . $this->db_table . "";
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		return $stmt;
	}

	// GET ALL
	public function getAllAssignedCrewByStationID(){
		$sqlQuery = "SELECT assign_crew_id, position_id, line_id , user_id , assign_crew_transaction_id , resource_type, email_notification, created_at FROM " . $this->db_table . "
		 WHERE line_id = ? LIMIT 0,1";
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->bindParam(1, $this->line_id);
		$stmt->execute();
		return $stmt;
	}

	// GET ALL
	public function isCrewAssignedForStation(){
		$sqlQuery = "SELECT assign_crew_id, position_id, line_id , user_id , assign_crew_transaction_id , resource_type, email_notification, created_at FROM " . $this->db_table . "
		 WHERE line_id = ? LIMIT 0,1";
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->bindParam(1, $this->line_id);
		$stmt->execute();
		$count = $stmt->rowCount();
		if($count > 0){
			return true;
		}else{
			return false;
		}
	}

}
?>