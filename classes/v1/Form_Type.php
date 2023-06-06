<?php
class Form_Type
{
    private $conn;
    private $db_table = "Form_Type";
    public $form_type_id;
    public $form_type_name;
    public $wol;
    public $created_at;
    public $updated_at;


    public function __construct($db)
    {

        $this->conn = $db;
    }

    public function getFormType()
    {

        $sqlQuery = "insert into " . $this->db_table . "(form_type_name,wol,created_at,updated_at) values ( ?,?,?,?)";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->form_type_name,$this->wol,$this->created_at , $this->updated_at]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->form_type_name = $dataRow['form_type_name'];
            $this->wol = $dataRow['wol'];
            $this->created_at = $dataRow['created_at'];
            $this->updated_at = $dataRow['updated_at'];
            return $this;
        }

    }

    public function getEditFormType()
    {

        $sqlQuery = "update " . $this->db_table . " SET form_type_name = ? ,wol = ? ,updated_at = ? where form_type_id = '$this->form_type_id'";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->form_type_name,$this->wol, $this->updated_at]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->form_type_id = $dataRow['form_type_id'];
            $this->form_type_name = $dataRow['form_type_name'];
            $this->wol = $dataRow['wol'];
            $this->updated_at = $dataRow['updated_at'];
            return $this;
        }

    }
}
