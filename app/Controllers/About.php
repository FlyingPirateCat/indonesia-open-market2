<?php

namespace App\Controllers;

class About extends BaseController
{
    public function index()
    {
        $data = [
            'title' => "Indonesia Open Market"
        ];
        return view('about/index', $data);
    }
}
