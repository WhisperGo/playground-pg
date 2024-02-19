<?php

namespace App\Controllers;
use App\Models\M_login;

class Login extends BaseController
{

   protected function isLoggedIn()
   {
        return session()->has('id');
    }

    public function index()
    {
        if ($this->isLoggedIn()) {
            return redirect()->to('dashboard');
        }

        $data['title']='Login';
        echo view ('hopeui/partial_login/header', $data);
        echo view('hopeui/auth/login');
        echo view('hopeui/partial_login/footer');
    }

    public function aksi_login()
    {
        $u=$this->request->getPost('username');
        $p=$this->request->getPost('password');

        // Tambahkan validasi jika field kosong
        // if (empty($u) && empty($p)) {
        //     session()->setFlashdata('error', 'Username dan password tidak boleh kosong');
        //     return redirect()->to('login');
        // }

        // if (empty($u)) {
        //     session()->setFlashdata('error', 'Username tidak boleh kosong');
        //     return redirect()->to('login');
        // }

        // if (empty($p)) {
        //     session()->setFlashdata('error', 'Password tidak boleh kosong');
        //     return redirect()->to('login');
        // }

        // // // Tambahkan validasi CAPTCHA
        // $captcha_response = $this->request->getPost('g-recaptcha-response');

        // if (empty($captcha_response)) {
        //     session()->setFlashdata('error', 'Harap isi CAPTCHA');
        //     return redirect()->to('login');
        // }

        // // Verifikasi CAPTCHA menggunakan Google reCAPTCHA API
        // $url = 'https://www.google.com/recaptcha/api/siteverify';
        // $data = [
        //     'secret' => '6LcEfuojAAAAAHEty4frYz3AtlZ39sx7OsvHVT5K',
        //     'response' => $captcha_response,
        // ];
        // $options = [
        //     'http' => [
        //         'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        //         'method' => 'POST',
        //         'content' => http_build_query($data),
        //     ],
        // ];
        // $context = stream_context_create($options);
        // $result = file_get_contents($url, false, $context);
        // $result_json = json_decode($result, true);

        // if ($result_json['success'] !== true) {
        //     session()->setFlashdata('error', 'CAPTCHA tidak valid');
        //     return redirect()->to('login');
        // }

        $model= new M_login();
        $data=array(
            'username'=>$u,
            'password'=>$p

        );
        $cek=$model->getLoginWithPassword('user', $u, $p);
        if ($cek !== null) {
            session()->set('id', $cek['id_user']);
            session()->set('username', $cek['username']);
            session()->set('level', $cek['level']);
            return redirect()->to('dashboard');
        }else {
            // Tambahkan peringatan username atau password salah
            session()->setFlashdata('error', ' Username atau password Anda salah');
            return redirect()->to('/');
        }
    }

    public function log_out()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}