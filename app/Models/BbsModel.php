<?php

namespace App\Models;

use CodeIgniter\Model;

class BbsModel extends Model
{
    protected $table = 'bbs';
    protected $primaryKey = 'bbs_id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['title', 'content', 'view', 'member_id'];

    public function getBbs($bbsId)
    {
        return $this->find($bbsId);
    }
    public function getBbsPage() {
        return $this->findAll();
    }
    public function getBbsPageWithSearch($search) {
        return $this->where('title', $search)->findAll();
    }


}