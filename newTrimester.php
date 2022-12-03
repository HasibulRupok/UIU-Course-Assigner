<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_FILES['courseList']['tmp_name'] != "" && $_FILES['facultyList']['tmp_name'] != "" ){
        $courseList = $_FILES['courseList']['tmp_name'];
        $facultyList = $_FILES['facultyList']['tmp_name'];

//        readupload($courseList, "classroutine");
        readupload($facultyList, "employee ");

    }
    // echo "<pre>";
// var_dump();
// echo "</pre>";
}

function readupload($filePath, $tableName){
require_once "xlsx.php";
$excel=SimpleXLSX::parse($filePath);
//    /** @var $pdo PDO */
$pdo = require_once "databaseConnector.php";

$x = 1;
$rows = $excel->rows();
unset($rows[0]);

$sql = "INSERT INTO ".$tableName." VALUES (DEFAULT,";
// finally for course-->>  $sql = "INSERT INTO classroutine VALUES (DEFAULT, '$row[0]', '$row[1]', '$row[2]', '$row[3]', $row[4], $row[5], $row[6], '$row[7]', '$row[8]', '$row[9]', '$row[10]', '$row[11]', '$row[12]', '$row[13]', '$row[14]', '$row[15]', '$row[16]', '$row[17]', '$row[18]', '$row[19]', '$row[20]', '$row[21]', '$row[22]', '$row[23]', '$row[24]', '$row[25]', '$row[26]', '$row[27]', '$row[28]', '$row[29]', '$row[30]', '$row[31]', '$row[32]', '$row[33]', '$row[34]' )";

foreach($rows as $row){
$dataCounter = count($row);

foreach($row as $data){
if($x == $dataCounter) $sql = $sql." '$data' ";
else $sql = $sql." '$data',";
$x += 1;
}

$sql = $sql." )";
$statement = $pdo->prepare($sql);
$statement->execute();
$sql = "INSERT INTO ".$tableName." VALUES (DEFAULT,";
$x = 1;

}

}

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="CSS/full.css">
        <title>New Trimester</title>
    </head>

    <body>
        <!-- navbar -->
        <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900">
            <div class="container flex flex-wrap justify-between items-center mx-auto">
                <a href="#" class="flex items-center">
                    <img src="uiu.png" class="mr-3 h-6 sm:h-9" alt="UIU Course Assigner">
                    <span class="self-center text-xl font-bold whitespace-nowrap topTogo">Course
                        Assigner<span>
                </a>

                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    <ul
                        class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        <li>
                            <a href="index.php"
                                class="block py-2 pr-4 pl-3 text-white rounded block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-white dark:hover:text-blue-700 dark:hover:text-white md:dark:hover:bg-transparent hoverLink"
                                aria-current="page">Home</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent disbale">New
                                Trimester</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <section>
            <div class="centerBtn">
                <button id="newTrimesterBtn" class="btnDesign">Start New Trimester</button>
            </div>

            <div class="centerBtn mt-4">
                <form action="newTrimester.php" method="post" enctype="multipart/form-data">
                    <span>Choose Course List</span>
                    <input type="file" name="courseList" id="" class="inputFile"
                        accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                    <br>
                    <span>Choose Faculty List</span>
                    <input type="file" name="facultyList" id="" class="inputFile"
                        accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                    <br>
                    <button class="btnDesign" id="fileUpload">Upload</button>
                </form>

            </div>
        </section>
        

    </body>

</html>