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
                    <div class="row">
                    <div class="d-flex justify-content-between">
                        <h3>Detail Pembayaran</h3>
                        <a href="/customer/pembayaran-kpr/<?= $data['id_metode_pembayaran']?>" class="btn btn-warning d-flex align-items-center">
                            <span class="material-icons-round">arrow_back</span>
                            Kembali
                        </a>
                    </div>
                    </div>
                    <div class="row jsutify-content-center">
                        <div class="col-12">    
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
                                <tr>
                                    <td>Status Pembayaran</td>
                                    <td>: <?= $data['status_pembayaran']?></td>
                                </tr>
                            </table>
                            <h5 class="mt-4">Bukti Pembayaran</h5>
                            <a href="/assets/images/imagestore/buktipembayaran/<?= $data['bukti_pembayaran']?>" title="Lihat Gambar" style="cursor: zoom-in;">
                                <img src="/assets/images/imagestore/buktipembayaran/<?= $data['bukti_pembayaran']?>" alt="Bukti Pembayaran" class="img-fluid">
                            </a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <?php echo view('/theme/footerfull')?>
        </div>
    </div>

    <script>
        // Ubah nama penerima dan nomor pembayaran
        const changeInfoBank = () => {
            $(document).ready(function () {
                var namaPenerima = $("#bank_pembayaran").find(':selected').attr('penerima');
                var nomorPembayaran = $("#bank_pembayaran").find(':selected').attr('pembayaran');
               
                $("#np").text(namaPenerima);
                $("#nop").text(nomorPembayaran);
            });
        }
    </script>
</div>
<?= $this->endSection() ?>

