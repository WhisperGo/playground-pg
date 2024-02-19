<?php

namespace App\Controllers;
use App\Models\M_user;

class Register extends BaseController
{
    public function index()
    {
        $model=new M_user();

        $data['title']='Register';

        echo view('hopeui/partial_login/header', $data);
        echo view('hopeui/auth/register', $data);
        echo view('hopeui/partial_login/footer');
    }

    public function aksi_register()
    { 
        $u = $this->request->getPost('username');
        $p = $this->request->getPost('password');

        // Tambahkan validasi jika field kosong
        if (empty($u) && empty($p)) {
            session()->setFlashdata('error', 'Username dan password tidak boleh kosong');
            return redirect()->to('register');
        }

        if (empty($u)) {
            session()->setFlashdata('error', 'Username tidak boleh kosong');
            return redirect()->to('register');
        }

        if (empty($p)) {
            session()->setFlashdata('error', 'Password tidak boleh kosong');
            return redirect()->to('register');
        }

        // Tambahkan validasi CAPTCHA
        $captcha_response = $this->request->getPost('g-recaptcha-response');

        if (empty($captcha_response)) {
            session()->setFlashdata('error', 'Harap isi CAPTCHA');
            return redirect()->to('register');
        }

            // Verifikasi CAPTCHA menggunakan Google reCAPTCHA API
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret' => '6LcEfuojAAAAAHEty4frYz3AtlZ39sx7OsvHVT5K',
            'response' => $captcha_response,
        ];
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data),
            ],
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $result_json = json_decode($result, true);

        if ($result_json['success'] !== true) {
            session()->setFlashdata('error', 'CAPTCHA tidak valid');
            return redirect()->to('register');
        }

        // Data yang akan disimpan
        $data1 = array(
            'username' => $u,
            'password' => md5($p),
            'level' => 3,
            'foto' => 'default.png',
        );

        // Simpan data ke dalam database
        $model = new M_user();
        $model->simpan('user', $data1);

        return redirect()->to('user');
    }
}