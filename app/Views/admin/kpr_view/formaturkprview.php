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
            <?php echo view('/theme/sidemenu')?>
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
                        <h3>Atur KPR</h3>
                    </div>
                    <div class="row jsutify-content-center">
                        <div class="col-10">    
                            <form action="/admincontroller/simpanPengaturanKpr">
                                <?= csrf_field() ?>
                                <?php 
                                $url = explode('/',$_SERVER['PHP_SELF']);
                                $idPesanan = end($url);
                                ?>
                                <div class="form-group my-2 d-none">
                                    <label for="id_pesanan " class
                                    ="my-2">Id Pesanan</label>
                                    <input type="text" name="id_pesanan" value="<?= $idPesanan?>" class="form-control">
                                </div>
                                <div class="form-group my-2">
                                    <label for="uang_muka " class
                                    ="my-2">Uang Muka</label>
                                    <input type="number" name="uang_muka" class="form-control">
                                </div>
                                <div class="form-group my-2">
                                    <label for="jumlah_bunga " class
                                    ="my-2">Jumlah Bunga(%)</label>
                                    <input type="number" name="jumlah_bunga" class="form-control">
                                </div>
                                <div class="form-group my-2">
                                    <label for="lama_bulanan " class
                                    ="my-2">Jangka Waktu KPR(Bulan)</label>
                                    <input type="number" name="lama_bulanan" class="form-control">
                                </div>
                                <div class="form-group my-2">
                                    <label for="bayar_bulanan " class
                                    ="my-2">Jumlah Pembayaran Perbulan</label>
                                    <input type="number" name="bayar_bulanan" class="form-control">
                                </div>
                                <div class="my-3">
                                    <button type="submit" class="btn btn-primary main-bg">Simpan Pengaturan</button>
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

