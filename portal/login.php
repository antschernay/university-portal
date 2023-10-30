<?php

if (isset($_POST["submit"])) {

    $user_id = $_POST["user_id"];
    $user_password = $_POST["user_password"];


    require_once '_inc/connect.php';
    require_once '_inc/functions.php';


    if (emptyInputLogin($user_id, $user_password) !== false) {
        header('location: index.php?error=emptyinput');
        exit();
    }

    setcookie("cookie", $user_id, time() + 3600);
    loginUser($con, $user_id, $user_password);
}

else {
    header('location: index.php');
    exit();
}
