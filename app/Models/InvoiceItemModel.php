<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceItemModel extends Model
{
    protected $table = 'tb_invoice_item';
    protected $primaryKey = 'id_invoice_item';

    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_invoice', 'name_item', 'desc_item', 'type_item', 'price_item', 'qty_item', 'total_item'];

    protected $useTimestamps = true;
}
