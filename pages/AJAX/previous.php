<?php
$courseCode = $_POST['code'];

$sql = "SELECT FormalCode, Teacher1, SectionName, Time1 FROM old_trimester_data WHERE FormalCode = '$courseCode';";
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=courseassigner', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$statement = $pdo->prepare($sql);
$statement->execute();
$courses = $statement->fetchAll(PDO::FETCH_ASSOC);

$pdo = null;
$statement = null;
echo json_encode($courses);