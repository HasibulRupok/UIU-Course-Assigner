<?php

$pdo = require_once '../databaseConnector.php';
$statement = $pdo->prepare("SELECT * FROM `classroutine`;");
$statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

$output = '
    <table class="table" border="1">
        <tr>
            <td>Program</td>
            <td>FormalCode</td>
            <td>Title</td>
            <td>SectionName</td>
            <td>Capacity</td>
            <td>Occupied</td>
            <td>RegCount</td>
            <td>Room1</td>
            <td>Room2</td>
            <td>Room3</td>
            <td>Room4</td>
            <td>Day1</td>
            <td>Day2</td>
            <td>Day3</td>
            <td>Day4</td>
            <td>Time1</td>
            <td>Time2</td>
            <td>Time3</td>
            <td>Time4</td>
            <td>Campus1</td>
            <td>Campus2</td>
            <td>Campus3</td>
            <td>Campus4</td>
            <td>Teacher1</td>
            <td>Teacher2</td>
            <td>Teacher3</td>
            <td>Teacher4</td>
            <td>ShareProgOne</td>
            <td>ShareProgTwo</td>
            <td>ShareProgThree</td>
            <td>GradeSheetTemplate</td>
            <td>Credits</td>
            <td>IsBlockBeforeRegistration</td>
            <td>IsBlockAfterRegistration</td>
            <td>ShareProgram</td>
        </tr>
';

foreach ($rows as $row){
    $output .= '
        <tr>
            <td>'.$row['Program'].'</td>
            <td>'.$row['FormalCode'].'</td>
            <td>'.$row['Title'].'</td>
            <td>'.$row['SectionName'].'</td>
            <td>'.$row['Capacity'].'</td>
            <td>'.$row['Occupied'].'</td>
            <td>'.$row['RegCount'].'</td>
            <td>'.$row['Room1'].'</td>
            <td>'.$row['Room2'].'</td>
            <td>'.$row['Room3'].'</td>
            <td>'.$row['Room4'].'</td>
            <td>'.$row['Day1'].'</td>
            <td>'.$row['Day2'].'</td>
            <td>'.$row['Day3'].'</td>
            <td>'.$row['Day4'].'</td>
            <td>'.$row['Time1'].'</td>
            <td>'.$row['Time2'].'</td>
            <td>'.$row['Time3'].'</td>
            <td>'.$row['Time4'].'</td>
            <td>'.$row['Campus1'].'</td>
            <td>'.$row['Campus2'].'</td>
            <td>'.$row['Campus3'].'</td>
            <td>'.$row['Campus4'].'</td>
            <td>'.$row['Teacher1'].'</td>
            <td>'.$row['Teacher2'].'</td>
            <td>'.$row['Teacher3'].'</td>
            <td>'.$row['Teacher4'].'</td>
            <td>'.$row['ShareProgOne'].'</td>
            <td>'.$row['ShareProgTwo'].'</td>
            <td>'.$row['ShareProgThree'].'</td>
            <td>'.$row['GradeSheetTemplate'].'</td>
            <td>'.$row['Credits'].'</td>
            <td>'.$row['IsBlockBeforeRegistration'].'</td>
            <td>'.$row['IsBlockAfterRegistration'].'</td>
            <td>'.$row['ShareProgram'].'</td>
        </tr>
    ';
}
$output .= '</table>';

header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=updatedFile.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $output;

