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
    <!-- Modal -->
    <div class="mymodal-container p-5 d-none">
        <div class="d-flex justify-content-center">
            <div class="mymodal">
                <div class="mymodal-header d-flex justify-content-between align-items-center p-2 main-bg">
                    <h4>Detail Pengguna</h4>
                    <a href="#" onclick="tutupModal()"><span class="material-icons-round">close</span></a>
                </div>
                <div id="data-diri" class="p-3">
    
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
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
                        <h3>Detail Pesanan</h3>
                    </div>
                </div>
                <!-- Users Tabele -->
                <div class="row">
                    <div class="col-12 p-3">
                        <table>
                            <tr>
                                <td>Id Pesanan</td>
                                <td>: <?= $data['id_pesanan'] ?></td>
                            </tr>
                            <tr>
                                <td>Nama Pemesan</td>
                                <td>: <?= $data['full_name'] ?></td>
                            </tr>
                            <tr>
                                <td>Alamat Pemesan</td>
                                <td>: <?= $data['address'] ?></td>
                            </tr>
                            <tr>
                                <td>Nomor HP</td>
                                <td>: <?= $data['phone'] ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>: <?= $data['email'] ?></td>
                            </tr>
                            <tr>
                                <td>Rumah</td>
                                <td>: <?= $data['judul_p'] ?></td>
                            </tr>
                            <tr>
                                <td>Perumahan</td>
                                <td>: <?= $data['kategori_p'] ?></td>
                            </tr>
                            <tr>
                                <td>Alamat Rumah</td>
                                <td>: <?= $data['alamat'] ?></td>
                            </tr>
                            <tr>
                                <td>Harga</td>
                                <td>: Rp, <?= number_format($data['harga_diskon']) ?></td>
                            </tr>
                            <tr>
                                <td>Subsidi</td>
                                <td>: <?= $data['subsidi'] ?></td>
                            </tr>
                            <tr>
                                <td>Ukuran Rumah</td>
                                <td>: <?= $data['luas_area'] ?>m<sup>2</sup></td>
                            </tr>
                            <tr>
                                <td>Rencana Pembayaran</td>
                                <td>: <?= $data['pembayaran'] ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Pemesanan</td>
                                <td>: <?= $data['order_date'] ?></td>
                            </tr>
                            <tr>
                                <td>Bank yang dipilih</td>
                                <td>: <?= $data['bank'] ?></td>
                            </tr>
                            <tr>
                                <td>Aturan KPR</td>
                                <td>: <?= $data['status_pesanan'] ?></td>
                            </tr>
                        </table>
                        <div class="mt-3">
                            <a href="#" class="btn btn-primary main-bg" onclick="konfirmasiPesanan('<?= $data['id_pesanan']?>', 'Disetujui')">Terima Pesanan</a>
                            <a href="#" class="btn btn-danger" onclick="konfirmasiPesanan('<?= $data['id_pesanan']?>', 'Tidak Disetujui')">Tolak Pesanan</a>
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

    <script>
        const konfirmasiPesanan = (id, konfirmasi, pembayaran) => {
            console.log(pembayaran)
            if(konfirmasi == 'Disetujui'){
                var conf = confirm('Apakah anda yakin menyetujui pesanan ini?')
            } else {
                var conf = confirm('Apakah anda yakin menolak pesanan ini?')
            }

            $(document).ready(function () {
                if(conf){
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url().'/AdminController/konfirmasiPesanan'?>",
                        data:  `id=${id}& konfirmasi=${konfirmasi}`,
                        dataType: "json",
                        success: function (response) {
                            console.log(response)
                            if(konfirmasi == 'Disetujui' && response['metodePembayaran'] === 'KPR'){
                                window.location.replace("/admin/kpr");
                            } 

                            else if(konfirmasi == 'Disetujui' && response['metodePembayaran'] === 'Cash Bertahap'){
                                window.location.replace("/admin/cash-bertahap");
                            } 

                            else if(konfirmasi == 'Disetujui' && response['metodePembayaran'] === 'Cash Tunai'){
                                window.location.replace("/admin/cash-tunai");
                            } 
                            
                            else {
                                window.location.replace("/admin/riwayat-pesanan");
                            }
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

