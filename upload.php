<?php
header("Access-Control-Allow-Origin: *");



$json = array("status" => 0, "images" => 'moka');

header('Content-type: application/json');
echo json_encode($json);
