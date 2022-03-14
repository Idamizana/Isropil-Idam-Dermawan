<?php

class Riwayat extends Controller
{
    public function index()
    {
        $userId = $_SESSION['user']['id_user'];
        $data['history'] = $this->model('M_history_lelang')->getHistoryLelangByUserId(id: $userId);
        $data['title'] = 'Riwayat Penawaran';
        $data['dataTable'] = true;

        $this->view('layouts/backend/header', $data);
        $this->view('page/riwayat/index', $data);
        $this->view('layouts/backend/footer', $data);
    }
}
