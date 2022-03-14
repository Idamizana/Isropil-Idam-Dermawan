<div class="main-content container-fluid">
    <div class="page-title">
        <h3><?= $data['title'] ?></h3>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <?= $data['title'] . '(' . count($data['dataBarang']) . ')' ?>
                    <a href="<?= BASE_URL ?>/barang/create" class="btn btn-primary">Tambah <i data-feather="plus"></i></a>
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Gambar</th>
                                <th>Nama Barang</th>
                                <th>Harga Awal</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data['dataBarang'] as $db) : ?>
                                <tr>
                                    <td><?= date('d F Y', strtotime($db['tgl'])) ?></td>
                                    <td><img src="<?= BASE_URL ?>/assets/images/barang/<?= $db['gambar'] ?>" width="50"></td>
                                    <td><?= $db['nama_barang'] ?></td>
                                    <td><?= $db['harga_awal'] ?></td>
                                    <td><?= $db['deskripsi_barang'] ?></td>
                                    <td>
                                        <a href="<?= BASE_URL ?>/barang/edit/<?= $db['id_barang'] ?>" class="btn btn-info"><i data-feather="edit"></i></a>
                                        <button class="btn btn-danger delete-confirm" data-action="<?= BASE_URL ?>/barang/delete" data-id="<?= $db['id_barang'] ?>"><i data-feather="trash"></i></button>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
</div>