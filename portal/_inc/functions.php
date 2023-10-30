<?php


    //login functions

    function userExists($con, $user_id) {
        $sql = "SELECT kod_pedagoga, heslo FROM pedagogove WHERE kod_pedagoga = ? 
            UNION SELECT kod_studenta, heslo FROM studenti WHERE kod_studenta = ?;";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header('location: index.php?error=stmtfailed');
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $user_id, $user_id);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        } else {
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }
    

    function emptyInputLogin($user_id, $user_password) {
        if (empty($user_id) || empty($user_password)) {
            return true;
        }
        else {
            return false;
        }

    }


    function loginUser($con, $user_id, $user_password) {
        $userExists = userExists($con, $user_id);

        if ($userExists === false) {
            header('location: index.php?error=wronglogin');
            exit();
        }

        $passHashed = $userExists["heslo"];
        $checkPassword = password_verify($user_password, $passHashed);

        if ($checkPassword === false) {
            header('location: index.php?error=wronglogin');
            exit();
        }

        else if ($checkPassword === true) {
            session_start();
            $_SESSION["userid"] = $userExists["kod_pedagoga"];
            header('location: home.php');
            exit();
        }
    }


    function userType($user) {
        $letters = str_split($user);       
        return $letters[0];
    }


    //form action function
   
    function dbAction($con, $action) {
        if ( ! mysqli_query($con,$action) ) {
            echo 'Something went wrong.';
        }
        else {
            echo 'Success!';
        }
    }


    //error functions

    function show_403()
    {
        http_response_code(403);
        include_once '403.php';
        die();
    }


    //functions used on exams-teach page

    function show_404()
    {
        http_response_code(404);
        include_once '404.php';
        die();
    }


    
    function passedDate($examDate) {
        $today = date("Y-m-d H:i:s");
        $today_time = strtotime($today);
        $exam_time = strtotime($examDate);
        if ($today_time > $exam_time) {
            return true;
        }
        else {
            return false;
        }
    }

    
    //function used on both exams-stu and exams-teach page
    function registeredCount($con, $id) {
        $count = "SELECT * FROM zapsane_terminy WHERE id_terminu = '".$id."';";
        $getRows = mysqli_query($con, $count);
        $result = mysqli_num_rows($getRows);
        return $result;
    }


    //functions used on exams-stu page 

    function registeredDate($con, $user_id, $date_id) {
        $sql = "SELECT * FROM zapsane_terminy WHERE kod_studenta = '$user_id' AND id_terminu = '$date_id';";
        $getRows = mysqli_query($con, $sql);
        $result = mysqli_num_rows($getRows);
        if ($result == 0) {
            return false;
        } 
        else {
            return true;
        };
    }


    function fullDate($signed, $capacity) {
        if ($signed >= $capacity) {
            return true;
        }
        else {
            return false;
        }
    }


    function registeredForSubject($con, $student_id, $subject) {
        $sql = "SELECT * FROM zapsane_terminy 
        INNER JOIN vypsane_terminy 
        ON vypsane_terminy.id_terminu = zapsane_terminy.id_terminu 
        WHERE kod_studenta = '$student_id' AND zkratka_predmetu = '$subject'";
        $getRows = mysqli_query($con, $sql);
        $result = mysqli_num_rows($getRows);
        if ($result == 0) {
            return false;
        } 
        else {
            return true;
        }
    }


   