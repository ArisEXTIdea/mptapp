<?= $this->extend('/theme/head') ?>

<!-- Import css here -->
<?= $this->section('css') ?>
<link rel="stylesheet" href="/assets/css/admin/listpengguna.css">
<?= $this->endSection() ?>

<!-- Import Javascript here -->

<?= $this->section('js') ?>
<script src="/assets/js/admin/pengguna.js"></script>
<?= $this->endSection() ?>


<!-- Content Section -->

<?= $this->section('content') ?>
<div class="container-fluid m-0 p-0 main-c">
    <?php echo view('/theme/header')?>
    <div class="row p-0 m-0" style="height: 100vh">
        <div class="col-12 col-sm-4 col-md-3 col-lg-2 p-0 m-0" id="sidebar">
            <?php echo view('/theme/Sidemenu')?>
        </div>
        <div class="col-12 col-sm-8 col-md-9 col-lg-10 p-3 content-bg content-container" id='content'>
            <div class="container-fluid p-4 m-0 item-bg">
                <div class="row">
                    <!-- Header Section -->
                    <div class="col-12">
                         <!-- Allert pendaftaran berhasil -->
                    <?php $session = \Config\Services::session();?>
                    <?php if($session->getFlashdata('success')):?>
                    <div class="alert alert-success" role="alert">
                        <?php  echo $session->getFlashdata('success'); ?>
                    </div>
                    <?php endif;?>
                    <!-- --------------------------------- -->
                        <h3>Detail Tagihan Cash Tunai</h3>
                    </div>
                </div>
                <!-- Users Tabele -->
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
                                            <a href="/admin/bayar-tagihan-cash-tunai/<?= $d['id_pembayaran'] ?>" class="btn btn-primary main-bg m-1">Bayar</a>
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
                                            <a href="/admin/detail-pembayaran-cash-tunai/<?= $d['id_pembayaran']?>" class="btn btn-primary main-bg m-1">Lihat</a>
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

    <!-- Ajax request -->
</div>
<?= $this->endSection() ?>

