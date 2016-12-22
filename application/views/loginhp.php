<?php
//memberi pengalamatan khusus untuk json
//header('Content-Type: application/json', true);
header('Content-type: application/json, charset=utf-8');
//memanggil database
$records = array();
//foreach ($datas->result() as $row){
	//$records[] = $row;
//}
 
//menuliskannya dalam bentuk json menggunakan fungsi json_encode
//echo $_POST['jsoncallback'] . '(' . json_encode($records) . ');';
echo '{ '.'"records":'.json_encode($datas).'}';

?>