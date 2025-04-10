<?php

namespace App\Controllers;

class PagesController extends BaseController
{
    public function index(): string
    {
        $data = ["title" => "Dashboard"];

        return view('pages/dashboard', $data);
    }
}
