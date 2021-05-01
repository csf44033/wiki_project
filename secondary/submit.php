<?php
require_once "database.php";
$database = new Database();
$database->handle_post();
header("Location: http://localhost/project/index.php");
exit;