<?= $this->extend('/theme/head') ?>

<!-- Import css here -->
<?= $this->section('css') ?>

<?= $this->endSection() ?>

<!-- Import Javascript here -->

<?= $this->section('js') ?>
<script src="/assets/js/Kategori.js"></script>
<?= $this->endSection() ?>


<!-- Content Section -->

<?= $this->section('content') ?>
<div class="container-fluid m-0 p-0 main-c">
    <?php echo view('/theme/header')?>
    <div class="row p-0 m-0" style="height: 100vh">
        <div class="col-12 col-sm-4 col-md-3 col-lg-2 p-0 m-0" id="sidebar">
            <?php echo view('/theme/sidemenu')?>
        </div>
        <div class="col-12 col-sm-8 col-md-9 col-lg-10 p-4 content-bg content-container" id='content'>
            <div class="row">
                <div class="col-12 col-md-4 border w-bg text-center" >
                    <div class="card-body">
                        <h5 class="card-title">Kredit Kepemilikan Rumah</h5>
                        <div>
                            <span class="material-icons-round">credit_score</span>
                        </div>
                        <p class="card-text">Total Pesanan: <?= $countKpr ?></p>
                        <a href="/admin/kpr" class="btn btn-primary main-bg">Lihat Transaksi</a>

                    </div>
                </div>
                <div class="col-12 col-md-4 w-bg border text-center" >
                    <div class="card-body">
                        <h5 class="card-title">Cash Bertahap</h5>
                        <div>
                            <span class="material-icons-round">maps_home_work</span>
                        </div>
                        <p class="card-text">Total Pesanan: <?= $countCb ?></p>
                        <a href="/admin/cash-bertahap" class="btn btn-primary main-bg">Lihat Transaksi</a>
                    </div>
                </div>
                <div class="col-12 col-md-4 w-bg border text-center" >
                    <div class="card-body">
                        <h5 class="card-title">Cash Tunai</h5>
                        <div>
                            <span class="material-icons-round">monetization_on</span>
                        </div>
                        <p class="card-text">Total Pesanan: <?= $countCt ?></p>
                        <a href="/admin/cash-tunai" class="btn btn-primary main-bg">Lihat Transaksi</a>

                    </div>
                </div>
            </div>
            <div class="row p-3 my-3 w-bg">
                <div class="col-12 col-md-6">
                    <h4>Informasi Umum</h4>
                    <table>
                        <tr>
                            <td>Jumlah Pengguna</td>
                            <td>: <?= $countUser ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah Produk Perumahan</td>
                            <td>: <?= $countProduk ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah Kategori Perumahan</td>
                            <td>: <?= $countKategori ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah Bank Pembayaran Tersedia</td>
                            <td>: <?= $countBank ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-12 col-md-6">
                    <h4>Informasi Penjualan</h4>
                    <table>
                        <tr>
                            <td>Transaksi Berhasil</td>
                            <td>: <?= $countDiterima ?></td>
                        </tr>
                        <tr>
                            <td>Transaksi Gagal</td>
                            <td>: <?= $countDitolak ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row p-3 my-3 w-bg">
                <div class="col-12">
                    <h4>Monitoring</h4>
                    <table>
                        <tr>
                            <td>Pesan Belum Terbaca</td>
                            <td class="text-danger">: <?= $countBelumDibaca ?></td>
                        </tr>
                        <tr>
                            <td>Pesanan Perlu dikonfirmasi</td>
                            <td class="text-danger">: <?= $countPersetujuan ?></td>
                        </tr>
                        <tr>
                            <td>Pembayaran Perlu diverifikasi</td>
                            <td class="text-danger">: <?= $countMenungguCek ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row my-3 w-bg">
                <div class="col-12 p-3 bordertext-center">
                    <h4 class="my-4 text-center">Verifikasi Pembayaran</h4>
                    <table class="table table-striped">
                            <thead class='main-bg'>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col" class="user-img">Id Pembayaran</th>
                                    <th scope="col" class="user-fullname text-center">Jumlah Pembayaran</th>
                                    <th scope="col" class="user-address text-center display-md-none">Keterangan Pembayaran</th>
                                    <th scope="col" class="user-address text-center display-md-none">Nama Pembayar</th>
                                    <th scope="col" class="user-address text-center display-md-none">Kontrol</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $number=1;?>
                                <?php foreach($data as $d):?>
                                    <tr>
                                        <td><?= $number++ ?></td>
                                        <td><?= $d['id_pembayaran'] ?></td>
                                        <td>Rp, <?= number_format($d['jumlah_bayar']) ?></td>
                                        <td class="display-md-none"><?= $d['keterangan_pembayaran'] ?></td>
                                        <td class="display-md-none"><?= $d['full_name'] ?></td>
                                        <td class="text-center">
                                            <a href="/admin/cek-pembayaran/<?= $d['id_pembayaran'] ?>" class="btn btn-primary main-bg m-1">Cek Pembayaran</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>  
                </div>
            </div>
        </div>
    </div>
    <?php echo view('/theme/footer')?>
</div>
<?= $this->endSection() ?>

