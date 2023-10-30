<?php
    require 'config.php';

//database connection
$con = mysqli_connect($host, $user , $password, $database);
$con->set_charset("utf8");

//check the connection
if (mysqli_connect_errno()) {
    echo "Failed to connect: " . $mysqli -> connect_error;
    exit();

}