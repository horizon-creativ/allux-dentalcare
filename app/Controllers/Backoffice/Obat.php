<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;

use App\Models\ObatModel;

class Obat extends BaseController
{
    protected $obatModel;

    public function __construct()
    {
        $this->obatModel = new ObatModel();
    }

    public function index()
    {
        // Data yg akan dioper ke view
        $data['title'] = 'Obat'; // Judul halaman
        $data['menuGroup'] = 'Master'; //Untuk handle sistem menu
        $data['menu'] = 'Obat'; //Untuk handle sistem sub menu

        $data['obats'] = $this->obatModel->orderBy('created_at', 'DESC')->findAll();

        return view('Backoffice/Obat/Index', $data);
    }

    public function create()
    {
        // Mengambil data dari POST dan GET
        $vars = $this->request->getVar();

        // Validasi form
        if (!$this->validateData($vars, [
            'name_obat' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama wajib diisi.',
                    'max_length' => 'Maksimal 50 karakter.',
                ],
            ],
            'price_obat' => [
                'rules' => 'trim|required|numeric',
                'errors' => [
                    'required' => 'Harga wajib diisi.',
                    'numeric' => 'Harga harus berupa angka.'
                ],
            ],
        ])) {
            // Flash data untuk membuka ulang modal, dan menunjukkan error
            session()->setFlashdata('modalOpen', 'add-modal');
            return redirect()->to('/backoffice/obat')->withInput();
        }

        // Array data yang akan disimpan
        $obatData = [
            'name_obat' => $vars['name_obat'],
            'desc_obat' => $vars['desc_obat'],
            'price_obat' => $vars['price_obat'],
        ];

        // Simpan data ke database
        $save = $this->obatModel->save($obatData);

        if (!$save) {
            session()->setFlashdata('failed', 'Gagal, harap coba lagi');
            return redirect()->to('/backoffice/obat')->withInput();
        } else {
            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('/backoffice/obat');
        }
    }

    public function update()
    {
        // Mengambil data dari POST dan GET
        $vars = $this->request->getVar();

        // Validasi form
        if (!$this->validateData($vars, [
            'name_obat' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama wajib diisi.',
                    'max_length' => 'Maksimal 50 karakter.',
                ],
            ],
            'price_obat' => [
                'rules' => 'trim|required|numeric',
                'errors' => [
                    'required' => 'Harga wajib diisi.',
                    'numeric' => 'Harga harus berupa angka.'
                ],
            ],
        ])) {
            // Flash data untuk membuka ulang modal, dan menunjukkan error
            session()->setFlashdata('modalOpen', 'edit-modal' . $vars['id_obat']);
            return redirect()->to('/backoffice/obat')->withInput();
        }

        // Array data yang akan disimpan
        $obatData = [
            'id_obat' => $vars['id_obat'],
            'name_obat' => $vars['name_obat'],
            'desc_obat' => $vars['desc_obat'],
            'price_obat' => $vars['price_obat'],
        ];

        // Simpan data ke database
        $save = $this->obatModel->save($obatData);

        if (!$save) {
            session()->setFlashdata('failed', 'Gagal, harap coba lagi');
            return redirect()->to('/backoffice/obat')->withInput();
        } else {
            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('/backoffice/obat')->withInput();
        }
    }

    public function delete()
    {
        $vars = $this->request->getVar();

        $delete = $this->obatModel->delete($vars['id_obat']);

        if (!$delete) {
            session()->setFlashdata('failed', 'Gagal, harap coba lagi');
            return redirect()->to('/backoffice/obat')->withInput();
        } else {
            session()->setFlashdata('success', 'Berhasil menghapus data');
            return redirect()->to('/backoffice/obat')->withInput();
        }
    }
}
