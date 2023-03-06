<?php
class Part_Produced{
     private $conn;

     private $db_table = "pno_vs_pProduced";

     public $id;
     public $part_number;
     public $part_number_extra;
     public $part_count;

     public function __construct($db){

         $this->conn = $db;
     }

     public function getPartProduced(){

         $sqlQuery = "Select * from ". $this->db_table . " where part_number= ? and part_number_extra= ?";

         $stmt = $this->conn->prepare($sqlQuery);

         $stmt->bindParam(1, $this->part_number);
         $stmt->bindParam(2, $this->part_count);

         $stmt->execute();

         $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

         if($dataRow == null || empty($dataRow)){
             return null;
         }else{
             $this->id = $dataRow['id'];
             $this->part_number = $dataRow['part_number'];
             $this->part_number_extra = $dataRow['part_number_extra_1'];
             $this->part_count = $dataRow['part_count_1'];
             return $this;
         }

     }

    public function insertPartProduced(){

        $sqlQuery = "Select * from ". $this->db_table . " where part_number= ? and part_number_extra= ?";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->part_number);
        $stmt->bindParam(2, $this->part_count);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if($dataRow == null || empty($dataRow)){
            return null;
        }else{
            $this->id = $dataRow['id'];
            $this->part_number = $dataRow['part_number'];
            $this->part_number_extra = $dataRow['part_number_extra_1'];
            $this->part_count = $dataRow['part_count_1'];
            return $this;
        }

    }


}
