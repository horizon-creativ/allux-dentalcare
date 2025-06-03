<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Booking extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_booking' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'id_user' => [
                'type' => 'INT',
                'null' => false,
            ],
            'id_slot_jadwal' => [
                'type' => 'INT',
                'null' => false,
            ],
            'id_layanan' => [
                'type' => 'INT',
                'null' => false,
            ],
            'code_booking' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'date_booking' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'keluhan_booking' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'status_booking' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
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
        $this->forge->addPrimaryKey('id_booking');
        $this->forge->createTable('tb_booking');
    }

    public function down()
    {
        $this->forge->dropTable('tb_booking');
    }
}
