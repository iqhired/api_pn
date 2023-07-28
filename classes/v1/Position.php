<?php
class Position
{
    private $conn;
    private $db_table = "Cam_Position";
    public $position_id;
    public $position_name;
    public $created_at;
    public $updated_at;


    public function __construct($db)
    {

        $this->conn = $db;
    }

    public function getPosition()
    {

        $sqlQuery = "insert into " . $this->db_table . "(position_name,created_at,updated_at) values ( ?,?,?)";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->position_name,$this->created_at , $this->updated_at]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".position_id";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->position_name = $dataRow['position_name'];
            $this->created_at = $dataRow['created_at'];
            $this->updated_at = $dataRow['updated_at'];
            return $this;
        }

    }

    public function getEditPosition()
    {

        $sqlQuery = "update " . $this->db_table . " SET position_name = ? ,updated_at = ? where position_id = '$this->position_id'";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->position_name, $this->updated_at]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".position_id";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->position_id = $dataRow['position_id'];
            $this->position_name = $dataRow['position_name'];
            $this->updated_at = $dataRow['updated_at'];
            return $this;
        }

    }
}
