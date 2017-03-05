<?php

session_start();

session_destroy();
header('Location:/dissertation/customer/index.php');
exit;

?>