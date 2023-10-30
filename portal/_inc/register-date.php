<?php

    require 'connect.php';
    require 'functions.php';
    session_start();

    $id = $_GET['id'];
    $student = $_SESSION['userid'];

    $register = "INSERT INTO zapsane_terminy(id_terminu, kod_studenta)
                 VALUES ('$id', '$student');";

    dbAction($con, $register);

    header("Location: ../exams-stu.php");
    exit();