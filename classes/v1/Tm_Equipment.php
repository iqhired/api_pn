<?php
class Tm_Equipment
{
    private $conn;
    private $db_table = "tm_equipment";
    public $tm_equipment_id;
    public $tm_equipment_name;
    public $created_by;


    public function __construct($db)
    {

        $this->conn = $db;
    }

    public function getTmEquipment()
    {

        $sqlQuery = "insert into " . $this->db_table . "(tm_equipment_name,created_by) values (?,?)";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->tm_equipment_name, $this->created_by]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".tm_equipment_id";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->tm_equipment_name = $dataRow['tm_equipment_name'];
            $this->created_by = $dataRow['created_by'];
            $this->delete_check = $dataRow['delete_check'];
            return $this;
        }
    }
    public function getEditTmEquipment()
    {

        $sqlQuery = "update " . $this->db_table . " SET tm_equipment_name = ?  where tm_equipment_id = '$this->tm_equipment_id'";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->tm_equipment_name]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".tm_equipment_id";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->tm_equipment_id = $dataRow['tm_equipment_id'];
            $this->tm_equipment_name = $dataRow['tm_equipment_name'];
            $this->created_by = $dataRow['created_by'];
            return $this;
        }

    }

}
