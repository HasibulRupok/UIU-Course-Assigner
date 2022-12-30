<?php
$dropThreashold = $_POST['dropTh'];
$sql = "SELECT FormalCode, Title, SectionName, Time1 FROM classroutine WHERE Occupied <= '$dropThreashold' AND Teacher1 = '';";

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=courseassigner', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$statement = $pdo->prepare($sql);
$statement->execute();
$courses = $statement->fetchAll(PDO::FETCH_ASSOC);

$json = json_encode($courses);

//if (str_contains($json, 'Array to string conversion in')) {
//    echo 'true';
//}
echo $json;
