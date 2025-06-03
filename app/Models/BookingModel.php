<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'tb_booking';
    protected $primaryKey = 'id_booking';

    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_user', 'id_slot_jadwal', 'id_layanan', 'code_booking', 'date_booking', 'keluhan_booking', 'status_booking'];

    protected $useTimestamps = true;
}
