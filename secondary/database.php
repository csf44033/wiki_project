<?php
class Database {
    private $ip;
    private $user;
    private $pass;
    private $db;
    private $connection;

    public function __construct($ip="127.0.0.1", $user="root", $pass="", $db="practice"){
        $this->ip = $ip;
        $this->user = $user;
        $this->pass = $pass;
        $this->db = $db;
        $this->connection = new mysqli($ip, $user, $pass, $db);
        if($this->connection->connect_error) {
            die("connection failed: ".$this->connection->connect_error);
        }
    }
    public function handle_post(){
        if (!empty($_POST["type"])){
            # define connection
            $conn = $this->connection;

            # compute data
            $sql="";
            switch($_POST["type"]){
                case "profile":
                    $first = $_POST["first"];
                    $last = $_POST["last"];
    
                    $code=<<<XML
                    <profile>
                        <first>$first</first>
                        <last>$last</last>
                    </profile>
                    XML;
                    $sql="INSERT INTO user (content) VALUES ($code);";
                break;
            }

            # add data
            if ($conn->query($sql) === TRUE){
                echo "New record created successfully";
            }else{
                echo "Error: ".$sql."<br>".$conn->error;
            }
        }
    }
    public function render_database(){
        # define connection
        $conn = $this->connection;

        # read database
        $sql = "SELECT * FROM user";
        $result = $conn->query($sql);

        # render database
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "id: ".$row["firstname"];
            }
        }else{
            echo "0 results";
        }
    }
}