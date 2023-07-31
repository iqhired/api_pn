<?php
class Job_Title
{
    private $conn;
    private $db_table = "cam_job_title";
    public $job_title_id;
    public $job_name;
    public $created_at;
    public $updated_at;


    public function __construct($db)
    {

        $this->conn = $db;
    }

    public function getJobTitle()
    {

        $sqlQuery = "insert into " . $this->db_table . "(job_name,created_at,updated_at) values ( ?,?,?)";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->job_name,$this->created_at , $this->updated_at]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".job_title_id";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->job_name = $dataRow['job_name'];
            $this->created_at = $dataRow['created_at'];
            $this->updated_at = $dataRow['updated_at'];
            return $this;
        }

    }

    public function getEditJobTitle()
    {

        $sqlQuery = "update " . $this->db_table . " SET job_name = ? ,updated_at = ? where job_title_id = '$this->job_title_id'";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->job_name, $this->updated_at]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".job_title_id";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->job_title_id = $dataRow['job_title_id'];
            $this->job_name = $dataRow['job_name'];
            $this->updated_at = $dataRow['updated_at'];
            return $this;
        }

    }
}
