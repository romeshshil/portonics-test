<?php

namespace App\Helper;

class Redirect
{

    public static function toHome()
    {
        header('Location: /index.php');
        exit();
    }

    public static function toLogin()
    {
        header('Location: /login.php');
        exit();
    }

    public static function toDetails($id)
    {
        header('Location: /order-details.php?order='.$id);
        exit();
    }

    public static function to($location)
    {
        header('Location: '.$location);
        exit();
    }
}
