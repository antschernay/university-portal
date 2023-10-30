<?php
 include_once 'exams-teach.php';

 $sql = "SELECT * from vypsane_terminy WHERE id_terminu='".$_GET['id']."';";
 $getItem = mysqli_query($con, $sql);
 $items = mysqli_fetch_array($getItem);

 if (empty($items)) {show_404();}

?>


 <div class="bg-modal">
    <div class="modal-content">
      <a class="close" href='exams-teach.php'>+</a>
        <h2 class='text-center'>Delete examination date</h2>
        <ul class="list-group list-group-flush text-center p-4">
            <li class="list-group-item">Room: <?php echo $items['zkratka_mistnosti']?></li>
            <li class="list-group-item">Subject: <?php echo $items['zkratka_predmetu']?></li>
            <li class="list-group-item">Date: <?php echo date('d/m/Y, H:i', strtotime($items['datum_cas']))?></li>
            <li class="list-group-item">Capacity : <?php echo $items['max_pocet_prihlasenych']?></li>
            <li class="list-group-item">Note: <?php echo $items['poznamka']?></li>
        </ul>

        <form class='mt-4' action="_inc/delete-date.php" method="post">
          <input name='id' type='hidden' value='<?php echo $_GET['id'] ?>'>  
          <div class='d-flex justify-content-center mt-4'>
            <button type="submit" name="submit" class="btn btn-secondary mt-4" id='add-exam'>Delete</button>
          </div> 
                
        </form>
    </div>
  </div>