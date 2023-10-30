<?php
   require 'connect.php';
   require 'functions.php';

    session_start();

    $id = $_GET['id'];
    $student = $_SESSION['userid'];

    $signout = "DELETE FROM zapsane_terminy WHERE id_terminu='$id' AND kod_studenta='$student';";

    dbAction($con, $signout);
    
    header("Location: ../exams-stu.php");
    exit();



