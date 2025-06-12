<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Invoice extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_invoice' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'id_booking' => [
                'type' => 'INT',
                'null' => false,
            ],
            'no_invoice' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'code_booking' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'date_booking' => [
                'type' => 'datetime',
                'null' => false,
            ],
            'keluhan_booking' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'name_dokter' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'phone_dokter' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
            ],
            'name_pasien' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'phone_pasien' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
            ],
            'status_invoice' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
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
        $this->forge->addPrimaryKey('id_invoice');
        $this->forge->createTable('tb_invoice');
    }

    public function down()
    {
        $this->forge->dropTable('tb_invoice');
    }
}
