<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table = 'member';
    protected $primaryKey = 'member_id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['username', 'password', 'nickname'];
}