<?php

class Penawaran extends Controller
{
    public function store()
    {
        if (isset($_POST)) {
            $idLelang = $_POST['id'];
            $penawaranHarga = $_POST['harga'];

            $data = $this->model('M_lelang')->getDataLelangById($idLelang);

            $this->model('M_history_lelang')->addHistoryLelang($idLelang, $data['id_barang'], $_SESSION['user']['id_user'], $penawaranHarga);

            echo json_encode("Success");
        }
    }
}
