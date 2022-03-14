<?php

class Laporan extends Controller
{

    public function index()
    {
        $data['title'] = 'Laporan';
        $data['dataLaporan'] = $this->model('M_laporan')->getData();
        $data['dataTable'] = true;

        $this->view('layouts/backend/header', $data);
        $this->view('page/laporan/index', $data);
        $this->view('layouts/backend/footer', $data);
    }

    public function cetak()
    {
        $data['title'] = 'Laporan';
        $data['dataLaporan'] = $this->model('M_laporan')->getData();

        $this->view('page/laporan/cetak', $data);
    }
}
