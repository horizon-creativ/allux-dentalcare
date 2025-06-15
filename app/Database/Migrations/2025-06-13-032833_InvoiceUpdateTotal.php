<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InvoiceUpdateTotal extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tb_invoice', [
            'total_invoice' => [
                'type' => 'DOUBLE',
                'null' => false,
                'default' => 0,
                'after' => 'phone_pasien',
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tb_invoice', ['total_invoice']);
    }
}
