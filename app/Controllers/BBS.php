<?php

namespace App\Controllers;

use App\Models\BbsModel;
use mysql_xdevapi\Session;

class BBS extends BaseController {

    private $session;

    public function __construct() {
        $this->session = session();
    }

    // 게시글 단건 조회 + Comment 페이징 조회
    public function getBbs() {

    }

    public function bbsNewForm() {

        if (!$this->session->has('member_id')) {
            $this->response->redirect('/login');
        }

        return view('templates/header')
            .view('pages/bbs-form')
            .view('templates/footer');
    }

    // 글 신규 작성.
    public function createBbs() {

        // 사용자 ID 가져오기
        if (!$this->session->has('member_id')) {
            $this->response->redirect('/login');
        }
        $member_id = $this->session->get('member_id');

        // 데이터 가져오기
        $data = $this->request->getJSON();
        $bbsTitle = $data->bbsTitle;
        $content = $data->content;

//        // 밸리데이션 Rule 정의
//        $bbsValidation = [
//            '$bbsTitle' =>'required|max_length[30]',
//            '$content' => 'required|max_length[4000]',
//        ];
//
//        // 다시 작성하도록..!
//        if (!$this->validate($bbsValidation)) {
//            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
//        }

        // 게시글 저장 수행.
        $bbs = new BBSModel();

        $bbs -> insert([
            'title' => $bbsTitle,
            'content' => $content,
            'view' => 0,
            'member_id' => $member_id
        ]);

        return $this->response->redirect('/');
    }

}