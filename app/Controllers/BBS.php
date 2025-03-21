<?php

namespace App\Controllers;

class BBS extends BaseController {
    public function bbsNewForm() {
        return view('templates/header')
            .view('pages/bbs-form')
            .view('templates/footer');
    }

    public function createBbs() {

    }

}