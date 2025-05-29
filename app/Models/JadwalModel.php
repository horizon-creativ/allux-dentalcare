<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = 'tb_jadwal';
    protected $primaryKey = 'id_jadwal';

    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_user', 'day_jadwal', 'start_jadwal', 'end_jadwal'];

    protected $useTimestamps = true;
}
