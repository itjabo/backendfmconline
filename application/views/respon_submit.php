<?php
header('Content-type: application/json, charset=utf-8');

echo '{ '.'"records":['.json_encode($respon).']}';

?>