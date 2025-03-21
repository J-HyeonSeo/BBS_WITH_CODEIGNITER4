<?php

namespace App\Models;

use CodeIgniter\Model;

class BbsModel extends Model
{
    protected $table = 'bbs';
    protected $primaryKey = 'bbs_id';
    protected $useAutoIncrement = true;
}