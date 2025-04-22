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

    public function itemManagement()
    {
        $data = ['title' => "Item Management"];

        return view("pages/item-management", $data);
    }

    public function createTransaction()
    {
        $data = ['title' => "Create Transaction"];

        return view("pages/create-transaction", $data);
    }

    public function login()
    {
        $data = ['title' => 'Login'];

        return view("pages/auth/login");
    }
}
