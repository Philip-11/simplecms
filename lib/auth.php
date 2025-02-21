<?php 

//This checks if you're logged in
require_once 'common.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true)
{
    header("Location: " . BASE_URL . "login.php");
    exit();
}