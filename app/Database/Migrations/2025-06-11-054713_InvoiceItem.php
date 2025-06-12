<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InvoiceItem extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_invoice_item' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'id_invoice' => [
                'type' => 'INT',
                'null' => false,
            ],
            'name_item' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'desc_item' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'type_item' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => false,
            ],
            'price_item' => [
                'type' => 'DOUBLE',
                'null' => false,
            ],
            'qty_item' => [
                'type' => 'INT',
                'null' => false,
            ],
            'total_item' => [
                'type' => 'DOUBLE',
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id_invoice_item');
        $this->forge->createTable('tb_invoice_item');
    }

    public function down()
    {
        $this->forge->dropTable('tb_invoice_item');
    }
}
