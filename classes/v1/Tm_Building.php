<?php
class Tm_Building
{
    private $conn;
    private $db_table = "Tm_Building";
    public $tm_building_id;
    public $tm_building_name;
    public $created_by;
    public $delete_check;


    public function __construct($db)
    {

        $this->conn = $db;
    }

    public function getTmBuilding()
    {

        $sqlQuery = "insert into " . $this->db_table . "(tm_building_name,created_by) values (?,?)";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->tm_building_name, $this->created_by]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".tm_building_id";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->tm_building_name = $dataRow['tm_building_name'];
            $this->created_by = $dataRow['created_by'];
            $this->delete_check = $dataRow['delete_check'];
            return $this;
        }
    }
    public function getEditTmBuilding()
    {

        $sqlQuery = "update " . $this->db_table . " SET tm_building_name = ?  where tm_building_id = '$this->tm_building_id'";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->tm_building_name]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".tm_building_id";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->tm_building_id = $dataRow['tm_building_id'];
            $this->tm_building_name = $dataRow['tm_building_name'];
            $this->created_by = $dataRow['created_by'];
            return $this;
        }

    }
    public function getdeleteTmBuilding()
    {

        $sqlQuery = "delete from " . $this->db_table . " where tm_building_id = ?";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->tm_building_id]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".tm_building_id";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->tm_building_id = $dataRow['tm_building_id'];
            $this->tm_building_name = $dataRow['tm_building_name'];
            return $this;
        }

    }
}
