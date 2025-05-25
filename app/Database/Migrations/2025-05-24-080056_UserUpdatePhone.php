<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserUpdatePhone extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tb_user', [
            'phone_user' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'after' => 'name_user',
                'null' => false,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tb_user', ['phone_user']);
    }
}
