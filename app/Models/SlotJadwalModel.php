<?php

namespace App\Models;

use CodeIgniter\Model;

class SlotJadwalModel extends Model
{
    protected $table = 'tb_slot_jadwal';
    protected $primaryKey = 'id_slot_jadwal';

    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_jadwal', 'time_slot'];

    protected $useTimestamps = true;
}
