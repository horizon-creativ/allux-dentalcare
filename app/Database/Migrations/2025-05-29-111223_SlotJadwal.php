<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SlotJadwal extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_slot_jadwal' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'id_jadwal' => [
                'type' => 'INT',
                'null' => false,
            ],
            'time_slot' => [
                'type' => 'TIME',
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
        $this->forge->addPrimaryKey('id_slot_jadwal');
        $this->forge->createTable('tb_slot_jadwal');
    }

    public function down()
    {
        $this->forge->dropTable('tb_slot_jadwal');
    }
}
