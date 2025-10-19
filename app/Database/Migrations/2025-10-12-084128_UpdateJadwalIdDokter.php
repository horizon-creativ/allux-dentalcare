<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateJadwalIdDokter extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('tb_jadwal', [
            'id_user' => [
                'name' => 'id_dokter',
                'type' => 'INT',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('tb_jadwal', [
            'id_dokter' => [
                'name' => 'id_user',
                'type' => 'INT',
            ],
        ]);
    }
}
