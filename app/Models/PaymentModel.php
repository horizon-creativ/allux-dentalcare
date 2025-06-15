<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'tb_payment';
    protected $primaryKey = 'id_payment';

    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_invoice', 'type_payment', 'amount_payment', 'change_payment'];

    protected $useTimestamps = true;
}
