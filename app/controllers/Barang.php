<?php

class Barang extends Controller
{
    public function index()
    {
        $data['title'] = "Data Barang";
        $data['dataBarang'] = $this->model('M_barang')->getDataBarang();
        $data['dataTable'] = true;

        $this->view('layouts/backend/header', $data);
        $this->view('page/barang/index', $data);
        $this->view('layouts/backend/footer', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Data Barang';

        $this->view('layouts/backend/header', $data);
        $this->view('page/barang/create', $data);
        $this->view('layouts/backend/footer');
    }

    public function store()
    {
        if (isset($_POST['submit'])) {
            $tmp = $_FILES['gambar_barang']['tmp_name'];
            $upload = 'assets/images/barang/';
            $ext = pathinfo($_FILES['gambar_barang']['name'], PATHINFO_EXTENSION);

            if (!is_dir($upload)) {
                mkdir($upload);
            }

            $tgl = $_POST['tgl'];
            $namaBarang = $_POST['nama_barang'];
            $hargaAwal = $_POST['harga_awal'];
            $deskripsiBarang = $_POST['deskripsi_barang'];
            $namaGambar = time() . '-' . $this->textToSlug($namaBarang) . '.' . $ext;

            $this->model('M_barang')->addBarang($namaGambar, $namaBarang, $tgl, $hargaAwal, $deskripsiBarang);

            $proses = move_uploaded_file($tmp, $upload . $namaGambar);

            if ($proses) {
                $alert = [
                    'title' => 'Berhasil',
                    'text' => 'Berhasil menambah data barang',
                    'icon' => 'success',
                    'href' => BASE_URL . '/barang'
                ];

                $_SESSION['alert'] = $alert;

                header("location:" . BASE_URL . "/barang");
            } else {
                $alert = [
                    'title' => 'Gagal',
                    'text' => 'Gagal menambah data barang',
                    'icon' => 'error'
                ];

                $_SESSION['alert'] = $alert;

                echo '<script>history.back()</script>';
            }
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data Barang';
        $data['dataBarang'] = $this->model('M_barang')->getDataBarangById($id);

        if (!$data['dataBarang']) {
            header("location:" . BASE_URL . "/barang");
        }

        $this->view('layouts/backend/header', $data);
        $this->view('page/barang/edit', $data);
        $this->view('layouts/backend/footer');
    }

    public function update($id)
    {
        if (isset($_POST['submit'])) {
            $tgl = $_POST['tgl'];
            $namaBarang = $_POST['nama_barang'];
            $hargaAwal = $_POST['harga_awal'];
            $deskripsiBarang = $_POST['deskripsi_barang'];

            if ($_FILES['gambar_barang']['error'] == 4) {
                $this->model('M_barang')->updateBarang($id, null, $namaBarang, $tgl, $hargaAwal, $deskripsiBarang);

                $alert = [
                    'title' => 'Berhasil',
                    'text' => 'Berhasil memperbarui data barang',
                    'icon' => 'success',
                    'href' => BASE_URL . '/barang'
                ];

                $_SESSION['alert'] = $alert;

                header("location:" . BASE_URL . "/barang");
            } else {
                $tmp = $_FILES['gambar_barang']['tmp_name'];
                $upload = 'assets/images/barang/';
                $ext = pathinfo($_FILES['gambar_barang']['name'], PATHINFO_EXTENSION);

                if (!is_dir($upload)) {
                    mkdir($upload);
                }

                $namaGambar = time() . '-' . $this->textToSlug($namaBarang) . '.' . $ext;

                $ambilGambar = $this->model('M_barang')->getDataBarangById($id);

                unlink('assets/images/barang/' . $ambilGambar['gambar']);

                $this->model('M_barang')->updateBarang($id, $namaGambar, $namaBarang, $tgl, $hargaAwal, $deskripsiBarang);

                $proses = move_uploaded_file($tmp, $upload . $namaGambar);

                if ($proses) {
                    $alert = [
                        'title' => 'Berhasil',
                        'text' => 'Berhasil memperbarui data barang',
                        'icon' => 'success',
                        'href' => BASE_URL . '/barang'
                    ];

                    $_SESSION['alert'] = $alert;

                    header("location:" . BASE_URL . "/barang");
                } else {
                    $alert = [
                        'title' => 'Gagal',
                        'text' => 'Gagal memperbarui data barang',
                        'icon' => 'error'
                    ];

                    $_SESSION['alert'] = $alert;

                    echo '<script>history.back()</script>';
                }
            }
        }
    }

    public function delete()
    {
        $id = $_POST['id'];
        $dataBarang = $this->model('M_barang')->getDataBarangById($id);

        unlink('assets/images/barang/' . $dataBarang['gambar']);

        $this->model('M_barang')->deleteBarang($id);

        $alert = [
            'title' => 'Berhasil',
            'text' => 'Berhasil menghapus data barang',
            'icon' => 'success',
            'href' => BASE_URL . '/barang'
        ];

        $_SESSION['alert'] = $alert;

        header("location:" . BASE_URL . "/barang");
    }

    function textToSlug($text)
    {
        $text = trim($text);
        if (empty($text)) return '';
        $text = preg_replace("/[^a-zA-Z0-9\-\s]+/", "", $text);
        $text = strtolower(trim($text));
        $text = str_replace(' ', '-', $text);
        $text = preg_replace('/\-{2,}/', '-', $text);
        return $text;
    }
}
