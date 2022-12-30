<?php

$code = $_POST['code'];

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=courseassigner', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT FormalCode, Title, SectionName, Time1 FROM classroutine WHERE FormalCode = '$code' AND Teacher1 = '';";
$statement = $pdo->prepare($sql);
$statement->execute();
$courses = $statement->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($courses);
