<?php
$pdo = require_once "../databaseConnector.php";

$faculty = $_POST['faculty'];
$course = $_POST['course'];
$section = $_POST['section'];
//$sql = "UPDATE classroutine SET Teacher1 = '$faculty' WHERE FormalCode = '$course' AND SectionName = '$section';";
$statement = $pdo->prepare("UPDATE classroutine SET Teacher1 = '$faculty' WHERE FormalCode = '$course' AND SectionName = '$section';");
$statement->execute();

echo $faculty.'  '.$course.'  '.$section;
