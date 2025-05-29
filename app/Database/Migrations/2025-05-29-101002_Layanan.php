<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Layanan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_layanan' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'name_layanan' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'desc_layanan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'price_layanan' => [
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
        $this->forge->addPrimaryKey('id_layanan');
        $this->forge->createTable('tb_layanan');
    }

    public function down()
    {
        $this->forge->dropTable('tb_layanan');
    }
}
