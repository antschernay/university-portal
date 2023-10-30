<?php
    include '_partials/header.php';


    if ( ! isset($_SESSION["userid"])) {show_403();}
    

    //dates of examinations of the registered courses 
    $sql_dates = 'SELECT * FROM studenti_predmety 
    INNER JOIN vypsane_terminy
    ON vypsane_terminy.zkratka_predmetu = studenti_predmety.zkratka_predmetu 
    WHERE kod_studenta = "'.$_SESSION["userid"].'"
    ORDER BY vypsane_terminy.zkratka_predmetu, datum_cas;';
    $getDates = mysqli_query($con, $sql_dates);
    

//display table

if ( mysqli_num_rows($getDates) != 0 ) {
    echo "<table class=table table-bordered>";
    echo    '<tr class="table-primary">';
    echo        '<th scope="col">Room</th>';
    echo        '<th scope="col">Subject</th>';
    echo        '<th scope="col">Date</th>';
    echo        '<th scope="col">Capacity</th>';
    echo        '<th scope="col">Note</th>';
    echo        '<th scope="col"> </th>';
    echo    "</tr>";


    while( $row = mysqli_fetch_array($getDates))
    {
        if (passedDate($row['datum_cas']) === true) continue;
        echo "<tr>";
            echo "<td class='align-middle'>" . $row['zkratka_mistnosti'] . "</td>";
            echo "<td class='align-middle'>" . $row['zkratka_predmetu'] . "</td>";
            echo "<td class='align-middle'>" . date('d/m/Y, H:i', strtotime($row['datum_cas'])) . "</td>";
            echo "<td class='align-middle'>" . registeredCount($con, $row['id_terminu']) . "/"  . $row['max_pocet_prihlasenych'] . "</td>";
            echo "<td class='align-middle'>" . $row['poznamka'] . "</td>"; 
            if (registeredDate($con, $row['kod_studenta'], $row['id_terminu']) === false) {
                echo "<td style='text-align:right' class='align-middle'>";                  
                    if (fullDate(registeredCount($con, $row['id_terminu']), $row['max_pocet_prihlasenych']) === true) {
                        echo "<a href='#' class='btn btn-outline-dark disabled me-4'>Full</a>";
                    }
                    else if (registeredForSubject($con, $_SESSION["userid"], $row['zkratka_predmetu']) === true) {
                        echo "<a href='#' class='btn btn-outline-dark disabled me-4'>Register</a>";
                    }
                    else {
                    echo "<a href='_inc/register-date.php?id=".$row['id_terminu']."' class='btn btn-outline-secondary me-4'>Register</a>";
                    }              
                echo "</td>";
            }
            else {
                echo "<td style='text-align:right' class='align-middle'>
                    <a href='_inc/signout-date.php?id=".$row['id_terminu']."' class='btn btn-secondary me-4'>Sign out</a>                  
                    </td>";
            }
        echo "</tr>";
    }
}

else {
    echo "<tr>";
    echo '<td>No examination dates.</td>';
    echo "</tr>";
}

echo "</table>";



include '_partials/footer.php';


