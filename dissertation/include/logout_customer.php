<?php

session_start();

session_destroy();
header('Location:/dissertation/login.php');
exit;

?>