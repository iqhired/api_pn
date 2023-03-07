<?php
class Part_Produced
{
    private $conn;
    private $db_table = "pno_vs_pproduced";
    public $id;
    public $part_number;
    public $dependant_parts;
    public $created_at;
    public $updated_at;
    public $click_id;


    public function __construct($db)
    {

        $this->conn = $db;
    }

    public function getPartProduced()
    {

        $sqlQuery = "insert into " . $this->db_table . "(part_number,dependant_parts,created_at,updated_at) values (" . $this->part_number . "," . $this->dependant_parts . "," .$this->created_at .",".$this->updated_at. ")";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->part_number);
        $stmt->bindParam(2, $this->dependant_parts);
        $stmt->bindParam(3, $this->created_at);
        $stmt->bindParam(4, $this->updated_at);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

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

}

//$part_produce_array = array( new Part_Produced($this->part_number,$this->part_number_extra, $this->part_count));
//
//
//foreach ($part_produce_array as $part) {
//    echo $part->getPartProduced();
//}