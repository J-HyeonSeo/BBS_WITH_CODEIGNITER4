<?php

namespace App\Controllers;

class Join extends BaseController {

    public function join() {
        return view('templates/header')
            .view('pages/join')
            .view('templates/footer');
    }

}