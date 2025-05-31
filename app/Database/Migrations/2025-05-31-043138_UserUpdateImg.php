<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserUpdateImg extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tb_user', [
            'img_user' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'after' => 'address_user',
                'null' => false,
                'default' => 'default_user.png',
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tb_user', ['img_user']);
    }
}
