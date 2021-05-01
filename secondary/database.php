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

            # basic switchusage
            $type = $_POST["type"];
            $id = $conn->query("SELECT * FROM $type")->num_rows;
            $sql = "";

            # compute data
            switch($type){
                case "profile":
                    $first = $_POST["first"];
                    $last = $_POST["last"];
                    $sql = "INSERT INTO $type (id, firstname, lastname) VALUES ($id, '$first', '$last');";
                break;
            }

            # if query successful
            if($conn->query($sql)){
                $conn->query("INSERT INTO templates (name, id) VALUES ('$type', $id);");
            }else{
                echo "Error: ".$conn->error;
            }
        }
    }
    public function render_database(){
        # define connection
        $conn = $this->connection;

        # read database
        $sql = "SELECT * FROM templates";
        $result = $conn->query($sql);

        # render database
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){

                $template = $row["name"];
                $id = $row["id"];

                # get 
                $data = $conn->query("SELECT * FROM $template WHERE id=$id")->fetch_assoc();
                switch($template){
                    case "profile":
                        $first = $data["firstname"];
                        $last = $data["lastname"];
                    ?>
                        <div class="profile">
                            <div class="avatar">
                                <img src="./images/go_green.png" width="50">
                            </div>
                            <h1>Profile</h1>
                            <div>
                                <div>
                                    <?php echo $first; ?>
                                </div>
                                <div>
                                    <?php echo $last; ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    break;
                }
            }
        }else{
            echo "0 results";
        }
    }
}
?>