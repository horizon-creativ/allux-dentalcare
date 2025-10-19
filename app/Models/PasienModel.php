<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $table = 'tb_pasien';
    protected $primaryKey = 'id_pasien';

    protected $useSoftDeletes = true;

    protected $allowedFields = ['email_pasien', 'password_pasien', 'name_pasien', 'phone_pasien', 'address_pasien', 'level_pasien', 'img_pasien'];

    protected $useTimestamps = true;
}
