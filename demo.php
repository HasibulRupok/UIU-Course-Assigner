<?php
require_once "xlsx.php";

$excel=SimpleXLSX::parse("file.xlsx");
// echo "<pre>";
// print_r($excel->rows());
// echo "</pre>";

$count = 0;
echo '<table border="1" cellpadding="3" style="border-collapse: collapse">';
	foreach( $excel->rows() as $r ) {
		echo '<tr><td>'.implode('</td><td>', $r ).'</td></tr>';
        $count += 1;
        if($count == 5){
            break;
        }
	}
	echo '</table>';

// $rows = $excel->rows();

// unset($rows[0]);

 foreach($rows as $row){
     foreach($row as $data){
         echo $data."<br>";
     }
 }



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Hello World</h1>

</body>

</html>