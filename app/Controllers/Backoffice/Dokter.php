<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;

use App\Models\DokterModel;

class Dokter extends BaseController
{
    protected $dokterModel;

    public function __construct()
    {
        $this->dokterModel = new DokterModel();
    }

    public function index()
    {
        // Data yg akan dioper ke view
        $data['title'] = 'Dokter'; // Judul halaman
        $data['menuGroup'] = 'Master'; //Untuk handle sistem menu
        $data['menu'] = 'Dokter'; //Untuk handle sistem sub menu

        $data['dokters'] = $this->dokterModel->orderBy('created_at', 'DESC')->findAll();

        return view('Backoffice/Dokter/Index', $data);
    }

    public function create()
    {
        // Mengambil data dari POST dan GET
        $vars = $this->request->getVar();

        // Validasi form
        if (!$this->validateData($vars, [
            'name_dokter' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama wajib diisi.',
                    'max_length' => 'Maksimal 50 karakter.',
                ],
            ],
            'email_dokter' => [
                'rules' => 'trim|required|max_length[30]|valid_email|is_unique[tb_dokter.email_dokter]',
                'errors' => [
                    'required' => 'Email wajib diisi.',
                    'max_length' => 'Maksimal 30 karakter',
                    'valid_email' => 'Harus berupa email valid',
                ],
            ],
            'password_dokter' => [
                'rules' => 'trim|required|min_length[8]',
                'errors' => [
                    'required' => 'Password wajib diisi.',
                    'min_length' => 'Password minimal 8 karakter',
                ],
            ],
            'phone_dokter' => [
                'rules' => 'trim|required|min_length[10]|max_length[14]|numeric',
                'errors' => [
                    'required' => 'No. Telp wajib diisi.',
                    'min_length' => 'No. Telp minimal 10 digit',
                    'max_Length' => 'No. Telp maksimal 14 digit',
                    'numeric' => 'No. Telp harus berupa angka',
                ],
            ],
            'level_dokter' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Level wajib dipilih',
                ]
            ]
        ])) {
            // Flash data untuk membuka ulang modal, dan menunjukkan error
            session()->setFlashdata('modalOpen', 'add-modal');
            return redirect()->to('/backoffice/dokter')->withInput();
        }

        // Array data yang akan disimpan
        $dokterData = [
            'email_dokter' => $vars['email_dokter'],
            'password_dokter' => password_hash($vars['password_dokter'], PASSWORD_DEFAULT),
            'name_dokter' => $vars['name_dokter'],
            'phone_dokter' => $vars['phone_dokter'],
            'level_dokter' => $vars['level_dokter'],
        ];

        // Simpan data ke database
        $save = $this->dokterModel->save($dokterData);

        if (!$save) {
            session()->setFlashdata('failed', 'Gagal, harap coba lagi');
            return redirect()->to('/backoffice/dokter')->withInput();
        } else {
            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('/backoffice/dokter');
        }
    }

    public function update()
    {
        // Mengambil data dari POST dan GET
        $vars = $this->request->getVar();

        // Validasi form
        if (!$this->validateData($vars, [
            'name_dokter' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama wajib diisi.',
                    'max_length' => 'Maksimal 50 karakter.',
                ],
            ],
            'email_dokter' => [
                'rules' => 'trim|required|max_length[30]|valid_email',
                'errors' => [
                    'required' => 'Email wajib diisi.',
                    'max_length' => 'Maksimal 30 karakter',
                    'valid_email' => 'Harus berupa email valid',
                ],
            ],
            'phone_dokter' => [
                'rules' => 'trim|required|min_length[10]|max_length[14]|numeric',
                'errors' => [
                    'required' => 'No. Telp wajib diisi.',
                    'min_length' => 'No. Telp minimal 10 digit',
                    'max_Length' => 'No. Telp maksimal 14 digit',
                    'numeric' => 'No. Telp harus berupa angka',
                ],
            ],
            'level_dokter' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Level wajib dipilih',
                ]
            ]
        ])) {
            // Flash data untuk membuka ulang modal, dan menunjukkan error
            session()->setFlashdata('modalOpen', 'edit-modal' . $vars['id_dokter']);
            return redirect()->to('/backoffice/dokter')->withInput();
        }

        // Array data yang akan disimpan
        $dokterData = [
            'id_dokter' => $vars['id_dokter'],
            'email_dokter' => $vars['email_dokter'],
            'name_dokter' => $vars['name_dokter'],
            'phone_dokter' => $vars['phone_dokter'],
            'level_dokter' => $vars['level_dokter'],
        ];

        // Simpan data ke database
        $save = $this->dokterModel->save($dokterData);

        if (!$save) {
            session()->setFlashdata('failed', 'Gagal, harap coba lagi');
            return redirect()->to('/backoffice/dokter')->withInput();
        } else {
            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('/backoffice/dokter')->withInput();
        }
    }

    public function delete()
    {
        $vars = $this->request->getVar();

        $delete = $this->dokterModel->delete($vars['id_dokter']);

        if (!$delete) {
            session()->setFlashdata('failed', 'Gagal, harap coba lagi');
            return redirect()->to('/backoffice/dokter')->withInput();
        } else {
            session()->setFlashdata('success', 'Berhasil menghapus data');
            return redirect()->to('/backoffice/dokter')->withInput();
        }
    }
}
