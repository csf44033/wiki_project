<!--if post request-->
<?php
require_once "./secondary/database.php";
$database = new Database();
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <!--Templates-->
        <div id="profile_form" class="form" style="display:none">
            <form class="column" action="./secondary/submit.php" method="POST">
                <img src="./images/go_green.png" width="50">
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
                <?php $database->render_database(); ?>
            </div>
            <!--User Options-->
            <div id="user-options" class="column">
                <!--User Templates-->
                <div>
                    <!--heading-->
                    <div class="row heading" onclick="toggle('template-options')">
                        <img src="./images/plus.png">
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
                        <img src="./images/plus.png">
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