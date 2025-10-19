<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'tb_booking';
    protected $primaryKey = 'id_booking';

    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_user', 'id_slot_jadwal', 'id_layanan', 'code_booking', 'date_booking', 'keluhan_booking', 'status_booking'];

    protected $useTimestamps = true;

    public function getPasienPerDokter($id_dokter)
    {
        $this->join('tb_slot_jadwal', 'tb_slot_jadwal.id_slot_jadwal = tb_booking.id_slot_jadwal');
        $this->join('tb_jadwal', 'tb_jadwal.id_jadwal = tb_slot_jadwal.id_jadwal');
        $this->join('tb_dokter', 'tb_dokter.id_dokter = tb_jadwal.id_dokter');
        $this->where('tb_jadwal.id_dokter', $id_dokter);
        $this->groupBy('tb_booking.id_user');

        return $this->findAll();
    }

    public function getBookingPerDokter($id_dokter)
    {
        $this->join('tb_slot_jadwal', 'tb_slot_jadwal.id_slot_jadwal = tb_booking.id_slot_jadwal');
        $this->join('tb_jadwal', 'tb_jadwal.id_jadwal = tb_slot_jadwal.id_jadwal');
        $this->join('tb_dokter', 'tb_dokter.id_dokter = tb_jadwal.id_dokter');
        $this->where('tb_jadwal.id_dokter', $id_dokter);
        $this->where('tb_booking.status_booking', 'Completed');

        return $this->findAll();
    }
}
