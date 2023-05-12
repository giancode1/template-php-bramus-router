<?php
namespace App\Controllers;

class UserController 
{
    public function index()
    {
        require_once('./resources/views/user.php');
    }
    public function create()
    {
        echo "User Controller Create";
    }

    public static function edit($user)
    {
        echo "edit {$user}";
    }
}

?>