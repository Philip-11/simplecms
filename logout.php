<?php 

require_once 'lib/common.php';

session_unset();
session_destroy();

header("Location: index.php");
exit();