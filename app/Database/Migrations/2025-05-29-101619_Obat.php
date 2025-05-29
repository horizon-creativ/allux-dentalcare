<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Obat extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_obat' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'name_obat' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'desc_obat' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'price_obat' => [
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
        $this->forge->addPrimaryKey('id_obat');
        $this->forge->createTable('tb_obat');
    }

    public function down()
    {
        $this->forge->dropTable('tb_obat');
    }
}
