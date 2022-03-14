<?php

class Register extends Controller
{
    public function index()
    {
        $data['title'] = "Register";

        if (isset($_POST['submit'])) {
            $namaLengkap = $_POST['nama_lengkap'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $noTelepon = $_POST['no_telepon'];

            if (!empty($namaLengkap) && !empty($username) && !empty($password) && !empty($noTelepon)) {
                if (strlen($password) < 7) {
                    $data['error'] = true;
                    $data['message'] = "Password minimal 7 karakter!";
                } else {
                    $resultCek = $this->model('M_user')->cekUser($username);

                    if (!$resultCek) {
                        $this->model('M_user')->registerUser($namaLengkap, $username, password_hash($password, PASSWORD_DEFAULT), $noTelepon);

                        $alert = [
                            'title' => 'Berhasil',
                            'text' => 'Berhasil mendaftar, silahkan login',
                            'icon' => 'success',
                            'href' => BASE_URL . '/login'
                        ];

                        $_SESSION['alert'] = $alert;
                    } else {
                        $data['error'] = true;
                        $data['message'] = "Username sudah terdaftar";
                    }
                }
            } else {
                $data['error'] = true;
                $data['message'] = "Ada data yang belum di isi!";
            }
        }

        $this->view('layouts/auth/header', $data);
        $this->view('page/register/index', $data);
        $this->view('layouts/auth/footer', $data);
    }
}
