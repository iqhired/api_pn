<?php
class supplier
{

    // Connection
    private $conn;

    // Table
    private $db_table = "sup_order";
    // Columns
    public $c_id;
    public $order_name;
    public $order_desc;
    public $order_status_id;
    public $order_active;
    public $shipment_details;
    public $created_by;
    public $modified_on;
    public $modified_by;
    public $created_on;

    // Db connection
    public function __construct($db){
        $this->conn = $db;
    }

    // GET ALL
    public function getAllOrder(){
        $sqlQuery = "SELECT c_id, order_name, order_desc, order_status_id, order_active, shipment_details, created_on, created_by, modified_on,modified_by   FROM " . $this->db_table . "sup_order";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createOrder(){
        $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        c_id = :c_id, 
                        order_name = :order_name, 
                        order_desc = :order_desc,
                        order_status_id = :order_status_id,
                        order_active = :order_active,
                        shipment_details = :shipment_details,
                        created_on = :created_on,
                        created_by = :created_by,
                        modified_on = :modified_on,
                        modified_by = :modified_by";

        $stmt = $this->conn->prepare($sqlQuery);


        // sanitize
        $this->c_id=htmlspecialchars(strip_tags($this->c_id));
        $this->order_name=htmlspecialchars(strip_tags($this->order_name));
        $this->order_desc =htmlspecialchars(strip_tags($this->order_desc));
        $this->order_status_id=htmlspecialchars(strip_tags($this->order_status_id));
        $this->order_active=htmlspecialchars(strip_tags($this->order_active));
        $this->shipment_details=htmlspecialchars(strip_tags($this->shipment_details));
        $this->created_on=htmlspecialchars(strip_tags($this->created_on));
        $this->created_by=htmlspecialchars(strip_tags($this->created_by));
        $this->modified_on=htmlspecialchars(strip_tags($this->modified_on));
        $this->modified_by=htmlspecialchars(strip_tags($this->modified_by));


        // bind data
        $stmt->bindParam(":c_id", $this->c_id);
        $stmt->bindParam(":order_name", $this->order_name);
        $stmt->bindParam(":order_desc", $this->order_desc);
        $stmt->bindParam(":order_status_id", $this->order_status_id);
        $stmt->bindParam(":order_active", $this->order_active);
        $stmt->bindParam(":shipment_details", $this->shipment_details);
        $stmt->bindParam(":created_by", $this->created_by);
        if($stmt->execute()){
            return true;
        }
        return false;
    }


    // UPDATE
    public function getOrder(){
        $sqlQuery = "SELECT
                        c_id, 
                        order_name, 
                        order_desc, 
                        order_status_id,
                        order_active,
                        shipment_details,
                        created_on
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       c_id = ?
                    LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->c_id);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->order_name = $dataRow['order_name'];
        $this->order_desc = $dataRow['order_desc'];
        $this->order_status_id = $dataRow['order_status_id'];
        $this->order_active = $dataRow['order_active'];
        $this->shipment_details = $dataRow['shipment_details'];
        $this-> created_on = $dataRow[' created_on'];
        return $this;
    }

    // UPDATE
    public function updateOrder(){
        $sqlQuery = "UPDATE ". $this->db_table ." 
                    SET
                        order_name = :order_name, 
                       order_desc = :order_desc, 
                       order_status_id = :order_status_id,
                       order_active = :order_active,
                       shipment_details = :shipment_details,
                       created_on = :created_on,
                    WHERE 
                        c_id = :c_id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->c_id=htmlspecialchars(strip_tags($this->c_id));
        $this->order_name=htmlspecialchars(strip_tags($this->order_name));
        $this->order_desc =htmlspecialchars(strip_tags($this->order_desc));
        $this->order_status_id=htmlspecialchars(strip_tags($this->order_status_id));
        $this->order_active=htmlspecialchars(strip_tags($this->order_active));
        $this->shipment_details=htmlspecialchars(strip_tags($this->shipment_details));
        $this->created_on=htmlspecialchars(strip_tags($this->created_on));
        $this->created_by=htmlspecialchars(strip_tags($this->created_by));
        $this->modified_on=htmlspecialchars(strip_tags($this->modified_on));
        $this->modified_by=htmlspecialchars(strip_tags($this->modified_by));


        // bind data
        $stmt->bindParam(":c_id", $this->c_id);
        $stmt->bindParam(":order_name", $this->order_name);
        $stmt->bindParam(":order_desc", $this->order_desc);
        $stmt->bindParam(":order_status_id", $this->order_status_id);
        $stmt->bindParam(":order_active", $this->order_active);
        $stmt->bindParam(":shipment_details", $this->shipment_details);
        $stmt->bindParam(":created_by", $this->created_by);

        if($stmt->execute()){
            return true;
        }
        return false;
    }



    // DELETE
    function deleteOrderByID(){
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE c_id = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id=htmlspecialchars(strip_tags($this->c_id));

        $stmt->bindParam(1, $this->c_id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

}
?>











