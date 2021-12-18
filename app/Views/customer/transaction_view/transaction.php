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
                   <h3 class="mb-4">Pembelian Saya</h3>
                   <div class="row">
                        <?php foreach($pesananData as $pd):?>
                        <div class="card my-3 p-0 shadow" style="width: 100%;">
                            <img height="auto" class="card-img-top" src="/assets/images/imagestore/produk/<?=json_decode($pd['product_pic'])[0] ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title my-3"><?= $pd['judul_p'] ?></h5>
                                <p class="card-text d-flex aling-items-center"><span class="material-icons-round mx-1" style="font-size: 17px">request_quote</span>Rp, <?= number_format($pd['harga_normal']) ?></p>
                                <p class="card-text d-flex aling-items-center"><span class="material-icons-round mx-1" style="font-size: 17px">apartment</span><?= $pd['kategori_p'] ?></p>
                                <p class="card-text d-flex aling-items-center"><span class="material-icons-round mx-1" style="font-size: 17px">date_range</span>Tanggal Pemesanan: <?= $pd['order_date'] ?></p>
                                <p class="card-text d-flex aling-items-center"><span class="material-icons-round mx-1" style="font-size: 17px">verified</span>Status Pemesanan: <?= $pd['status_pesanan'] ?></p>
                                <p class="card-text d-flex aling-items-center"><span class="material-icons-round mx-1" style="font-size: 17px">verified</span>Pembayaran: <?= $pd['pembayaran'] ?></p>
                                <div class="d-flex justify-content-between">
                                    <?php if($pd['pembayaran'] == 'KPR' && $pd['status_pesanan'] == 'Disetujui'):?>
                                        <a href="#" class="btn btn-success btn-block d-flex align-items-center"><span class="material-icons-round mx-1">verified</span>KPR anda telah disetujui Bank</a>
                                    <?php endif;?>
                                    <?php if($pd['pembayaran'] == 'KPR' && $pd['status_pesanan'] == 'Menunggu Persetujuan'):?>
                                        <a href="#" class="btn btn-success btn-dark d-flex align-items-center"><span class="material-icons-round mx-1">verified</span>KPR Sedang Ditinjau</a>
                                    <?php endif;?>

                                    <!-- CB -->
                                    <?php if($pd['pembayaran'] == 'Cash Bertahap' && $pd['status_pesanan'] == 'Menunggu Persetujuan'):?>
                                        <a href="/customer/pembayaran-cash-bertahap/<?= $pd['id_cash_bertahap']?>" class="btn btn-dark btn-block  d-flex align-items-center"><span class="material-icons-round mx-1">verified</span>Cash Bertahap Sedang Ditinjau</a>
                                    <?php endif;?>
                                    <?php if($pd['pembayaran'] == 'Cash Bertahap' && $pd['status_pesanan'] == 'Disetujui' && $pd['cash_bertahap_set_status'] == '0'):?>
                                        <a href="#" class="btn btn-warning btn-block d-flex align-items-center" ><span class="material-icons-round mx-1">settings</span>Cash bertahap sedang disetting</a>
                                    <?php endif;?>
                                    <?php if($pd['pembayaran'] == 'Cash Bertahap' && $pd['status_pesanan'] == 'Disetujui' && $pd['cash_bertahap_set_status'] == '1'):?>
                                        <a href="/customer/pembayaran-cash-bertahap/<?= $pd['id_cash_bertahap']?>" class="btn btn-primary btn-block main-bg d-flex align-items-center" ><span class="material-icons-round mx-1">local_mall</span>Lihat Riwayat Pembayaran</a>
                                    <?php endif;?>

                                    <!-- CT -->

                                    <?php if($pd['pembayaran'] == 'Cash Tunai' && $pd['status_pesanan'] == 'Menunggu Persetujuan'):?>
                                        <a href="#" class="btn btn-dark btn-block  d-flex align-items-center"><span class="material-icons-round mx-1">verified</span>Cash Tunai Sedang Ditinjau</a>
                                    <?php endif;?>
                                    <?php if($pd['pembayaran'] == 'Cash Tunai' && $pd['status_pesanan'] == 'Disetujui' && $pd['cash_tunai_set_status'] == '0'):?>
                                        <a href="#" class="btn btn-warning btn-block d-flex align-items-center" ><span class="material-icons-round mx-1">settings</span>Cash Tunai sedang disetting</a>
                                    <?php endif;?>
                                    <?php if($pd['pembayaran'] == 'Cash Tunai' && $pd['status_pesanan'] == 'Disetujui' && $pd['cash_tunai_set_status'] == '1'):?>
                                        <a href="/customer/pembayaran-cash-tunai/<?= $pd['id_cash_tunai']?>" class="btn btn-primary btn-block main-bg d-flex align-items-center" ><span class="material-icons-round mx-1">local_mall</span>Lihat Riwayat Pembayaran</a>
                                    <?php endif;?>
                                    
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                   </div>
                </div>
            </div>
            <?php echo view('/theme/footerfull')?>
        </div>
    </div>
    
    <script>
        const cancelPesanan = (id) => {
            const conf = confirm('Apakah anda yakin untuk membatalkan pesanan ini?')
            if(conf){
                $(document).ready(function () {
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url().'/Customercontroller/cancelPesanan'?>",
                        data: "id=" + id,
                        dataType: "json",
                        success: function (response) {
                            location.reload()
                        },
                        error: function (err) {
                            console.log('error')
                        }
                    });
                });
            }
        }
    </script>

</div>
<?= $this->endSection() ?>

