<?php
class Tm_Description
{
    private $conn;
    private $db_table = "tm_description";
    public $tm_description_id;
    public $tm_description_name;
    public $created_by;
    public $delete_check;


    public function __construct($db)
    {

        $this->conn = $db;
    }

    public function getTmDescription()
    {

        $sqlQuery = "insert into " . $this->db_table . "(tm_description_name,created_by) values (?,?)";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->tm_description_name, $this->created_by]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".tm_description_id";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->tm_description_name = $dataRow['tm_description_name'];
            $this->created_by = $dataRow['created_by'];
            $this->delete_check = $dataRow['delete_check'];
            return $this;
        }
    }
    public function getEditTmDescription()
    {

        $sqlQuery = "update " . $this->db_table . " SET tm_description_name = ?  where tm_description_id = '$this->tm_description_id'";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->tm_description_name]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".tm_description_id";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->tm_description_id = $dataRow['tm_description_id'];
            $this->tm_description_name = $dataRow['tm_description_name'];
            $this->created_by = $dataRow['created_by'];
            return $this;
        }

    }
    public function getdeleteTmDescription()
    {

        $sqlQuery = "delete from " . $this->db_table . " where tm_description_id = ?";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->tm_description_id]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".tm_description_id";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->tm_description_id = $dataRow['tm_description_id'];
            $this->tm_description_name = $dataRow['tm_description_name'];
            return $this;
        }

    }
}
