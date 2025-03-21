<?php

namespace App\Controllers;

class Login extends BaseController {
    public function loginForm() {
        return view('templates/header')
            .view('pages/login')
            .view('templates/footer');
    }

    public function doLogin() {

    }

}