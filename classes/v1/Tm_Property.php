<?php
class Tm_Property
{
    private $conn;
    private $db_table = "tm_property";
    public $tm_property_id;
    public $tm_property_name;
    public $created_by;
    public $delete_check;

    public function __construct($db)
    {

        $this->conn = $db;
    }

    public function getTmProperty()
    {

        $sqlQuery = "insert into " . $this->db_table . "(tm_property_name,created_by) values (?,?)";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->tm_property_name, $this->created_by]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".tm_property_id";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->tm_property_name = $dataRow['tm_property_name'];
            $this->created_by = $dataRow['created_by'];
            $this->delete_check = $dataRow['delete_check'];
            return $this;
        }
    }
    public function getEditTmProperty()
    {

        $sqlQuery = "update " . $this->db_table . " SET tm_property_name = ?  where tm_property_id = '$this->tm_property_id'";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->tm_property_name]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".tm_property_id";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->tm_property_id = $dataRow['tm_property_id'];
            $this->tm_property_name = $dataRow['tm_property_name'];
            $this->created_by = $dataRow['created_by'];
            return $this;
        }

    }
    public function getdeleteTmProperty()
    {

        $sqlQuery = "delete from " . $this->db_table . " where tm_property_id = ?";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->tm_property_id]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".tm_property_id";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->tm_property_id = $dataRow['tm_property_id'];
            $this->tm_property_name = $dataRow['tm_property_name'];
            return $this;
        }

    }
}
