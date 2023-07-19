<?php
class Iot_Device
{
    private $conn;
    private $db_table = "iot_devices";
    public $id;
    public $c_id;
    public $device_id;
    public $device_name;
    public $device_description;
    public $device_location;
    public $is_active;
    public $is_deleted;
    public $created_by;
    public $created_on;
    public $modified_by;
    public $modified_on;
    public $delete_check;

    public function __construct($db)
    {

        $this->conn = $db;
    }

    public function getIotDevice()
    {

        $sqlQuery = "insert into " . $this->db_table . "(c_id,device_id,device_name,device_description,device_location,is_active,created_by,created_on) values ( ?,?,?,?,?,?,?,?)";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->c_id, $this->device_id, $this->device_name, $this->device_description, $this->device_location,$this->is_active,$this->created_by, $this->created_on]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->c_id = $dataRow['c_id'];
            $this->device_id = $dataRow['device_id'];
            $this->device_name = $dataRow['device_name'];
            $this->device_description = $dataRow['device_description'];
            $this->device_location = $dataRow['device_location'];
            $this->is_active = $dataRow['is_active'];
            $this->created_by = $dataRow['created_by'];
            $this->created_on = $dataRow['created_on'];
            $this->delete_check = $dataRow['delete_check'];
            return $this;
        }

    }
    public function getEditIotDevice()
    {

        $sqlQuery = "update " . $this->db_table . " SET device_description = ? ,device_location = ?, modified_by = ?, modified_on = ? where device_id = '$this->device_id'";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->device_description, $this->device_location, $this->modified_by, $this->modified_on]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->device_id = $dataRow['device_id'];
            $this->device_description = $dataRow['device_description'];
            $this->device_location = $dataRow['device_location'];
            $this->modified_by = $dataRow['modified_by'];
            $this->modified_on = $dataRow['modified_on'];
            return $this;
        }

    }
    public function getdeleteIotDevice()
    {
        $sqlQuery = "update " . $this->db_table . " SET is_deleted = 1  where device_id = ?";
       // $sqlQuery = "delete from " . $this->db_table . " where device_id = ?";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->delete_check]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->id = $dataRow['id'];
            $this->device_id = $dataRow['device_id'];
            return $this;
        }

    }
    public function getdelIotDevice()
    {
        $sqlQuery = "update " . $this->db_table . " SET is_deleted = 1  where device_id = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->device_id]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->id = $dataRow['id'];
            $this->device_id = $dataRow['device_id'];
            return $this;
        }

    }

}





