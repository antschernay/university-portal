<?php
    require './_inc/connect.php';
  
    $sql_capacity='SELECT kapacita FROM mistnosti WHERE zkratka_mistnosti="'.$_POST['roomID'].'";';
    $result=mysqli_query($con,$sql_capacity);
    $row = mysqli_fetch_array($result);
?>


    <script>
        //adding attributes to given element
        document.getElementById("max_number").max = <?php echo $row['kapacita']?> ;
        document.getElementById("max_number").value = <?php echo $row['kapacita']?> ;
    </script>