<?php

class Lelang extends Controller
{
    public function index()
    {
        $data['dataLelang'] = $this->model('M_lelang')->getDataLelang();
        $data['title'] = 'Lelang Barang';
        $data['dataTable'] = true;

        $this->view('layouts/backend/header', $data);
        $this->view('page/lelang/index', $data);
        $this->view('layouts/backend/footer', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Data Lelang';
        $data['dataBarang'] = $this->model('M_barang')->getDataBarangBelumLelang();

        $this->view('layouts/backend/header', $data);
        $this->view('page/lelang/create', $data);
        $this->view('layouts/backend/footer');
    }

    public function store()
    {
        if (isset($_POST['submit'])) {
            $idBarang = $_POST['barang'];
            $tgl = $_POST['tanggal'];
            $status = $_POST['status_lelang'];

            $this->model('M_lelang')->addLelang($idBarang, $tgl, $_SESSION['user']['id_petugas'], $status);

            $alert = [
                'title' => 'Berhasil',
                'text' => 'Berhasil menambah data lelang',
                'icon' => 'success',
                'href' => BASE_URL . '/lelang'
            ];

            $_SESSION['alert'] = $alert;

            header("location:" . BASE_URL . "/lelang");
        }
    }

    public function show($id = null)
    {
        if (is_null($id)) {
            header("location:" . BASE_URL . "/lelang");
        }

        $data['title'] = 'Detail Data Lelang';
        $data['dataHistoryLelang'] = $this->model('M_lelang')->getDataHistoryLelang($id);
        $data['dataTable'] = true;

        $this->view('layouts/backend/header', $data);
        $this->view('page/lelang/show', $data);
        $this->view('layouts/backend/footer', $data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data Lelang';
        $data['dataLelang'] = $this->model('M_lelang')->getDataLelangById($id);
        $data['dataBarang'] = $this->model('M_barang')->getDataBarang();

        $this->view('layouts/backend/header', $data);
        $this->view('page/lelang/edit', $data);
        $this->view('layouts/backend/footer');
    }

    public function update($id)
    {
        if (isset($_POST['submit'])) {
            $idBarang = $_POST['barang'];
            $tgl = $_POST['tanggal'];
            $status = $_POST['status_lelang'];

            $this->model('M_lelang')->updateLelang($id, $idBarang, $tgl, $status);

            if ($status == 'ditutup') {
                $data = $this->model('M_history_lelang')->getHargaTertinggi($id);

                if ($data) {
                    $this->model('M_penawaran')->addPenawaran($id, $data['id_user'], $data['penawaran_harga']);
                }
            }

            $alert = [
                'title' => 'Berhasil',
                'text' => 'Berhasil memperbarui data lelang',
                'icon' => 'success',
                'href' => BASE_URL . '/lelang'
            ];

            $_SESSION['alert'] = $alert;

            header("location:" . BASE_URL . "/lelang");
        }
    }

    public function delete()
    {
        $id = $_POST['id'];

        $this->model('M_lelang')->deleteLelang($id);

        $alert = [
            'title' => 'Berhasil',
            'text' => 'Berhasil menghapus data lelang',
            'icon' => 'success',
            'href' => BASE_URL . '/lelang'
        ];

        $_SESSION['alert'] = $alert;

        header("location:" . BASE_URL . "/lelang");
    }
}
