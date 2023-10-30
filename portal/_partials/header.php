<?php 
    require_once './_inc/connect.php';
    require_once './_inc/config.php';
    require_once './_inc/functions.php';    
    session_start();
?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>University of Rhodanos</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600&display=swap" rel="stylesheet">
  <link href='assets/css/style.css' rel="stylesheet" type="text/css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  
  <script type='text/javascript'>
    $(document).ready(function(){

        //set the maximum number of students in a form
        $("#room").change(function(){         
          var room_id=$(this).val();
          $.post('form-data.php', {
            roomID: room_id
          }, function(data) {
            $("#max_number").html(data);
          });         
        });
    });

  </script>

</head>


<body>


    <!--header-->
    <header>
      <nav class="navbar nav-main navbar-expand-md fixed-top">
        <div class="container">
          <div class="collapse navbar-collapse" id="navbarToggle">      
            <div class="navbar-link px-5"> <img src="assets/css/img/logo.png" width='100px' height='100px' alt="Logo spoločnosti"></div>   
            <h1 class="px-5" style="color: rgb(255, 252, 242);">University of Rhodanos</h1> 
          </div>
          <div class="navbar-nav navbar-collapse">
            <?php 
              if (isset($_SESSION["userid"])) {
                  echo "<p class='text-light mt-auto'>".$_SESSION["userid"]."</p>";
                  echo "<a class='nav-link h5 text-light px-5' href='_inc/logout.php'>Sign Out</a>";                     
              } 
              else {
                echo "<a class='nav-link h5 text-light px-5' href='index.php'>Sign In</a>";
              }               
            ?>                         
        </div>    
      </nav>


      <!--nagivation that we can see only if we are logged in-->
      <?php
      if (isset($_SESSION["userid"])) {
        

        echo '<nav class="navbar-light nav-sec navbar navbar-expand-lg">';
            //responsive menu
            echo '<button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse" 
            data-bs-target="#navbarContent" aria-controls="navbarContent" 
            aria-expanded="false" aria-label="Toggle navigation">';
            echo '<span class="navbar-toggler-icon"></span>';
            echo '</button>';

      
          echo '<div class="collapse navbar-collapse" id="navbarContent">';
            echo '<div class="container d-flex justify-content-center">';
              echo '<ul class="navbar-nav list-unstyled">';
                echo '<li class="nav-item align-self-center px-4">';
                  echo '<a class="nav-link text-dark" href="home.php">Home Page</a>';
                echo '</li>';
                echo '<li class="nav-item align-self-center px-4">';
                  echo '<a class="nav-link text-dark" href="#">Personal Data</a>';
                echo '</li>';           
                
                //check the user type
                if (userType($_SESSION["userid"]) === 'S') {
                    echo '<li class="nav-item align-self-center px-4">';
                      echo '<a class="nav-link text-dark" href="subjects-stu.php">Electronic Record of Studies</a>'; 
                    echo '</li>';
                    echo '<li class="nav-item align-self-center px-4">';
                      echo '<a class="nav-link text-dark" href="exams-stu.php">Examinaiton dates</a>';
                    echo '</li>';
                }

                else if (userType($_SESSION["userid"]) === 'T') {
                    echo '<li class="nav-item align-self-center px-4">';
                      echo '<a class="nav-link text-dark" href="subjects-teach.php">My Courses & Research</a>'; 
                    echo '</li>';

                    echo '<li class="nav-item align-self-center px-4">';
                      echo '<a class="nav-link text-dark" href="exams-teach.php">Examinaiton dates</a>';
                    echo '</li>';
                }
              
              echo '</ul>';
            echo '</div>';
          echo '</div>';
        echo '</nav>';

      }
      ?>

    </header>

    <!--main-->
    <main>
        <div class='container'>
      
        
        
        
  