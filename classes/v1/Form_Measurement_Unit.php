<?php
class Form_Measurement_Unit
{
    private $conn;
    private $db_table = "form_measurement_unit";
    public $form_measurement_unit_id;
    public $name;
    public $description;
    public $unit_of_measurement;
    public $created_at;


    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getFormMeasurementUnit()
    {
        $sqlQuery = "insert into " . $this->db_table . "(name,description,unit_of_measurement,created_at) values (?,?,?,?)";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->name, $this->description,$this->unit_of_measurement,$this->created_at]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".form_measurement_unit_id";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->name = $dataRow['name'];
            $this->description = $dataRow['description'];
            $this->unit_of_measurement = $dataRow['unit_of_measurement'];
            $this->created_at = $dataRow['created_at'];
            return $this;
        }
    }
    public function getEditFormMeasurementUnit()
    {

        $sqlQuery = "update " . $this->db_table . " SET name = ?,description = ?,unit_of_measurement = ?  where form_measurement_unit_id = '$this->form_measurement_unit_id'";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->name,$this->description,$this->unit_of_measurement]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".form_measurement_unit_id";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->form_measurement_unit_id = $dataRow['form_measurement_unit_id'];
            $this->name = $dataRow['name'];
            $this->description = $dataRow['description'];
            $this->unit_of_measurement = $dataRow['unit_of_measurement'];
            return $this;
        }

    }
   /* public function getdeleteTmEquipment()
    {

        $sqlQuery = "delete from " . $this->db_table . " where tm_equipment_id = ?";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->tm_equipment_id]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->tm_equipment_id = $dataRow['tm_equipment_id'];
            $this->tm_equipment_name = $dataRow['tm_equipment_name'];
            return $this;
        }

    }*/
}
