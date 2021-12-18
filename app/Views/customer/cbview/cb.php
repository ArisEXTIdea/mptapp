<?= $this->extend('/theme/head') ?>

<!-- Import css here -->
<?= $this->section('css') ?>
<link rel="stylesheet" href="/assets/css/customer/dashboard.css">
<?= $this->endSection() ?>

<!-- Import Javascript here -->

<?= $this->section('js') ?>
<script src="/assets/js/frontpage/allproduct.js">

</script>
<?= $this->endSection() ?>


<!-- Content Section -->

<?= $this->section('content') ?>
<div class="container-fluid m-0 p-0 main-c">
    <!-- Intro -->
    <div class="row">
        <div class="col-12">
            <?php echo view('/theme/navbar')?>
            <div class="row product-container justify-content-center p-3">
                <?php echo view('/theme/sidenav')?>
                <div class="col-12 col-md-7 col-lg-8 w-bg m-2 p-5">
                    <!-- Allert Pembayaran berhasil berhasil -->
                    <?php $session = \Config\Services::session();?>
                    <?php if($session->getFlashdata('success')):?>
                    <div class="alert alert-success" role="alert">
                        <?php  echo $session->getFlashdata('success'); ?>
                    </div>
                    <?php endif;?>
                    <!-- --------------------------------- -->
                    <div class="d-flex justify-content-between">

                        <h3 class="mb-4">Transaksi Saya Cash Bertahap</h3>
                        <a href="/customer/transaksi" class="btn btn-warning d-flex align-items-center">
                            <span class="material-icons-round">arrow_back</span>
                            Kembali
                        </a>
                    </div>
                    <div class="row">
                    <div class="col-12">
                        <h5 class="my-3">Tagihan Belum Dibayarkan</h5>
                        <table class="table table-striped">
                            <thead class='main-bg'>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col" class="user-img">Id Pembayaran</th>
                                    <th scope="col" class="user-fullname text-center">Jumlah Pembayaran</th>
                                    <th scope="col" class="user-address text-center display-md-none">Keterangan Pembayaran</th>
                                    <th scope="col" class="text-center">Kontrol</th>
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
                                        <td class="text-center">
                                            <a href="/customer/bayar-tagihan-cash-bertahap/<?= $d['id_pembayaran'] ?>" class="btn btn-primary main-bg m-1">Bayar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>    
                    </div>
                    <div class="col-12">
                        <h5 class="my-3">Pembayaran Ditolak</h5>
                        <table class="table table-striped">
                            <thead class='main-bg'>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col" class="user-img">Id Pembayaran</th>
                                    <th scope="col" class="user-fullname text-center">Jumlah Pembayaran</th>
                                    <th scope="col" class="user-address text-center display-md-none">Keterangan Pembayaran</th>
                                    <!-- <th scope="col" class="user-address text-center display-md-none">Status Pembayaran</th> -->
                                    <th scope="col" class="user-address text-center display-md-none">Keterangan</th>
                                    <th scope="col" class="text-center">Kontrol</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $number=1;?>
                                <?php foreach($dataTolak as $d):?>
                                    <tr>
                                        <td><?= $number++ ?></td>
                                        <td><?= $d['id_pembayaran'] ?></td>
                                        <td>Rp, <?= number_format($d['jumlah_bayar']) ?></td>
                                        <td class="display-md-none"><?= $d['keterangan_pembayaran'] ?></td>
                                        <!-- <td class="display-md-none"><?= $d['status_pembayaran'] ?></td> -->
                                        <td class="display-md-none"><?= $d['keterangan_status'] ?></td>
                                        <td class="text-center">
                                            <a href="/customer/bayar-ulang-tagihan-cash-bertahap/<?= $d['id_pembayaran'] ?>" class="btn btn-primary main-bg m-1">Bayar Ulang</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>    
                    </div>
                    <div class="col-12">
                        <h5 class="my-3">Pembayaran Dicek</h5>
                        <table class="table table-striped">
                            <thead class='main-bg'>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col" class="user-img">Id Pembayaran</th>
                                    <th scope="col" class="user-fullname text-center">Jumlah Pembayaran</th>
                                    <th scope="col" class="user-address text-center display-md-none">Keterangan Pembayaran</th>
                                    <th scope="col" class="user-address text-center display-md-none">Status Pembayaran</th>
                                    <th scope="col" class="user-address text-center">Kontrol</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $number=1;?>
                                <?php foreach($datacek as $d):?>
                                    <tr>
                                        <td><?= $number++ ?></td>
                                        <td><?= $d['id_pembayaran'] ?></td>
                                        <td>Rp, <?= number_format($d['jumlah_bayar']) ?></td>
                                        <td class="display-md-none"><?= $d['keterangan_pembayaran'] ?></td>
                                        <td class="display-md-none"><?= $d['status_pembayaran'] ?></td>
                                        <td class="text-center">
                                            <a href="/customer/detail-pembayaran/<?= $d['id_pembayaran'] ?>/" class="btn btn-primary main-bg m-1">Lihat</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>    
                    </div>
                    <div class="col-12">
                        <h5 class="my-3">Tagihan Telah Dibayarkan</h5>
                        <table class="table table-striped">
                            <thead class='main-bg'>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col" class="user-img">Id Pembayaran</th>
                                    <th scope="col" class="user-fullname text-center">Jumlah Pembayaran</th>
                                    <th scope="col" class="user-address text-center display-md-none">Keterangan Pembayaran</th>
                                    <th scope="col" class="user-address text-center display-md-none">Status Pembayaran</th>
                                    <th scope="col" class="text-center">Kontrol</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $number=1;?>
                                <?php foreach($datalunas as $d):?>
                                    <tr>
                                        <td><?= $number++ ?></td>
                                        <td><?= $d['id_pembayaran'] ?></td>
                                        <td>Rp, <?= number_format($d['jumlah_bayar']) ?></td>
                                        <td class="display-md-none"><?= $d['keterangan_pembayaran'] ?></td>
                                        <td class="display-md-none"><?= $d['status_pembayaran'] ?></td>
                                        <td class="text-center">
                                            <a href="/customer/detail-pembayaran/<?= $d['id_pembayaran'] ?>" class="btn btn-primary main-bg m-1">Lihat</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>    
                    </div>
                </div>
                </div>
            </div>
            <?php echo view('/theme/footerfull')?>
        </div>
    </div>

</div>
<?= $this->endSection() ?>

