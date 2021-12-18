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
                        <h3 class="mb-3">Edit Pesanan</h3>
                    </div>
                </div>
                <!-- Users Tabele -->
                <div>
                    <form action="/admincontroller/ubahPesanan" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="bank" class="my-1">Bank</label>
                            <select name="bank" class="form-select">
                                <?php foreach($bankData as $bd):?>
                                    <option value="<?= $bd['nama_bank'] ?>" ><?= $bd['nama_bank'] ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pembayaran" class="my-1">Metode Pembayaran</label>
                            <select name="pembayaran" class="form-select">
                                <?php 
                                    $kpr = '';
                                    $cb = '';
                                    $ct = '';

                                    if($data['pembayaran'] == 'KPR'){
                                        $kpr = 'selected';
                                    }
                                    elseif($data['pembayaran'] == 'Cash Bertahap'){
                                        $cb = 'selected';
                                    }
                                    elseif($data['pembayaran'] == 'Cash Tunai'){
                                        $ct = 'selected';
                                    }
                                ?>
                                <option value="KPR" <?= $kpr ?>>KPR</option>
                                <option value="Cash Tunai" <?= $ct ?>>Cash Tunai</option>
                                <option value="Cash Bertahap" <?= $cb ?>>Cash Bertahap</option>
                            </select>
                        </div>
                        <div class="d-none">
                            <?php 
                                $url = explode('/',$_SERVER['PHP_SELF']);
                                $id = end($url);
                            ?>
                            <input type="text" name="id_pesanan" value="<?= $id  ?>">
                        </div>
                        <div class="my-3">
                            <button class="btn btn-primary main-bg">Simpan Perubahan</button>
                        </div>
                    </form>
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

