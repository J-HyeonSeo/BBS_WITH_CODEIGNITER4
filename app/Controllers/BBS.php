<?php

namespace App\Controllers;

use App\Models\BbsModel;
use App\Models\CmntModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use mysql_xdevapi\Session;

class BBS extends BaseController {

    private $bbsModel;
    private $cmntModel;
    private $session;

    public function __construct() {
        $this->bbsModel = new BbsModel();
        $this->cmntModel = new CmntModel();
        $this->session = session();
    }

    // 게시글 단건 조회 + Comment 페이징 조회
    public function getBbs($bbsId = null) {

        $bbs = $this->bbsModel->find($bbsId);

        if (is_null($bbs)) {
            throw PageNotFoundException::forPageNotFound();
        }

        // 조회수 업데이트
        $this->bbsModel
            ->set('view', $bbs['view'] + 1)
            ->where('bbs_id', $bbsId)
            ->update();

        $data = [
            'bbs' => $bbs,
            'cmntList' => $this->cmntModel
                ->join('member', 'member.member_id = cmnt.member_id')
                ->where('bbs_id', $bbsId)
                ->orderBy('cmnt_id', 'desc')
                ->paginate(5),
            'pager' => $this->cmntModel->pager,
            'start' => max(1, $this->cmntModel->pager->getCurrentPage() - 2),
            'end' => min($this->cmntModel->pager->getLastPage(), $this->cmntModel->pager->getCurrentPage() + 2)
        ];

        return view('templates/header', $data)
            .view('pages/bbs-view')
            .view('templates/footer');
    }

    // 게시판을 등록하는 폼을 제공합니다.
    public function bbsNewForm() {

        if (!$this->session->has('member_id')) {
            return $this->response->redirect('/login');
        }

        return view('templates/header')
            .view('pages/bbs-new-form')
            .view('templates/footer');

    }

    // 게시판을 수정하는 폼을 제공합니다.
    public function bbsEditForm($bbsId = null) {

        if (!$this->session->has('member_id')) {
            return $this->response->redirect('/login');
        }

        $bbs = $this->bbsModel->find($bbsId);

        if (is_null($bbs)) {
            throw PageNotFoundException::forPageNotFound();
        }

        if ($bbs['member_id'] != $this->session->get('member_id')) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'bbs' => $bbs,
        ];

        return view('templates/header', $data)
            .view('pages/bbs-edit-form')
            .view('templates/footer');
    }

    // 글 신규 작성.
    public function createBbs() {

        // 밸리데이션 Rule 정의
        $bbsValidation = [
            'bbsTitle' =>'required|max_length[30]',
            'content' => 'required|max_length[4000]',
        ];

        // 다시 작성하도록..!
        if (!$this->validate($bbsValidation, $this->request->getJSON(true))) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 사용자 ID 가져오기
        if (!$this->session->has('member_id')) {
            return $this->response->redirect('/login');
        }
        $member_id = $this->session->get('member_id');

        // 데이터 가져오기
        $data = $this->request->getJSON();
        $bbsTitle = $data->bbsTitle;
        $content = $data->content;

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

    // 게시판을 수정합니다.
    public function updateBbs($bbsId) {

        // 밸리데이션 Rule 정의
        $bbsValidation = [
            'bbsTitle' =>'required|max_length[30]',
            'content' => 'required|max_length[4000]',
        ];

        // 다시 작성하도록..!
        if (!$this->validate($bbsValidation, $this->request->getJSON(true))) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if (!$this->session->has('member_id')) {
            return $this->response->redirect('/login');
        }

        $bbs = $this->bbsModel->find($bbsId);
        if (is_null($bbs)) {
            throw PageNotFoundException::forPageNotFound();
        }

        if ($bbs['member_id'] != $this->session->get('member_id')) {
            throw PageNotFoundException::forPageNotFound();
        }

        // 내용 가져오기.
        $bbsTitle = $this->request->getJSON()->bbsTitle;
        $content = $this->request->getJSON()->content;

        // 수정된 내용 DB에 반영하기.
        $this->bbsModel->update($bbsId, [
            'title' => $bbsTitle,
            'content' => $content,
        ]);

        return $this->response->redirect('/');
    }

    // 게시판을 삭제합니다.
    public function deleteBbs($bbsId) {

        if (!$this->session->has('member_id')) {
            return $this->response->redirect('/login');
        }

        $bbs = $this->bbsModel->find($bbsId);
        if (is_null($bbs)) {
            throw PageNotFoundException::forPageNotFound();
        }

        if ($bbs['member_id'] != $this->session->get('member_id')) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->bbsModel->delete($bbsId);

        return $this->response->redirect('/');
    }

}