<?php
class Material_Config
{
    private $conn;
    private $db_table = "Material_Config";
    public $material_id;
    public $teams;
    public $users;
    public $material_type;
    public $serial_num_required;
    public $created_at;



    public function __construct($db)
    {

        $this->conn = $db;
    }

    public function getMaterialConfig()
    {

        $sqlQuery = "insert into " . $this->db_table . "(teams,users,material_type,serial_num_required,created_at) values ( ?,?,?,?,?)";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->teams,$this->users,$this->material_type,$this->serial_num_required,$this->created_at]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->teams = $dataRow['teams'];
            $this->users = $dataRow['users'];
            $this->material_type = $dataRow['material_type'];
            $this->serial_num_required = $dataRow['serial_num_required'];
            $this->created_at = $dataRow['created_at'];
            return $this;
        }

    }

    public function getEditMaterialConfig()
    {

        $sqlQuery = "update " . $this->db_table . " SET teams = ? ,users = ?,material_type = ?,serial_num_required = ?,created_at = ? where material_id = '$this->material_id'";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->teams, $this->users, $this->material_type, $this->serial_num_required, $this->created_at]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->material_id = $dataRow['material_id'];
            $this->teams = $dataRow['teams'];
            $this->users = $dataRow['users'];
            $this->material_type = $dataRow['material_type'];
            $this->serial_num_required = $dataRow['serial_num_required'];
            $this->created_at = $dataRow['created_at'];
            return $this;
        }

    }
}
