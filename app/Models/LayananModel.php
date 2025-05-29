<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananModel extends Model
{
    protected $table = 'tb_layanan';
    protected $primaryKey = 'id_layanan';

    protected $useSoftDeletes = true;

    protected $allowedFields = ['name_layanan', 'desc_layanan', 'price_layanan'];

    protected $useTimestamps = true;
}
