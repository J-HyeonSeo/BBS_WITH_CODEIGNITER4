<?php

namespace App\Controllers;

use App\Models\BbsModel;
use App\Models\CmntModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Cmnt extends BaseController
{
    private $session;
    private $cmntModel;
    private $bbsModel;

    public function __construct() {
        $this->session = session();
        $this->cmntModel = new CmntModel();
        $this->bbsModel = new BBSModel();
    }

    // 신규 댓글을 등록한다.
    public function createCmnt($bbsId = null) {

        // 로그인 안했으면, 리다이렉션
        if (!$this->session->has('member_id')) {
            return $this->response->redirect('/login');
        }

        // 필요한 정보 가져오기.
        $cmntCn = $this->request->getPost('cmnt-input');
        $memberId = $this->session->get('member_id');

        // 게시글 조회
        $bbs = $this->bbsModel->find($bbsId);
        if (is_null($bbs)) {
            throw PageNotFoundException::forPageNotFound();
        }

        // 댓글 저장 및 페이지 리다이렉션
        $this->cmntModel->insert([
            'member_id' => $memberId,
            'bbs_id' => $bbsId,
            'cmnt_cn' => $cmntCn
        ]);

        return $this->response->redirect('/bbs/' . $bbsId);
    }

    // 댓글 삭제하기.
    public function deleteCmnt($cmntId = null) {
        if (!$this->session->has('member_id')) {
            return $this->response->redirect('/login');
        }

        $cmnt = $this->cmntModel->find($cmntId);

        if (is_null($cmnt)) {
            throw PageNotFoundException::forPageNotFound();
        }

        if ($cmnt['member_id'] != $this->session->get('member_id')) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->cmntModel->delete($cmntId);

        return $this->response->redirect('/bbs/' . $cmnt['bbs_id']);
    }

}