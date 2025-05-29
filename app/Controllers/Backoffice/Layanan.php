<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;

use App\Models\LayananModel;

class Layanan extends BaseController
{
    protected $layananModel;

    public function __construct()
    {
        $this->layananModel = new LayananModel();
    }

    public function index()
    {
        // Data yg akan dioper ke view
        $data['title'] = 'Layanan'; // Judul halaman
        $data['menuGroup'] = 'Master'; //Untuk handle sistem menu
        $data['menu'] = 'Layanan'; //Untuk handle sistem sub menu

        $data['layanans'] = $this->layananModel->orderBy('created_at', 'DESC')->findAll();

        return view('Backoffice/Layanan/Index', $data);
    }

    public function create()
    {
        // Mengambil data dari POST dan GET
        $vars = $this->request->getVar();

        // Validasi form
        if (!$this->validateData($vars, [
            'name_layanan' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama wajib diisi.',
                    'max_length' => 'Maksimal 50 karakter.',
                ],
            ],
            'price_layanan' => [
                'rules' => 'trim|required|numeric',
                'errors' => [
                    'required' => 'Harga wajib diisi.',
                    'numeric' => 'Harga harus berupa angka.'
                ],
            ],
        ])) {
            // Flash data untuk membuka ulang modal, dan menunjukkan error
            session()->setFlashdata('modalOpen', 'add-modal');
            return redirect()->to('/backoffice/layanan')->withInput();
        }

        // Array data yang akan disimpan
        $layananData = [
            'name_layanan' => $vars['name_layanan'],
            'desc_layanan' => $vars['desc_layanan'],
            'price_layanan' => $vars['price_layanan'],
        ];

        // Simpan data ke database
        $save = $this->layananModel->save($layananData);

        if (!$save) {
            session()->setFlashdata('failed', 'Gagal, harap coba lagi');
            return redirect()->to('/backoffice/layanan')->withInput();
        } else {
            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('/backoffice/layanan');
        }
    }

    public function update()
    {
        // Mengambil data dari POST dan GET
        $vars = $this->request->getVar();

        // Validasi form
        if (!$this->validateData($vars, [
            'name_layanan' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama wajib diisi.',
                    'max_length' => 'Maksimal 50 karakter.',
                ],
            ],
            'price_layanan' => [
                'rules' => 'trim|required|numeric',
                'errors' => [
                    'required' => 'Harga wajib diisi.',
                    'numeric' => 'Harga harus berupa angka.'
                ],
            ],
        ])) {
            // Flash data untuk membuka ulang modal, dan menunjukkan error
            session()->setFlashdata('modalOpen', 'edit-modal' . $vars['id_layanan']);
            return redirect()->to('/backoffice/layanan')->withInput();
        }

        // Array data yang akan disimpan
        $layananData = [
            'id_layanan' => $vars['id_layanan'],
            'name_layanan' => $vars['name_layanan'],
            'desc_layanan' => $vars['desc_layanan'],
            'price_layanan' => $vars['price_layanan'],
        ];

        // Simpan data ke database
        $save = $this->layananModel->save($layananData);

        if (!$save) {
            session()->setFlashdata('failed', 'Gagal, harap coba lagi');
            return redirect()->to('/backoffice/layanan')->withInput();
        } else {
            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('/backoffice/layanan')->withInput();
        }
    }

    public function delete()
    {
        $vars = $this->request->getVar();

        $delete = $this->layananModel->delete($vars['id_layanan']);

        if (!$delete) {
            session()->setFlashdata('failed', 'Gagal, harap coba lagi');
            return redirect()->to('/backoffice/layanan')->withInput();
        } else {
            session()->setFlashdata('success', 'Berhasil menghapus data');
            return redirect()->to('/backoffice/layanan')->withInput();
        }
    }
}
