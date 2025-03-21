<?php

namespace App\Controllers;

class BBS extends BaseController {
    public function bbs_new_form() {
        return view('templates/header')
            .view('pages/bbs-form')
            .view('templates/footer');
    }

    public function create_bbs() {

    }

}