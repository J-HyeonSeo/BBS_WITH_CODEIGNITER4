<?php

namespace App\Controllers;

class Login extends BaseController {
    public function login() {
        return view('templates/header')
            .view('pages/login')
            .view('templates/footer');
    }

}