<?php

class Pengguna extends Controller
{
    public function index()
    {
        $data['dataPengguna'] = $this->model('M_user')->getDataPengguna();
        $data['title'] = 'Data Pengguna';
        $data['dataTable'] = true;

        $this->view('layouts/backend/header', $data);
        $this->view('page/pengguna/index', $data);
        $this->view('layouts/backend/footer', $data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data Pengguna';
        $data['dataPengguna'] = $this->model('M_user')->getDataPenggunaById($id);

        $this->view('layouts/backend/header', $data);
        $this->view('page/pengguna/edit', $data);
        $this->view('layouts/backend/footer');
    }

    public function update($id)
    {
        if (isset($_POST['submit'])) {
            $namaPengguna = $_POST['nama_pengguna'];
            $username = $_POST['username'];
            $telp = $_POST['telp'];

            $resultCek = $this->model('M_user')->getDataPenggunaById($id);

            if ($username == $resultCek['username']) {
                if (!empty($_POST['password'])) {
                    $password = $_POST['password'];
                    $password = password_hash($password, PASSWORD_DEFAULT);

                    $this->model('M_user')->updatePengguna($id, $namaPengguna, $username, $password, $telp);

                    $alert = [
                        'title' => 'Berhasil',
                        'text' => 'Berhasil memperbarui data pengguna',
                        'icon' => 'success',
                        'href' => BASE_URL . '/pengguna'
                    ];

                    $_SESSION['alert'] = $alert;

                    header("location:" . BASE_URL . "/pengguna");
                } else {
                    $this->model('M_user')->updatePengguna($id, $namaPengguna, $username, null, $telp);

                    $alert = [
                        'title' => 'Berhasil',
                        'text' => 'Berhasil memperbarui data pengguna',
                        'icon' => 'success',
                        'href' => BASE_URL . '/pengguna'
                    ];

                    $_SESSION['alert'] = $alert;

                    header("location:" . BASE_URL . "/pengguna");
                }
            } else {
                $cekUsername = $this->model('M_user')->getDataPenggunaByUsername($username);

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

                        $this->model('M_user')->updatePengguna($id, $namaPengguna, $username, $password, $telp);

                        $alert = [
                            'title' => 'Berhasil',
                            'text' => 'Berhasil memperbarui data pengguna',
                            'icon' => 'success',
                            'href' => BASE_URL . '/pengguna'
                        ];

                        $_SESSION['alert'] = $alert;

                        header("location:" . BASE_URL . "/pengguna");
                    } else {
                        $this->model('M_user')->updatePengguna($id, $namaPengguna, $username, null, $telp);

                        $alert = [
                            'title' => 'Berhasil',
                            'text' => 'Berhasil memperbarui data pengguna',
                            'icon' => 'success',
                            'href' => BASE_URL . '/pengguna'
                        ];

                        $_SESSION['alert'] = $alert;

                        header("location:" . BASE_URL . "/pengguna");
                    }
                }
            }
        }
    }

    public function delete()
    {
        $id = $_POST['id'];

        $this->model('M_user')->deletePengguna($id);

        $alert = [
            'title' => 'Berhasil',
            'text' => 'Berhasil menghapus data pengguna',
            'icon' => 'success',
            'href' => BASE_URL . '/pengguna'
        ];

        $_SESSION['alert'] = $alert;

        header("location:" . BASE_URL . "/pengguna");
    }
}
