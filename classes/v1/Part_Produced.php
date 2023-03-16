<?php
class Part_Produced
{
    private $conn;
    private $db_table = "pno_vs_pProduced";
    public $id;
    public $part_number;
    public $dependant_parts;
    public $created_at;
    public $updated_at;


    public function __construct($db)
    {

        $this->conn = $db;
    }

    public function getPartProduced()
    {

        $sqlQuery = "insert into " . $this->db_table . "(part_number,dependant_parts,created_at,updated_at) values ( ?,?,?,?)";

        $stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute([$this->part_number, $this->dependant_parts, $this->created_at , $this->updated_at]);
	
		$sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".id DESC LIMIT 0,1";
		$stmt = $this->conn->prepare($sqlQuery1);
		$stmt->execute();
		$dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->id = $dataRow['id'];
            $this->part_number = $dataRow['part_number'];
            $this->part_number_extra = $dataRow['dependant_parts'];
            $this->created_at = $dataRow['created_at'];
            $this->updated_at = $dataRow['updated_at'];
            return $this;
        }

    }

    public function getEditPartProduced()
    {

        $sqlQuery = "update " . $this->db_table . " SET dependant_parts = ? ,updated_at = ? where part_number = '$this->part_number'";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->dependant_parts, $this->updated_at]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".id DESC LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->id = $dataRow['id'];
            $this->part_number = $dataRow['part_number'];
            $this->part_number_extra = $dataRow['dependant_parts'];
            $this->updated_at = $dataRow['updated_at'];
            return $this;
        }

    }

}

//$part_produce_array = array( new Part_Produced($this->part_number,$this->part_number_extra, $this->part_count));
//
//
//foreach ($part_produce_array as $part) {
//    echo $part->getPartProduced();
//}