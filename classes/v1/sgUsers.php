<?php
class SgUsers{

	// Connection
	private $conn;

	// Table
	private $db_table = "cam_users";

	// Columns
	public $users_id;
	public $user_name;
	public $mobile;
	public $email;
	public $password;
	public $role;
	public $profile_pic;
	public $created_at;
	public $updated_at;
	public $assigned;
	public $assigned2;
	public $firstname;
	public $lastname;
	public $hiring_date;
	public $total_days;
	public $job_title_description;
	public $job_title_id;
	public $shift_location;
	public $shift_location_id;
	public $available;
	public $available_time;
	public $pin;
	public $pin_flag;
	public $training;
	public $training_station;
	public $training_position;
	public $is_cust_dash;
	public $line_cust_dash;
	// Db connection
	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function getUserByUNameandPassword(){

		$sqlQuery= "SELECT * FROM ". $this->db_table ." WHERE user_name= ? and password = ?";

		$stmt = $this->conn->prepare($sqlQuery);

		$stmt->bindParam(1, $this->user_name);
		$stmt->bindParam(2, $this->password);

		$stmt->execute();

		$dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
		if($dataRow == null || empty($dataRow)){
			return null;
		}else{
			$this->users_id = $dataRow['users_id'];
			$this->available = $dataRow['available'];
			$this->user_name = $dataRow['user_name'];
			$this->role = $dataRow['role'];
			$this->profile_pic = $dataRow['profile_pic'];
			$this->firstname = $dataRow['firstname'];
			$this->lastname = $dataRow['lastname'];
			$this->pin = $dataRow['pin'];
			$this->pin_flag = $dataRow['pin_flag'];
			$this->is_cust_dash = $dataRow['is_cust_dash'];
			$this->line_cust_dash = $dataRow['line_cust_dash'];
			return $this;
		}
	}
}