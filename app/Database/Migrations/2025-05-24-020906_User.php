<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'email_user' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => false,
            ],
            'password_user' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'name_user' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'address_user' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'level_user' => [
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
        $this->forge->addPrimaryKey('id_user');
        $this->forge->createTable('tb_user');
    }

    public function down()
    {
        $this->forge->dropTable('tb_user');
    }
}
