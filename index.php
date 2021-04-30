<!--if post request-->
<?php
    if (!empty($_POST["type"])){
        $dbip = '127.0.0.1';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'practice';

        //open database
        $conn = new mysqli($dbip, $dbuser, $dbpass, $dbname);
        if($conn->connect_error) {
            die("connection failed: ".$conn->connect_error);
        }

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
        }
        if ($conn->query($sql) === TRUE){
            echo "New record created successfully";
        }else{
            echo "Error: ".$sql."<br>".$conn->error;
        }
        $conn->close();
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <!--Templates-->
        <div id="profile_form" class="form" style="display:none">
            <form class="column" action="index.php" method="POST">
                <img src="go_green.png" width="50">
                <h2>Your Name</h2>
                <input type="text" placeholder="first" name="first">
                <input type="text" placeholder="last" name="last">
                <input type="submit">
                <input type="hidden" name="type" value="profile">
            </form>
        </div>
        <!--main container-->
        <div class="fit row">
            <!--User Profile-->
            <div id = "user-profile" class = "fit column">
                <?php
                $dbip = '127.0.0.1';
                $dbuser = 'root';
                $dbpass = '';
                $dbname = 'practice';

                //open database
                $conn = new mysqli($dbip, $dbuser, $dbpass, $dbname);
                if($conn->connect_error) {
                    die("connection failed: ".$conn->connect_error);
                }

                //fetch entire table
                $sql = "SELECT * FROM user";
                $result = $conn->query($sql);

                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "id: ".$row["firstname"];
                    }
                }else{
                    echo "0 results";
                }

                $conn->close();
                ?>
            </div>
            <!--User Options-->
            <div id="user-options" class="column">
                <!--User Templates-->
                <div>
                    <!--heading-->
                    <div class="row heading" onclick="toggle('template-options')">
                        <img src="plus.png">
                        <p>TEMPLATES</p>
                    </div>
                    <!--templates-->
                    <div id="template-options" class="column options">
                        <button onclick="toggle('profile_form')">Profile</button>
                    </div>
                </div>
                <!--User notifications-->
                <div>
                    <!--heading-->
                    <div class="row heading">
                        <img src="plus.png">
                        <p>NOTIFICATIONS</p>
                    </div>
                    <!--users-->
                    <div></div>
                </div>
            </div>
        </div>
    </body>
    <script src="index.js"></script>
</html>