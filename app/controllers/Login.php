<?php

class Login extends Controller
{
    public function index()
    {
        $data['title'] = 'Login';

        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if (!empty($username) && !empty($password)) {
                $resultPetugas = $this->model('M_user')->loginPetugas($username);

                if ($resultPetugas) {
                    if (password_verify($password, $resultPetugas['password'])) {
                        $_SESSION['user'] = $resultPetugas;

                        header("location:" . BASE_URL . "/dashboard");
                    } else {
                        $data['error'] = true;
                        $data['message'] = "Username atau password salah";
                    }
                } else {
                    $resultUser = $this->model('M_user')->loginUser($username);

                    if ($resultUser) {
                        if (password_verify($password, $resultUser['password'])) {
                            $_SESSION['user'] = $resultUser;

                            header("location:" . BASE_URL . "/dashboard");
                        } else {
                            $data['error'] = true;
                            $data['message'] = "Username atau password salah";
                        }
                    } else {
                        $data['error'] = true;
                        $data['message'] = "Username tidak terdaftar";
                    }
                }
            } else {
                $data['error'] = true;
                $data['message'] = "Ada data yang belum di isi!";
            }
        }

        $this->view('layouts/auth/header', $data);
        $this->view('page/login/index', $data);
        $this->view('layouts/auth/footer');
    }
}
