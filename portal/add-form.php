<?php
 include 'exams-teach.php';
?>

 <div class="bg-modal">
    <div class="modal-content">
      <a class="close" href='exams-teach.php'>+</a>
        <h2 class='text-center'>New examination date</h2>
        <form class='mt-4' action="_inc/add-date.php" method="post">
          <div class='form-row justify-content-between'>
            <div class='form-group col-md-5'>
              <?php

                
                echo '<label for="room">Room:</label>';
                echo '<select name="room" class="form-control" id="room">';
                echo '<option value="" disabled selected>Select room</option>';
                while ($row = mysqli_fetch_assoc($getRooms)) {
                    echo '<option value="'.$row[zkratka_mistnosti].'">'.$row[zkratka_mistnosti].'</option>';              
                }
                echo '</select>'; 
            echo '</div>';

            echo '<div class="form-group col-md-5">';
              echo '<label for="subject">Subject:</label>';
              echo '<select name="subject" class="form-control">';
              echo '<option value="" disabled selected>Select subject</option>';
              while ($row = mysqli_fetch_assoc($getSubjects)) {
                  echo '<option value="'.$row[zkratka_predmetu].'">'.$row[zkratka_predmetu].'</option>';              
              }
              echo '</select>';   
            echo '</div>';   
                
           ?>
          </div>
          <div class='form-row justify-content-between'>
            <div class='form-group col-md-5'>
              <label for="date">Date:</label>
              <input type="datetime-local" name="date" class="form-control" required>
            </div>
            <div class='form-group col-md-5'>
              <label for="max_number">Maximal number of students:</label>
              <input type="number" name="max_number" class="form-control" id="max_number" min="1">        
            </div>
          </div>
          <div class='form-group'>
            <label for="note">Note:</label>
            <textarea class="form-control mx-1" name='note' rows='2'></textarea>
          </div>
          <div class='d-flex justify-content-center mt-4'>
            <button type="submit" name="submit" class="btn btn-secondary mt-4" id='add-exam'>Add</button>
          </div>        
        </form>
    </div>
  </div>

