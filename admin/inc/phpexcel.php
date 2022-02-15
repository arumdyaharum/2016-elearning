<?php
//  Include PHPExcel_IOFactory
include 'Classes/PHPExcel/IOFactory.php';

$inputFileName = $target.$nama_gambar;

//  Read your Excel workbook
try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
} catch(Exception $e) {
    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}

//  Get worksheet dimensions
$sheet = $objPHPExcel->getSheet(1); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();

//  Loop through each row of the worksheet in turn
for ($row = 2; $row <= $highestRow; $row++){ 
    //  Read a row of data into an array
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                    NULL,
                                    TRUE,
                                    FALSE);
    //  Insert row data array into your database of choice here
	print_r($rowData);
	echo $rowData[0][1]."<br>";
	echo $rowData[0][2]."<br>";
	echo $rowData[0][3]."<br>";
	echo $rowData[0][4]."<br>";
	echo $rowData[0][5]."<br>";
	echo $rowData[0][6]."<br>";
	echo $rowData[0][7]."<br>";
	mysqli_query($conn, "INSERT INTO tb_soal_pilgan VALUES('', '$id', '".$rowData[0][1]."', '', '', '".$rowData[0][2]."', '', '".$rowData[0][3]."', '', '".$rowData[0][4]."', '', '".$rowData[0][5]."', '', '".$rowData[0][6]."', '', '".$rowData[0][7]."', now())") or die ($db->error); //echo "sip";
} ?>