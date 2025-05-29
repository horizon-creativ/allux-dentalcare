<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jadwal extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jadwal' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'id_user' => [
                'type' => 'INT',
                'null' => false,
            ],
            'day_jadwal' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
                'null' => false,
            ],
            'start_jadwal' => [
                'type' => 'TIME',
                'null' => false,
            ],
            'end_jadwal' => [
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
        $this->forge->addPrimaryKey('id_jadwal');
        $this->forge->createTable('tb_jadwal');
    }

    public function down()
    {
        $this->forge->dropTable('tb_jadwal');
    }
}
