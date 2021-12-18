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
                    <div class="d-flex justify-content-between">
                        <h3>Detail Pembayaran</h3>
                        <a href="/admin/kpr-detail/<?= $data['id_metode_pembayaran']?>" class="btn btn-warning d-flex align-items-center">
                            <span class="material-icons-round">arrow_back</span>
                            Kembali
                        </a>
                    </div>
                    </div>
                    <div class="row jsutify-content-center">
                        <div class="col-10">    
                            <table>
                                <tr>
                                    <td>Id Pembayaran</td>
                                    <td>: <?= $data['id_pembayaran']?></td>
                                </tr>
                                <tr>
                                    <td>Jumlah Pembayaran</td>
                                    <td>: Rp,  <?= number_format($data['jumlah_bayar'])?></td>
                                </tr>
                                <tr>
                                    <td>Bulan Pembayaran</td>
                                    <td>: <?= $data['keterangan_pembayaran']?></td>
                                </tr>
                                <tr>
                                    <td>Dibayar Oleh</td>
                                    <td>: <?= $data['keterangan_pembayar']?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pembayaran</td>
                                    <td>: <?= $data['tanggal_pembayaran']?></td>
                                </tr>
                                <tr>
                                    <td>Bank</td>
                                    <td>: <?= $data['bank_pembayaran']?></td>
                                </tr>
                                <tr>
                                    <td>Bukti Pembayaran</td>
                                    <td>: <?= $data['bukti_pembayaran']?></td>
                                </tr>
                            </table>
                            <h5 class="mt-4">Bukti Pembayaran</h5>
                            <a href="/assets/images/imagestore/buktipembayaran/<?= $data['bukti_pembayaran']?>" title="Lihat Gambar" style="cursor: zoom-in;">
                                <img src="/assets/images/imagestore/buktipembayaran/<?= $data['bukti_pembayaran']?>" alt="Bukti Pembayaran" class="img-fluid">
                            </a>
                        </div>
                        <form action="/admincontroller/confirmPayment">
                            <div class="form-group d-none" >
                                <label for="id_pembayaran" class="my-2">Id Pembayaran</label>
                                <input type="text" class="form-control" name="id_pembayaran" value="<?= $data['id_pembayaran']?>" >
                            </div>
                            <div class="form-group d-none" >
                                <label for="id_metode_pembayaran" class="my-2">Id Metode Pembayaran</label>
                                <input type="text" class="form-control" name="id_metode_pembayaran" value="<?= $data['id_metode_pembayaran']?>" >
                            </div>
                            <div class="form-group d-none" >
                                <label for="keterangan_pembayaran" class="my-2">Keterangan Pembayaran</label>
                                <input type="text" class="form-control" name="keterangan_pembayaran" value="<?= $data['keterangan_pembayaran']?>" >
                            </div>
                            <label for="keterangan_status" class="my-2">Status Pembayaran</label>
                            <select class="form-select" aria-label="Default select example" name="status_pembayaran">
                                <option value="sudah dibayar" >Pembayaran Diterima</option>
                                <option value="pembayaran ditolak" >Pembayaran Ditolak</option>
                            </select>
                            <div class="form-group" >
                                <label for="keterangan_status" class="my-2">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan_status">
                            </div>
                            <div class="my-4">
                                <button type="submit" class="btn btn-primary main-bg d-flex align-items-center">
                                    <span class="material-icons-round mx-1">verified</span>
                                    <span class="mx-1">
                                        Verifikasi Pembayaran
                                    </span>
                                </button>
                            </div>
                        </form>
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

