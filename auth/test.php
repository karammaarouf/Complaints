<?php
include("../comploments/connect.php");
include("../comploments/sql.php");
$complaints=getcomplaint(status : "قيد الانتظار");
print_r($complaints);



?>