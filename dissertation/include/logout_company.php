<?php

session_start();

session_destroy();
header('Location:/dissertation/company/index.php');
exit;

?>