<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dokter extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_dokter' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'email_dokter' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => false,
            ],
            'password_dokter' => [
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
            'address_dokter' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'level_dokter' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
            ],
            'img_dokter' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'after' => 'address_dokter',
                'null' => false,
                'default' => 'default_user.png',
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
        $this->forge->addPrimaryKey('id_dokter');
        $this->forge->createTable('tb_dokter');
    }

    public function down()
    {
        $this->forge->dropTable('tb_dokter');
    }
}
