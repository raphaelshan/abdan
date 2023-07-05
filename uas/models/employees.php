<?php
class Employee{
// Connection
private $conn;
// Table
private $db_table = "Employee";
// Columns
public $id;
public $name;
public $nim;
public $prodi;
public $gender;
public $created;
// Db connection
public function __construct($db){
    $this->conn = $db;
}
    // GET ALL
    public function getEmployees(){ 
        $sqlQuery = "SELECT id, name, nim, prodi, gender, created FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    // CREATE
    public function createEmployee(){
        $sqlQuery = "INSERT INTO
                ". $this->db_table ."
                SET
                    name = :name,
                    nim = :nim,
                    prodi = :prodi,
                    gender = :gender,
                    created = :created";
        $stmt = $this->conn->prepare($sqlQuery);
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->nim=htmlspecialchars(strip_tags($this->nim));
        $this->prodi=htmlspecialchars(strip_tags($this->prodi));
        $this->gender=htmlspecialchars(strip_tags($this->gender));
        $this->created=htmlspecialchars(strip_tags($this->created));
        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":nim", $this->nim);
        $stmt->bindParam(":prodi", $this->prodi);
        $stmt->bindParam(":gender", $this->gender);
        $stmt->bindParam(":created", $this->created);
        if($stmt->execute()){
                return true;
            }
            return false;
        }
        // READ single
        public function getSingleEmployee(){
            $sqlQuery = "SELECT
                        id,
                        name,
                        nim,
                    prodi,
                        gender,
                        created
                    FROM
                        ". $this->db_table ."
                WHERE
                    id = ?
                LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->name = $dataRow['name'];
            $this->nim = $dataRow['nim'];
            $this->prodi = $dataRow['prodi'];
            $this->gender = $dataRow['gender'];
            $this->created = $dataRow['created'];
        }
        // UPDATE
        public function updateEmployee(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                 SET 
                     name = :name,
                        nim = :nim,
                        prodi = :prodi,
                        gender = :gender,
                        created = :created
                 WHERE
                        id = :id";
            $stmt = $this->conn->prepare($sqlQuery);
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->nim=htmlspecialchars(strip_tags($this->nim));
            $this->prodi=htmlspecialchars(strip_tags($this->prodi));
            $this->gender=htmlspecialchars(strip_tags($this->gender));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->id=htmlspecialchars(strip_tags($this->id));

            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":nim", $this->nim);
            $stmt->bindParam(":prodi", $this->prodi);
            $stmt->bindParam(":gender", $this->gender);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":id", $this->id);

            if($stmt->execute()){
                return true;
            }
            return false;
        }
        // DELETE
        function deleteEmployee(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);

            $this->id=htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(1, $this->id);

            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>