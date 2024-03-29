<?php
$pdo = require_once "databaseConnector.php";

$sql = "SELECT Name, serial, TeacherCode FROM employee;";
$statement = $pdo->prepare($sql);
$statement->execute();
$facultys = $statement->fetchAll(PDO::FETCH_ASSOC);
$facCounter = 0;

$initialFacSerial = $facultys[0]['serial'];
$lastFacSerial = $facultys[count($facultys) - 1]['serial'];

$sql = "SELECT FormalCode, Title, SectionName, Day1, Day2, Time1 FROM classroutine;";
$statement = $pdo->prepare($sql);
$statement->execute();
$courses = $statement->fetchAll(PDO::FETCH_ASSOC);
$courseIdCounter = 0;

$temp = 0;
$xx = '';
$xy = '';
$rowCounterId = 0;

//echo "<pre>";
//var_dump($courses[19]);
//echo "</pre>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="CSS/full.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>UIU Course Assigner</title>
</head>

<body>
    <!-- allart div  -->
    <div id="allartDiv" class="allartDiv" style="display: none ;">
        <h3 class="font-black text-4xl">*WARNING*</h3>
        <h4 id="ErrorStatus" class="font-black text-2xl mt-3"></h4>
        <button onclick="errorBtn()">OKAY</button>
    </div>

    <!-- navbar -->
    <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900" id="navBar">
        <div class="container flex flex-wrap justify-between items-center mx-auto">
            <a href="#" class="flex items-center">
                <img src="uiu.png" class="mr-3 h-6 sm:h-9" alt="UIU Course Assigner">
                <span class="self-center text-xl font-bold whitespace-nowrap topTogo">Course
                    Assigner<span>
            </a>

            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="#" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent disbale" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="newTrimester.php" class="block py-2 pr-4 pl-3 text-white rounded block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-white dark:hover:text-blue-700 dark:hover:text-white md:dark:hover:bg-transparent hoverLink">New
                            Trimester</a>
                    </li>
                    <li>
                        <a href="pages/findCourse.html" class="block py-2 pr-4 pl-3 text-white rounded block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-white dark:hover:text-blue-700 dark:hover:text-white md:dark:hover:bg-transparent hoverLink">Find Course</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- buttons -->
    <section class="width95 mt-1" id="buttonSection">
        <div class="float-right mb-1" style="display: flex;">
            <button class="homeBtn" onclick="updateDb()" title="Save changes in Database">Save changes</button>
            <form method="post" action="Ajax/downloadExcel.php"><Button class="homeBtn" id="exportBtn" type="submit" title="Download as excel">Export</Button></form>
        </div>
    </section>

    <!-- table -->
    <section class="width95 flex">
        <div class="tableContainer">
            <table class="table">
                <thead>
                    <th class="w12">Name</th>
                    <th class="w8">ABR</th>
                    <th class="w20">Saturday</th>
                    <th class="w20">Sunday</th>
                    <th class="w20">Tuesday</th>
                    <th class="w20">Wednesday</th>
                </thead>
                <tbody>
                    <?php foreach ($facultys as $fac) : ?>
                        <tr>
                            <td class="w12"> <?php echo $fac['Name']; ?>
                                <input type="text" class="hidden" value="<?php echo $fac['serial']; ?>" id="<?php echo $facCounter . '-fac' ?>" name="faculty">
                            </td>
                            <td class="w8" id="<?php echo $fac['serial'] . '-name'; ?>"> <?php echo $fac['TeacherCode']; ?></td>

                            <td class="w20" ondrop="dragDrop(event)" ondragover="allowDrop(event)" id="<?php echo $fac['serial'] . '-0'; ?>"></td>
                            <td class="w20" ondrop="dragDrop(event)" ondragover="allowDrop(event)" id="<?php echo $fac['serial'] . '-1'; ?>"></td>
                            <td class="w20" ondrop="dragDrop(event)" ondragover="allowDrop(event)" id="<?php echo $fac['serial'] . '-2'; ?>"></td>
                            <td class="w20" ondrop="dragDrop(event)" ondragover="allowDrop(event)" id="<?php echo $fac['serial'] . '-3'; ?>"></td>

                            <?php $facCounter++; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="courseList" id="courseListContainer">
            <input type="text" placeholder="Search here..." id="searchText">

            <div ondrop="dragDrop2(event)" ondragover="allowDrop(event)">
                <?php foreach ($courses as $course) : ?>
                    <?php

                    if ($course['Day1'] == "Wed") {
                        $course['Day1'] = 'W';
                    } elseif ($course['Day1'] == "Tue") {
                        $course['Day1'] = 'T';
                    }

                    if ($course['Day2'] == "Tue") {
                        $course['Day2'] = 'T';
                    } elseif ($course['Day2'] == "Wed") {
                        $course['Day2'] = 'W';
                    }

                    if ($course['Day2'] == "") {
                        $crsInfo = $course['Title'] . ' ### ' . '--Section-' . $course['SectionName'] . '-- ### ' . $course['Day1'] . ' ### ' . $course['Time1'];
                    } else {
                        $crsInfo = $course['Title'] . ' ### ' . '--Section-' . $course['SectionName'] . '-- ### ' . $course['Day1'] . ' ### ' . $course['Day2'] . ' ### ' . $course['Time1'];
                    }
                    ?>
                    <p draggable="true" ondragstart="dragStart(event)" class="dgable" id="<?php echo 'cse-' . $courseIdCounter++; ?>"> <?php echo '--' . $course['FormalCode'] . '-- '; ?>
                        <span> <?php echo $crsInfo; ?></span>
                    </p>
                    <!--                        --><?php
                                                    //                        $temp++;
                                                    //                        if($temp == 4) break;
                                                    ?>

                <?php endforeach; ?>

                <!--                    <p draggable="true" ondragstart="dragStart(event)" class="dgable" id="crs-3">CSE-1111-->
                <!--                        <span>Structured Programming Language ### Section-A ### Sun ### W ### 08:30:AM - 10:00:AM</span>-->
                <!--                    </p>-->
                <!---->
                <!--                    <p draggable="true" ondragstart="dragStart(event)" class="dgable" id="crs-0">CSE-1111-->
                <!--                        <span>Structured Programming Language ### Section-A ### Sun ### W ### 08:30:AM - 10:00:AM</span>-->
                <!--                    </p>-->
                <!---->
                <!--                    <p draggable="true" ondragstart="dragStart(event)" class="dgable" id="crs-4">CSE-1111-->
                <!--                        <span>Structured Programming Language ### Section-A ### Sun ### 08:30:AM - 11:00:AM</span>-->
                <!--                    </p>-->
            </div>





        </div>
    </section>

    <script src="JS/index.js"></script>
    <script type="text/javascript">
        // window.addEventListener('beforeunload', () => {
        //     event.preventDefault();
        //     event.returnValue = 'Dude are u sure u wanna erase everything';
        // })

        const rows = <?php echo $rowCounterId; ?>;
        let datas = {};

        const updateDb = () => {
            const initialFacSerial = <?php echo $initialFacSerial; ?>;
            const lastFacSerial = <?php echo $lastFacSerial; ?>;

            for (let i = initialFacSerial; i <= lastFacSerial; i++) {
                let name = document.getElementById(i + "-name").innerText;

                const sat = document.getElementById(i + '-0').innerText;
                const sun = document.getElementById(i + '-1').innerText;
                const tue = document.getElementById(i + '-2').innerText;
                const wed = document.getElementById(i + '-3').innerText;

                if (sat === '' && sun === '' && tue === '' && wed === '') continue;

                let texts = [];
                if (sat !== "") {
                    const sats = sat.split("--");
                    texts = texts.concat(sats);
                }
                if (sun !== "") {
                    const suns = sun.split("--");
                    texts = texts.concat(suns);
                }
                if (tue !== "") {
                    const tues = tue.split("--");
                    texts = texts.concat(tues);
                }
                if (wed !== "") {
                    const weds = wed.split("--");
                    texts = texts.concat(weds);
                }

                let values = [];
                texts.forEach(item => {
                    // add all the couse code here 
                    if (item.includes('CSE') || item.includes('EEE') || item.includes('URC') || item.includes('BIO') || item.includes('ACT') || item.includes('BDS') || item.includes('ENG') || item.includes('IPE') || item.includes('MATH') || item.includes('PHY') || item.includes('PSY') || item.includes('SOC') || item.includes('TEC') || item.includes('Section')) {

                        if (item.includes('Section')) {
                            const secParts = item.split('-');
                            item = secParts[1];
                        }
                        values.push(item);
                    }
                });
                datas[name] = values;
            }

            console.log(datas);
            const keys = Object.keys(datas);

            for (let i = 0; i < keys.length; i++) {
                for (let j = 0; j < datas[keys[i]].length; j += 2) {
                    // write AJAX here with this PRINT data
                    let print = keys[i] + "    course: " + datas[keys[i]][j] + "    section: " + datas[keys[i]][j + 1];

                    console.log(print);
                    $.post("Ajax/insurtFaculty.php", {
                            faculty: keys[i],
                            course: datas[keys[i]][j],
                            section: datas[keys[i]][j + 1]
                        },
                        function(data, status) {
                            if (status) {
                                //        ***DO NOT DELETE THIS IF CONDITION PART, TI MAKES CODE WAIT UNTIL A INSERTION IS DONE***
                                // alert("Data: " + data + "\nStatus: " + status);
                            }

                        });
                }
            }

        }
    </script>

</body>

</html>