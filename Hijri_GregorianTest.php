<?php
include "Hijri_GregorianConvert.class";
$DateConv=new Hijri_GregorianConvert;
$format="YYYY/MM/DD";
//$date="1988/07/24";
header('Content-type: application/json');
//echo "src: $date<br>";
$date = $_POST['date'];
$newdate = explode ("-",$DateConv->GregorianToHijri($date,$format));
switch($newdate['1']){
	case 1 :
	$mon = "محرم";
	break;
	case 2 :
	$mon = "صفر";
	break;
	case 3:
	$mon = 'جمادي الاول';
	break;
	case 4:
	$mon = 'جمادي الثاني';
	break;
	case 5:
	$mon = 'ربيع الاول';
	break;
	case 6:
	$mon = 'ربيع الثاني';
	break;
	case 7:
	$mon = 'رجب';
	break;
	case 8:
	$mon = 'شعبان';
	break;
	case 9:
	$mon = 'رمضان';
	break;
	case 10:
	$mon = 'شوال';
	break;
	case 11:
	$mon = 'ذي القعدة';
	break;
	case 12:
	$mon = 'ذي الجحة';
	break;
	
}
echo json_encode($newdate['0'] . "-" . $mon . "-" . $newdate['2']);
?>