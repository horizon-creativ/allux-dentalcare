<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table = 'tb_invoice';
    protected $primaryKey = 'id_invoice';

    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_booking', 'no_invoice', 'code_booking', 'date_booking', 'keluhan_booking', 'name_dokter', 'phone_dokter', 'name_pasien', 'phone_pasien', 'status_invoice'];

    protected $useTimestamps = true;
}
