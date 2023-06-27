<?php
class Quality_Alert
{
    private $conn;
    private $db_table = "quality_part_alert";
    public $id;
    public $qa;
    public $part_number;
    public $station;
    public $part_family;
    public $prod_area;
    public $internal ;
    public $part_name ;
    public $customer ;
    public $external ;
    public $dependent_ans;
    public $user ;
    public $closed_by ;
    public $created_at;
    public $updated_at;
    public $closed_date;
    public $ok_image;
    public $nok_image;
    public $delete_check;


    public function __construct($db)
    {

        $this->conn = $db;
    }

    public function getQualityAlert()
    {

        $sqlQuery = "insert into " . $this->db_table . "(qa,part_number,station,part_family,prod_area,internal,customer,external,dependent_ans,user,ok_image,nok_image,closed_by,created_at,updated_at,closed_date) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->qa,$this->part_number,$this->station,$this->part_family,$this->prod_area,$this->internal,$this->customer,$this->external,$this->dependent_ans,$this->user,$this->ok_image,$this->nok_image,$this->closed_by,$this->created_at,$this->updated_at,$this->closed_date]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->id = $dataRow['id'];
            $this->qa = $dataRow['qa'];
            $this->part_number = $dataRow['part_number'];
            $this->station = $dataRow['station'];
            $this->part_family = $dataRow['part_family'];
            $this->internal = $dataRow['internal'];
            $this->customer = $dataRow['customer'];
            $this->external = $dataRow['external'];
            $this->dependent_ans = $dataRow['dependent_ans'];
            $this->user = $dataRow['user'];
            $this->closed_by = $dataRow['closed_by'];
            $this->created_at = $dataRow['created_at'];
            $this->updated_at = $dataRow['updated_at'];
            $this->closed_date = $dataRow['closed_date'];
            $this->ok_image = $dataRow['ok_image'];
            $this->nok_image = $dataRow['nok_image'];
            return $this;
        }

    }

    public function getEditQualityAlert()
    {

        $sqlQuery = "update " . $this->db_table . " SET dependent_ans = ? ,updated_at = ? where part_number = '$this->part_number'";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->dependent_ans, $this->updated_at]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".id DESC LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->part_number    = $dataRow['part_number'];
            $this->dependent_ans  = $dataRow['dependent_ans'];
            $this->created_at     = $dataRow['created_at'];
            $this->updated_at     = $dataRow['updated_at'];
            return $this;
        }

    }

    public function getdeleteQualityAlert()
    {

        $sqlQuery = "delete from " . $this->db_table . " where id = ?";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->delete_check]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".id DESC LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->id = $dataRow['id'];
            $this->part_number = $dataRow['part_number'];

            return $this;
        }

    }

}

//$part_produce_array = array( new Part_Produced($this->part_number,$this->part_number_extra, $this->part_count));
//
//
//foreach ($part_produce_array as $part) {
//    echo $part->getPartProduced();
//}<?php
