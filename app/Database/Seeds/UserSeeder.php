<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use App\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();

        $userData = [
            'email_user' => 'superadmin@gmail.com',
            'password_user' => password_hash('superadmin123', PASSWORD_DEFAULT),
            'name_user' => 'Super Admin',
            'phone_user' => '084562565978',
            'level_user' => 'Superadmin',
        ];

        $userModel->save($userData);
    }
}
