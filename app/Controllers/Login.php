<?php

namespace App\Controllers;

use App\Models\MemberModel;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController {

    private $memberModel;
    private $session;

    public function __construct() {
        $this->memberModel = new MemberModel();
        $this->session = session();
    }

    // GET요청으로 로그인 폼을 제공한다.
    public function loginForm() {
        return view('templates/header')
            .view('pages/login')
            .view('templates/footer');
    }

    // POST요청으로 로그인을 수행한다.
    public function doLogin() {

        // form data로 요청 보낸, 데이터 가져오기.
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // 로그인 대상을 가져옴.
        $targetMember = $this->memberModel->findByUsername($username);

        // 유효하지 않는 정보.
        if (!$targetMember || !password_verify($password, $targetMember['password'])) {
            return $this -> response -> redirect('/login');
        }

        // 세션에 로그인 정보 할당하기.
        $this->session->set('member_id', $targetMember['member_id']);
        $this->session->set('nickname', $targetMember['nickname']);

        // 메인 페이지로 리다이렉트
        return $this->response->redirect("/");
    }

    // 세션을 날리고 로그아웃 수행.
    public function doLogout() {
        $this->session->destroy();
        return $this->response -> redirect('/login');
    }

}