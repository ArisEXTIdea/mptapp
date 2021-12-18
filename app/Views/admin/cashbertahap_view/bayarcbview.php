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
                    <div class="d-flex justify-content-between">
                        <h3>Bayar Cash Bertahap</h3>
                        <a href="/admin/cash-bertahap-detail/<?= $data['id_metode_pembayaran']?>" class="btn btn-warning d-flex align-items-center">
                            <span class="material-icons-round">arrow_back</span>
                            Kembali
                        </a>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form action="/admincontroller/updatepembayarancb" enctype="multipart/form-data" method="post">
                            <?= csrf_field() ?>
                                <div class="form-group mt-3">
                                    <label for="bank_pembayaran" class="my-2">Pilih Bank</label>
                                    <select class="form-select" aria-label="Default select example" name="bank_pembayaran" id="bank_pembayaran" onchange="changeInfoBank()">
                                        <option disabled selected>Pilih Bank Pembayaran</option>
                                        <?php foreach($bankData as $bd):?>
                                        <option penerima="<?= $bd['nama_penerima']?>" pembayaran="<?= $bd['nomor_pembayaran']?>" value="<?= $bd['nama_bank']?>"><?= $bd['nama_bank']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="border p-2 mt-3 rounded">
                                    <p style="font-size: 10px">Silakan melakukan pembayaran kepada nomor rekening diatas dan mengunggah bukti pembayaran pada upload bukti pembayaran di bawah ini.</p>
                                </div>
                                <div class="form-group">
                                    <label for="bukti_pembayaran" class="my-2">Pilih Bank</label>
                                    <input type="file" name="bukti_pembayaran" class="form-control">
                                </div>
                                <div class="form-group d-none">
                                    <?php 
                                        $url = explode('/',$_SERVER['PHP_SELF']);
                                        $lastUrl = end($url);
                                    ?>
                                    <label for="id_pembayaran" class="my-2">Pilih Bank</label>
                                    <input type="text" name="id_pembayaran" class="form-control" value="<?= $lastUrl?>">
                                </div>
                                <div class="my-3">
                                    <button class="btn btn-primary main-bg">Bayar Sekarang</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo view('/theme/footer')?>
    </div>

    <!-- Ajax request -->

    <script>
        const deleteProduct = (id) => {
            var conf = confirm('Apakah anda yakin menghapus pesanan ini?')

            $(document).ready(function () {
                if(conf){
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url().'/AdminController/deletePesanan'?>",
                        data:  `id=${id}`,
                        dataType: "json",
                        success: function (response) {
                            setTimeout(() => {
                                location.reload()              
                            }, 300);  
                        }
                    });
                }
            });
        }
    </script>
</div>
<?= $this->endSection() ?>

