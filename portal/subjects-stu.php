<?php
    include '_partials/header.php';

    if ( ! isset($_SESSION["userid"])) {show_403();}

    //we need the details of those courses, which a student has registered for
    $sql_subjects = 'SELECT * FROM studenti_predmety 
    INNER JOIN predmety
    ON predmety.zkratka_predmetu = studenti_predmety.zkratka_predmetu 
    WHERE kod_studenta = "'.$_SESSION["userid"].'"';
    $getSubjects = mysqli_query($con, $sql_subjects);


    include 'show-subjects.php';
