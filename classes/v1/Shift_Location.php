<?php
class Shift_Location
{
    private $conn;
    private $db_table = "Cam_Shift";
    public $shift_id;
    public $shift_name;
    public $created_at;
    public $updated_at;


    public function __construct($db)
    {

        $this->conn = $db;
    }

    public function getShiftLocation()
    {

        $sqlQuery = "insert into " . $this->db_table . "(shift_name,created_at,updated_at) values ( ?,?,?)";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->shift_name,$this->created_at , $this->updated_at]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".shift_id DESC limit 0,1";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->shift_name = $dataRow['shift_name'];
            $this->created_at = $dataRow['created_at'];
            $this->updated_at = $dataRow['updated_at'];
            return $this;
        }

    }

    public function getEditShiftLocation()
    {

        $sqlQuery = "update " . $this->db_table . " SET shift_name = ? ,updated_at = ? where shift_id = '$this->shift_id'";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->shift_name, $this->updated_at]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".shift_id DESC limit 0,1";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->shift_id = $dataRow['shift_id'];
            $this->shift_name = $dataRow['shift_name'];
            $this->updated_at = $dataRow['updated_at'];
            return $this;
        }

    }
}
