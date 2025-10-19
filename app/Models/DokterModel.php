<?php

namespace App\Models;

use CodeIgniter\Model;

class DokterModel extends Model
{
    protected $table = 'tb_dokter';
    protected $primaryKey = 'id_dokter';

    protected $useSoftDeletes = true;

    protected $allowedFields = ['email_dokter', 'password_dokter', 'name_dokter', 'phone_dokter', 'address_dokter', 'level_dokter', 'img_dokter'];

    protected $useTimestamps = true;
}
