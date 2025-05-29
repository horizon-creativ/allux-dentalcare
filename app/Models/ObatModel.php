<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatModel extends Model
{
    protected $table = 'tb_obat';
    protected $primaryKey = 'id_obat';

    protected $useSoftDeletes = true;

    protected $allowedFields = ['name_obat', 'desc_obat', 'price_obat'];

    protected $useTimestamps = true;
}
