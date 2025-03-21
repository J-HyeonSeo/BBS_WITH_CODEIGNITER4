<?php

namespace App\Models;

use CodeIgniter\Model;

class CmntModel extends Model
{
    protected $table = 'cmnt';
    protected $primaryKey = 'cmnt_id';
    protected $useAutoIncrement = true;
}