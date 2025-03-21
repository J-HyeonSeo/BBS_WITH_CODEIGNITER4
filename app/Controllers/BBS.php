<?php

namespace App\Controllers;

class BBS extends BaseController {
    public function new() {
        return view('templates/header')
            .view('pages/bbs-form')
            .view('templates/footer');
    }
}