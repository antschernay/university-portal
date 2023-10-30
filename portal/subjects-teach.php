<?php
    include '_partials/header.php';

    if ( ! isset($_SESSION["userid"])) {show_403();}

    //we need the details of the courses taught by the teacher that is logged in
    $sql_subjects = 'SELECT * FROM pedagogove_predmety 
    INNER JOIN predmety
    ON predmety.zkratka_predmetu = pedagogove_predmety.zkratka_predmetu 
    WHERE kod_pedagoga = "'.$_SESSION["userid"].'"';
    $getSubjects = mysqli_query($con, $sql_subjects);


    include 'show-subjects.php';

