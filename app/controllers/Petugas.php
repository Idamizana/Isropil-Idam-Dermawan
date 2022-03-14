<?php

class Petugas extends Controller
{
    public function index()
    {
        $data['dataPetugas'] = $this->model('M_petugas')->getDataPetugas();
        $data['title'] = 'Data Petugas';
        $data['dataTable'] = true;

        $this->view('layouts/backend/header', $data);
        $this->view('page/petugas/index', $data);
        $this->view('layouts/backend/footer', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Data Petugas';

        $this->view('layouts/backend/header', $data);
        $this->view('page/petugas/create', $data);
        $this->view('layouts/backend/footer');
    }

    public function store()
    {
        if (isset($_POST['submit'])) {
            $namaPetugas = $_POST['nama_petugas'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $idLevel = $_POST['hak_akses'];

            if (strlen($password) < 7) {
                $alert = [
                    'title' => 'Gagal',
                    'text' => 'Password minimal 7 karakter',
                    'icon' => 'error'
                ];

                $_SESSION['alert'] = $alert;

                header("location:" . BASE_URL . "/petugas/create");
            } else {
                $password = password_hash($password, PASSWORD_DEFAULT);

                $resultCek = $this->model('M_petugas')->cekPetugasByUsername($username);

                if (!$resultCek) {
                    $this->model('M_petugas')->addPetugas($namaPetugas, $username, $password, $idLevel);

                    $alert = [
                        'title' => 'Berhasil',
                        'text' => 'Berhasil menambah data petugas',
                        'icon' => 'success'
                    ];

                    $_SESSION['alert'] = $alert;

                    header("location:" . BASE_URL . "/petugas");
                } else {
                    $alert = [
                        'title' => 'Gagal',
                        'text' => 'Username sudah terdaftar',
                        'icon' => 'error'
                    ];

                    $_SESSION['alert'] = $alert;

                    header("location:" . BASE_URL . "/petugas/create");
                }
            }
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data Petugas';
        $data['dataPetugas'] = $this->model('M_petugas')->getDataPetugasById($id);

        $this->view('layouts/backend/header', $data);
        $this->view('page/petugas/edit', $data);
        $this->view('layouts/backend/footer');
    }

    public function update($id)
    {
        if (isset($_POST['submit'])) {
            $namaPetugas = $_POST['nama_petugas'];
            $username = $_POST['username'];
            $idLevel = $_POST['hak_akses'];

            $resultCek = $this->model('M_petugas')->getDataPetugasById($id);

            if ($_SESSION['user']['username'] == $resultCek['username']) {
                if (!empty($_POST['password'])) {
                    $password = $_POST['password'];
                    $password = password_hash($password, PASSWORD_DEFAULT);

                    $this->model('M_petugas')->updatePetugas($id, $namaPetugas, $username, $password, $idLevel);

                    $alert = [
                        'title' => 'Berhasil',
                        'text' => 'Berhasil memperbarui data petugas',
                        'icon' => 'success',
                        'href' => BASE_URL . '/petugas'
                    ];

                    $_SESSION['alert'] = $alert;

                    header("location:" . BASE_URL . "/petugas");
                } else {
                    $this->model('M_petugas')->updatePetugas($id, $namaPetugas, $username, null, $idLevel);

                    $alert = [
                        'title' => 'Berhasil',
                        'text' => 'Berhasil memperbarui data petugas',
                        'icon' => 'success',
                        'href' => BASE_URL . '/petugas'
                    ];

                    $_SESSION['alert'] = $alert;

                    header("location:" . BASE_URL . "/petugas");
                }
            } else {
                if ($username == $resultCek['username']) {
                    if (!empty($_POST['password'])) {
                        $password = $_POST['password'];
                        $password = password_hash($password, PASSWORD_DEFAULT);

                        $this->model('M_petugas')->updatePetugas($id, $namaPetugas, $username, $password, $idLevel);

                        $alert = [
                            'title' => 'Berhasil',
                            'text' => 'Berhasil memperbarui data petugas',
                            'icon' => 'success',
                            'href' => BASE_URL . '/petugas'
                        ];

                        $_SESSION['alert'] = $alert;

                        header("location:" . BASE_URL . "/petugas");
                    } else {
                        $this->model('M_petugas')->updatePetugas($id, $namaPetugas, $username, null, $idLevel);

                        $alert = [
                            'title' => 'Berhasil',
                            'text' => 'Berhasil memperbarui data petugas',
                            'icon' => 'success',
                            'href' => BASE_URL . '/petugas'
                        ];

                        $_SESSION['alert'] = $alert;

                        header("location:" . BASE_URL . "/petugas");
                    }
                } else {

                    $cekUsername = $this->model('M_petugas')->cekPetugasByUsername($username);

                    if ($cekUsername) {
                        $alert = [
                            'title' => 'Gagal',
                            'text' => 'Username sudah terdaftar',
                            'icon' => 'error'
                        ];

                        $_SESSION['alert'] = $alert;

                        echo '<script>history.back()</script>';
                    } else {
                        if (!empty($_POST['password'])) {
                            $password = $_POST['password'];
                            $password = password_hash($password, PASSWORD_DEFAULT);

                            $this->model('M_petugas')->updatePetugas($id, $namaPetugas, $username, $password, $idLevel);

                            $alert = [
                                'title' => 'Berhasil',
                                'text' => 'Berhasil memperbarui data petugas',
                                'icon' => 'success',
                                'href' => BASE_URL . '/petugas'
                            ];

                            $_SESSION['alert'] = $alert;

                            header("location:" . BASE_URL . "/petugas");
                        } else {
                            $this->model('M_petugas')->updatePetugas($id, $namaPetugas, $username, null, $idLevel);

                            $alert = [
                                'title' => 'Berhasil',
                                'text' => 'Berhasil memperbarui data petugas',
                                'icon' => 'success',
                                'href' => BASE_URL . '/petugas'
                            ];

                            $_SESSION['alert'] = $alert;

                            header("location:" . BASE_URL . "/petugas");
                        }
                    }
                }
            }
        }
    }

    public function delete()
    {
        $id = $_POST['id'];

        $this->model('M_petugas')->deletePetugas($id);

        $alert = [
            'title' => 'Berhasil',
            'text' => 'Berhasil menghapus data petugas',
            'icon' => 'success',
            'href' => BASE_URL . '/petugas'
        ];

        $_SESSION['alert'] = $alert;

        header("location:" . BASE_URL . "/petugas");
    }
}
