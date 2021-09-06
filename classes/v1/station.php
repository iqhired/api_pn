<?php
class Station{

	// Connection
	private $conn;

	// Table
	private $db_table = "cam_line";

	// Columns
	public $line_id;
	public $line_name;
	public $priority_order;
	public $enabled;
	public $created_at;

	// Db connection
	public function __construct($db){
		$this->conn = $db;
	}

	// GET ALL
	public function getAllStations(){
		$sqlQuery = "SELECT line_id, line_name, priority_order , enabled , created_at FROM " . $this->db_table . "";
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		return $stmt;
	}

	// CREATE
	public function createStation(){
		$sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        line_name = :line_name, 
                        priority_order = :priority_order, 
                        enabled = :enabled,
                        created_at = :created_at";

		$stmt = $this->conn->prepare($sqlQuery);

		// sanitize
		$this->line_name=htmlspecialchars(strip_tags($this->line_name));
		$this->priority_order=htmlspecialchars(strip_tags($this->priority_order));
		$this->enabled=htmlspecialchars(strip_tags($this->enabled));
		$this->created_at=htmlspecialchars(strip_tags($this->created_at));

		// bind data
		$stmt->bindParam(":line_name", $this->line_name);
		$stmt->bindParam(":priority_order", $this->priority_order);
		$stmt->bindParam(":enabled", $this->enabled);
		$stmt->bindParam(":created_at", $this->created_at);

		if($stmt->execute()){
			return true;
		}
		return false;
	}

	// UPDATE
	public function getStationByID(){
		$sqlQuery = "SELECT
                        line_id, 
                        line_name, 
                        priority_order, 
                        enabled,
                        created_at 
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       line_id = ?
                    LIMIT 0,1";

		$stmt = $this->conn->prepare($sqlQuery);

		$stmt->bindParam(1, $this->line_id);

		$stmt->execute();

		$dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->line_name = $dataRow['line_name'];
		$this->priority_order = $dataRow['priority_order'];
		$this->enabled = $dataRow['enabled'];
		$this->created_at = $dataRow['created_at'];
		return $this;
	}

	// UPDATE
	public function updateStation(){
		$sqlQuery = "UPDATE ". $this->db_table ." 
                    SET
                        line_name = :line_name, 
                        priority_order = :priority_order, 
                        enabled = :enabled
                    WHERE 
                        line_id = :line_id";

		$stmt = $this->conn->prepare($sqlQuery);

		$this->line_name=htmlspecialchars(strip_tags($this->line_name));
		$this->priority_order=htmlspecialchars(strip_tags($this->priority_order));
		$this->enabled=htmlspecialchars(strip_tags($this->enabled));
		$this->line_id=htmlspecialchars(strip_tags($this->line_id));

		// bind data
		$stmt->bindParam(":line_name", $this->line_name);
		$stmt->bindParam(":priority_order", $this->priority_order);
		$stmt->bindParam(":enabled", $this->enabled);
		$stmt->bindParam(":line_id", $this->line_id);

		if($stmt->execute()){
			return true;
		}
		return false;
	}

	// DELETE
	function deleteStationByID(){
		$sqlQuery = "DELETE FROM " . $this->db_table . " WHERE line_id = ?";
		$stmt = $this->conn->prepare($sqlQuery);

		$this->id=htmlspecialchars(strip_tags($this->line_id));

		$stmt->bindParam(1, $this->line_id);

		if($stmt->execute()){
			return true;
		}
		return false;
	}

}
?>

