<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BookingUpdateDateBooking extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('tb_booking', [
            'date_booking' => [
                'type' => 'DATETIME',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('tb_booking', [
            'date_booking' => [
                'type' => 'DATE',
            ]
        ]);
    }
}
