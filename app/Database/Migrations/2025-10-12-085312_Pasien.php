<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pasien extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pasien' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'email_pasien' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => false,
            ],
            'password_pasien' => [
                'type' => 'TEXT',
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
            'address_pasien' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'level_pasien' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
            ],
            'img_pasien' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'after' => 'address_pasien',
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
        $this->forge->addPrimaryKey('id_pasien');
        $this->forge->createTable('tb_pasien');
    }

    public function down()
    {
        $this->forge->dropTable('tb_pasien');
    }
}
