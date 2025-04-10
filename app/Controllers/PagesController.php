<?php

namespace App\Controllers;

class PagesController extends BaseController
{
    public function dashboard()
    {
        $data = ["title" => "Dashboard"];

        return view('pages/dashboard', $data);
    }

    public function userManagement()
    {
        $data = ['title' => "User Management"];

        return view("pages/user-management", $data);
    }
}
