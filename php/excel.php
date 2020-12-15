<?php
session_start();
require 'Connection.php';
mysqli_select_db($link, 'flowershop') or die('Невозможно подключиться к базе данных.'); 
$id = $_SESSION['id_client']; 
$client =  mysqli_query($link, "SELECT * FROM `clients` WHERE `ID_Client`=".$id.";");
$num_rows = mysqli_num_rows($client);
for ($i=0; $i < $num_rows; $i++) { 
while ($row = mysqli_fetch_array($client, MYSQLI_ASSOC)) {
$LN = $row[LastName];
$FN = $row[FirstName];}}
require_once 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/Writer/Excel2007.php';
$xls = new PHPExcel();
$xls->getProperties()->setTitle("Заказы ".$LN." ".$FN."");
$xls->setActiveSheetIndex(0);
$sheet = $xls->getActiveSheet();
$sheet->setTitle('Ваши заказы');
$sheet->getPageSetup()->SetPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
$sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
$sheet->getDefaultStyle()->getFont()->setName('Century Gothic');
$sheet->getDefaultStyle()->getFont()->setSize(24);
$sheet->getColumnDimension("A")->setWidth(15);
$sheet->getColumnDimension("B")->setWidth(20);
$sheet->getColumnDimension("C")->setWidth(25);
$sheet->getColumnDimension("D")->setWidth(18);
$sheet->getColumnDimension("E")->setWidth(20);
$sheet->getRowDimension("1")->setRowHeight(45);
$sheet->getRowDimension("2")->setRowHeight(45);
$sheet->setCellValue("A1", "№ заказа");
$sheet->setCellValue("B1", "Дата");
$sheet->setCellValue("C1", "Товар");
$sheet->setCellValue("D1", "Количество");
$sheet->setCellValue("E1", "Сумма");
$counter = 2;			
 $sql =  mysqli_query($link, "SELECT * FROM `orderShow` WHERE `ID_Client`=".$id.";");
$num_rows = mysqli_num_rows($sql);
for ($i=0; $i < $num_rows; $i++) { 
	while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
		$sheet->setCellValue("A".$counter."", " ".$row[ID_O]." ");
		$sheet->setCellValue("B".$counter."", " ".$row[OrderDate]." ");
		$sheet->setCellValue("C".$counter."", " ".$row[Name]." ");
		$sheet->setCellValue("D".$counter."", " ".$row[Quantity]." ");
		$sheet->setCellValue("E2", " ".$row[Summ]." "); 
		$sheet->getRowDimension("".$counter."")->setRowHeight(45); 
		$counter = $counter + 1;}}	
header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=order.xls");
$objWriter = new PHPExcel_Writer_Excel5($xls);
$objWriter->save('php://output'); 
exit();
?>