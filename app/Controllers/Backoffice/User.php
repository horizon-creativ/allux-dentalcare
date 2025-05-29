<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;

use App\Models\UserModel;

class User extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // Data yg akan dioper ke view
        $data['title'] = 'User'; // Judul halaman
        $data['menuGroup'] = 'Master'; //Untuk handle sistem menu
        $data['menu'] = 'User'; //Untuk handle sistem sub menu

        $data['users'] = $this->userModel->orderBy('created_at', 'DESC')->findAll();

        return view('Backoffice/User/Index', $data);
    }

    public function create()
    {
        // Mengambil data dari POST dan GET
        $vars = $this->request->getVar();

        // Validasi form
        if (!$this->validateData($vars, [
            'name_user' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama wajib diisi.',
                    'max_length' => 'Maksimal 50 karakter.',
                ],
            ],
            'email_user' => [
                'rules' => 'trim|required|max_length[30]|valid_email|is_unique[tb_user.email_user]',
                'errors' => [
                    'required' => 'Email wajib diisi.',
                    'max_length' => 'Maksimal 30 karakter',
                    'valid_email' => 'Harus berupa email valid',
                ],
            ],
            'password_user' => [
                'rules' => 'trim|required|min_length[8]',
                'errors' => [
                    'required' => 'Password wajib diisi.',
                    'min_length' => 'Password minimal 8 karakter',
                ],
            ],
            'phone_user' => [
                'rules' => 'trim|required|min_length[10]|max_length[14]|numeric',
                'errors' => [
                    'required' => 'No. Telp wajib diisi.',
                    'min_length' => 'No. Telp minimal 10 digit',
                    'max_Length' => 'No. Telp maksimal 14 digit',
                    'numeric' => 'No. Telp harus berupa angka',
                ],
            ],
            'level_user' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Level wajib dipilih',
                ]
            ]
        ])) {
            // Flash data untuk membuka ulang modal, dan menunjukkan error
            session()->setFlashdata('modalOpen', 'add-modal');
            return redirect()->to('/backoffice/user')->withInput();
        }

        // Array data yang akan disimpan
        $userData = [
            'email_user' => $vars['email_user'],
            'password_user' => password_hash($vars['password_user'], PASSWORD_DEFAULT),
            'name_user' => $vars['name_user'],
            'phone_user' => $vars['phone_user'],
            'level_user' => $vars['level_user'],
        ];

        // Simpan data ke database
        $save = $this->userModel->save($userData);

        if (!$save) {
            session()->setFlashdata('failed', 'Gagal, harap coba lagi');
            return redirect()->to('/backoffice/user')->withInput();
        } else {
            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('/backoffice/user')->withInput();
        }
    }

    public function update()
    {
        // Mengambil data dari POST dan GET
        $vars = $this->request->getVar();

        // Validasi form
        if (!$this->validateData($vars, [
            'name_user' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama wajib diisi.',
                    'max_length' => 'Maksimal 50 karakter.',
                ],
            ],
            'email_user' => [
                'rules' => 'trim|required|max_length[30]|valid_email',
                'errors' => [
                    'required' => 'Email wajib diisi.',
                    'max_length' => 'Maksimal 30 karakter',
                    'valid_email' => 'Harus berupa email valid',
                ],
            ],
            'phone_user' => [
                'rules' => 'trim|required|min_length[10]|max_length[14]|numeric',
                'errors' => [
                    'required' => 'No. Telp wajib diisi.',
                    'min_length' => 'No. Telp minimal 10 digit',
                    'max_Length' => 'No. Telp maksimal 14 digit',
                    'numeric' => 'No. Telp harus berupa angka',
                ],
            ],
            'level_user' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Level wajib dipilih',
                ]
            ]
        ])) {
            // Flash data untuk membuka ulang modal, dan menunjukkan error
            session()->setFlashdata('modalOpen', 'edit-modal' . $vars['id_user']);
            return redirect()->to('/backoffice/user')->withInput();
        }

        // Array data yang akan disimpan
        $userData = [
            'id_user' => $vars['id_user'],
            'email_user' => $vars['email_user'],
            'name_user' => $vars['name_user'],
            'phone_user' => $vars['phone_user'],
            'level_user' => $vars['level_user'],
        ];

        // Simpan data ke database
        $save = $this->userModel->save($userData);

        if (!$save) {
            session()->setFlashdata('failed', 'Gagal, harap coba lagi');
            return redirect()->to('/backoffice/user')->withInput();
        } else {
            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('/backoffice/user')->withInput();
        }
    }

    public function delete()
    {
        $vars = $this->request->getVar();

        $delete = $this->userModel->delete($vars['id_user']);

        if (!$delete) {
            session()->setFlashdata('failed', 'Gagal, harap coba lagi');
            return redirect()->to('/backoffice/user')->withInput();
        } else {
            session()->setFlashdata('success', 'Berhasil menghapus data');
            return redirect()->to('/backoffice/user')->withInput();
        }
    }
}
