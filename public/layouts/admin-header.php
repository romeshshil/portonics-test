<?php
require_once __DIR__ . '../../../vendor/autoload.php';

use App\Helper\Redirect;

include_once './layouts/header.php'; 
include_once './layouts/nav.php'; 

if(!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']){
    Redirect::toLogin();
}
?>
