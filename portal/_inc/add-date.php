<?php
    require 'connect.php';
    require 'functions.php';
    session_start();

    $room = $_POST['room'];
    $teacher = $_SESSION['userid'];
    $subject = $_POST['subject'];
    $date = $_POST['date'];
    $max_number = $_POST['max_number'];
    $note = $_POST['note'];

    $add = "INSERT INTO vypsane_terminy (zkratka_mistnosti, kod_pedagoga, zkratka_predmetu, datum_cas, max_pocet_prihlasenych, poznamka) 
            VALUES ('$room', '$teacher', '$subject', '$date', '$max_number', '$note');";

    dbAction($con, $add);

    header("Location: ../exams-teach.php");
    exit();