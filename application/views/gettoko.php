<?php
header('Content-type: application/json, charset=utf-8');
$records = array();
foreach ($data_query->result() as $row){
	$records[] = $row;
}
echo '{ '.'"records":'.json_encode($records).'}';

?>