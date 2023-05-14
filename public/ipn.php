<?php
require_once __DIR__ . '../../vendor/autoload.php';

use App\Actions\IpnAction;


 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    IpnAction::listen($_POST);
}
