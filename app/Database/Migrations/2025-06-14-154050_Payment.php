<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Payment extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_payment' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'id_invoice' => [
                'type' => 'INT',
                'null' => false,
            ],
            'type_payment' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => false,
            ],
            'amount_payment' => [
                'type' => 'DOUBLE',
                'null' => false,
            ],
            'change_payment' => [
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
        $this->forge->addPrimaryKey('id_payment');
        $this->forge->createTable('tb_payment');
    }

    public function down()
    {
        $this->forge->dropTable('tb_payment');
    }
}
