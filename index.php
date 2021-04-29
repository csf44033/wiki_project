<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <!--main container-->
        <div class="fit row">
            <!--User Profile-->
            <div id = "user-profile" class = "fit column">
            <?php
            $dbip = '127.0.0.1';
            $dbuser = '';
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
                        <button>Profile</button>
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