<?php include '_partials/header.php';


if ( ! isset($_SESSION["userid"])) {show_403();}


//sql queries we'll need in our forms

$sql_rooms = 'SELECT * FROM mistnosti';
$getRooms = mysqli_query($con, $sql_rooms);

$sql_subjects = 'SELECT * FROM pedagogove_predmety WHERE kod_pedagoga = "'.$_SESSION["userid"].'";';
$getSubjects = mysqli_query($con, $sql_subjects);

$sql_dates = 'SELECT * FROM vypsane_terminy 
    WHERE kod_pedagoga = "'.$_SESSION["userid"].'" 
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
        echo "<tr>";
            echo "<td class='align-middle'>" . $row['zkratka_mistnosti'] . "</td>";
            echo "<td class='align-middle'>" . $row['zkratka_predmetu'] . "</td>";
            echo "<td class='align-middle'>" . date('d/m/Y, H:i', strtotime($row['datum_cas'])) . "</td>";
            echo "<td class='align-middle'>" . registeredCount($con, $row['id_terminu']) . "/" . $row['max_pocet_prihlasenych'] . "</td>";
            echo "<td class='align-middle'>" . $row['poznamka'] . "</td>"; 
            echo "<td style='text-align:right' class='align-middle'>";
            if (passedDate($row['datum_cas']) === true) {
                echo "<a href='#' class='btn btn-outline-secondary me-2'>Add results</a>";
                echo "<a href='delete-form.php?id=".$row['id_terminu']."' class='delete-link'><i class='fas fa-ban me-3'></i></a>";              
            }
            else {        
                echo  "<a href='edit-form.php?id=".$row['id_terminu']."' class='edit-link'><i class='far fa-edit me-3'></i></a>
                    <a href='delete-form.php?id=".$row['id_terminu']."' class='delete-link'><i class='fas fa-ban me-3'></i></a>";
            }
            echo "</td>"; 
        echo "</tr>";
    }
}

else {
    echo "<tr>";
    echo '<td>No examination dates.</td>';
    echo "</tr>";
}

echo "</table>";

?>


    <br>
    <a href='add-form.php' class='btn btn-outline-secondary mt-4' id='add-new'>Add New</a>

</div>

<?php include '_partials/footer.php';
