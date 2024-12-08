<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => "Indonesia Open Market"
        ];
        return view('pages/home', $data);
    }
}
