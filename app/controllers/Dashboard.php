<?php

class Dashboard extends Controller
{
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['dataBarang'] = $this->model("M_barang")->getDataBarang();
        $data['dataLelang'] = $this->model("M_lelang")->getDataLelang();
        $data['dataPetugas'] = $this->model("M_petugas")->getDataPetugas();

        $this->view('layouts/backend/header', $data);
        $this->view('page/dashboard/index', $data);
        $this->view('layouts/backend/footer', $data);
    }
}
