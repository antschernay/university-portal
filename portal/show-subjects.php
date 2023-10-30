<?php

//display table

if ( mysqli_num_rows($getSubjects) != 0 ) {
        echo "<table class=table table-bordered>";
        echo    '<tr class="table-primary">';
        echo        '<th scope="col">Course</th>';
        echo        '<th scope="col">Name</th>';
        echo        '<th scope="col">Credits</th>';
        echo        '<th scope="col">Lectures</th>';
        echo        '<th scope="col">Lessons</th>';
        echo        '<th scope="col">Form of completion</th>';
        echo        '<th scope="col">Anotation</th>';
        echo    "</tr>";
    
    
        while( $row = mysqli_fetch_array($getSubjects))
        {

            echo "<tr>";
                echo "<td class='align-middle'>" . $row['zkratka_predmetu'] . "</td>";
                echo "<td class='align-middle'>" . $row['nazev'] . "</td>";
                echo "<td class='align-middle'>" . $row['pocet_kreditu'] . "</td>"; 
                echo "<td class='align-middle'>" . $row['pocet_hodin_prednasek'] . "</td>"; 
                echo "<td class='align-middle'>" . $row['pocet_hodin_cviceni'] . "</td>"; 
                echo "<td class='align-middle'>" . $row['ukonceni'] . "</td>"; 
                echo "<td class='align-middle'>" . $row['anotace'] . "</td>";                
            echo "</tr>";
        }
    }
    
    else {
        echo "<tr>";
        echo '<td>No subjects.</td>';
        echo "</tr>";
    }
    
    echo "</table>";