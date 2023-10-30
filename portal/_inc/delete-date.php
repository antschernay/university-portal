<?php
   require 'connect.php';
   require 'functions.php';

    $delete = "DELETE FROM vypsane_terminy WHERE id_terminu='".$_POST['id']."';";

    dbAction($con, $delete);
    
    header("Location: ../exams-teach.php");
    exit();