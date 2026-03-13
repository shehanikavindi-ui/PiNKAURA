<?php
include "connection.php";

$MainCat = $_POST["mcat"];

$Sub_rs = Database::search("SELECT * FROM `sub_category` WHERE `main_category_id`='".$MainCat."' ");
$Sub_num = $Sub_rs->num_rows;

$Sub_data = [];
for ($x = 0; $x < $Sub_num; $x++) {
    $Sub_data[] = $Sub_rs->fetch_assoc();
}

echo json_encode($Sub_data);

?>