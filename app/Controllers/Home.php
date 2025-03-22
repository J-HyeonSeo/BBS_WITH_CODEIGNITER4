<?php

namespace App\Controllers;

use App\Models\BbsModel;

class Home extends BaseController
{
    private $bbsModel;

    public function __construct() {
        $this->bbsModel = new BbsModel();
    }

    // 게시글 목록 조회
    public function index(): string
    {
        $search = $this->request->getGet('search') ?? '';
        $data = [
            'bbsList' => $this->bbsModel
                ->join('member', 'member.member_id = bbs.member_id')
                ->like('title', $search)
                ->orderBy('bbs_id', 'DESC')
                ->paginate(10),
            'search' => $search,
            'pager' => $this->bbsModel->pager,
            'start' => max(1, $this->bbsModel->pager->getCurrentPage() - 2),
            'end' => min($this->bbsModel->pager->getLastPage(), $this->bbsModel->pager->getCurrentPage() + 2)
        ];

        return view('templates/header', $data)
            .view('main')
            .view('templates/footer');
    }
}
