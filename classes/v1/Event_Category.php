<?php
class Events_Category
{
    private $conn;
    private $db_table = "Events_Category";
    public $events_cat_id;
    public $events_cat_name;
    public $npr;
    public $created_by;
    public $created_on;


    public function __construct($db)
    {

        $this->conn = $db;
    }

    public function getEventCategory()
    {

        $sqlQuery = "insert into " . $this->db_table . "(events_cat_name,npr,created_by,created_on) values (?,?,?,?)";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->events_cat_name, $this->npr,$this->created_by,$this->created_on]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->events_cat_name = $dataRow['events_cat_name'];
            $this->npr = $dataRow['npr'];
            $this->created_by = $dataRow['created_by'];
            $this->created_on = $dataRow['created_on'];
            return $this;
        }
    }
    public function getEditEventCategory()
    {

        $sqlQuery = "update " . $this->db_table . " SET events_cat_name = ?,npr = ?  where events_cat_id = '$this->events_cat_id'";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->events_cat_name,$this->npr]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->events_cat_id = $dataRow['events_cat_id'];
            $this->events_cat_name = $dataRow['events_cat_name'];
            $this->npr = $dataRow['npr'];
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
