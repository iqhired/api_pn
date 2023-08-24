<?php
class SupplierUsers{

    // Connection
    private $conn;

    // Table
    private $db_table = "sup_acc_users";
    // Columns
    public $sup_id;
    public $user_name;
    public $password;
    public $first_name;
    public $last_name;
    public $role;
    public $email;
    public $mobile;
    public $address;
    public $profile_pic;
    public $created_at;
    public $delete_check;




    // Db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
    create supplier User
     */
    public function createSupplierUsers()
    {

        $sqlQuery = "insert into " . $this->db_table . "(user_name,password,first_name,last_name,role,email,mobile,address,profile_pic,created_at) values ( ?,?,?,?,?,?,?,?,?,?)";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->user_name, $this->password,$this->first_name,$this->last_name,$this->role,$this->email,$this->mobile,$this->address,$this->profile_pic,$this->created_at]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".sup_id DESC LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->sup_id = $dataRow['sup_id'];
            $this->user_name = $dataRow['user_name'];
            $this->password = $dataRow['password'];
            $this->first_name = $dataRow['first_name'];
            $this->last_name = $dataRow['last_name'];
            $this->role = $dataRow['role'];
            $this->email = $dataRow['email'];
            $this->mobile = $dataRow['mobile'];
            $this->address = $dataRow['address'];
            $this->profile_pic = $dataRow['profile_pic'];
            $this->created_at = $dataRow['created_at'];
            return $this;
        }

    }

    /**
    update supplier User
     */
    public function updateSupplierUser()
    {

        $sqlQuery = "update " . $this->db_table . " SET user_name = ? ,password = ? ,first_name = ? ,last_name = ? ,role = ? ,email = ? ,mobile = ? ,address = ? ,profile_pic = ?  where sup_id = '$this->sup_id'";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->user_name,$this->password,$this->first_name,$this->last_name,$this->role,$this->email,$this->mobile,$this->address,$this->profile_pic]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".sup_id DESC LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else
        {
            $this->sup_id = $dataRow['sup_id'];
            $this->user_name = $dataRow['edit_user_name'];
            $this->password = $dataRow['edit_password'];
            $this->first_name = $dataRow['edit_first_name'];
            $this->last_name = $dataRow['edit_last_name'];
            $this->role = $dataRow['edit_role'];
            $this->email = $dataRow['edit_email'];
            $this->mobile = $dataRow['edit_mobile'];
            $this->address = $dataRow['edit_address'];
            $this->profile_pic = $dataRow['edit_profile_pic'];
            return $this;
        }

    }

    /**
    delete supplier User
     */
    public function deleteSupplierUserById()
    {

        $sqlQuery = "delete from " . $this->db_table . " where sup_id = ?";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->delete_check]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".sup_id DESC LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->sup_id = $dataRow['sup_id'];
            $this->user_name = $dataRow['user_name'];

            return $this;
        }

    }


}