<?php
   require 'connect.php';
   require 'functions.php';

    $affected = "UPDATE vypsane_terminy
    SET zkratka_mistnosti = '".$_POST['room']."', zkratka_predmetu = '".$_POST['subject']."', datum_cas = '".$_POST['date']."',
        max_pocet_prihlasenych = '".$_POST['max_number']."', poznamka='".$_POST['note']."'
    WHERE id_terminu='".$_POST['id']."';";


    dbAction($con, $affected);
    
    header("Location: ../exams-teach.php");
    exit();