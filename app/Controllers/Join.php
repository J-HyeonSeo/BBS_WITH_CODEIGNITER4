<?php

namespace App\Controllers;

use App\Models\MemberModel;
use Couchbase\BadInputException;

class Join extends BaseController {

    public function joinForm() {
        return view('templates/header')
            .view('pages/join')
            .view('templates/footer');
    }

    // 회원가입을 수행합니다.
    public function doJoin() {

        // 입력 form에서 데이터 추출
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nickname = $_POST['nickname'];

        // 밸리데이션 Rule 정의
        $joinValidation = [
            'username' =>'required|max_length[20]',
            'password' => 'required|max_length[20]',
            'nickname' => 'required|max_length[10]',
        ];
        
        // 400응답 내려주기
        if (!$this->validate($joinValidation)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 비밀번호는 해싱처리
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Member Model 생성하기
        $memberModel = new MemberModel();

        // ORM을 통한 데이터 삽입. (member데이터 추가.)
        $memberModel -> insert([
            'username' => $username,
            'password' => $hashedPassword,
            'nickname' => $nickname
        ]);

        return $this -> response -> redirect('/login');
    }

}