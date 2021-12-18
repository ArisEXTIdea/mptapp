<?= $this->extend('/theme/head') ?>

<!-- Import css here -->
<?= $this->section('css') ?>
<link rel="stylesheet" href="/assets/css/frontpage/buatpesanan.css">
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
                <h3 class="text-center mt-5">Pesanan Berhasil Dibuat</h3>
                <img src="/assets/images/systemimages/successanim.gif" alt="animasi berhasil" style="width: 50%">
                <div class="row justify-content-center">
                    <div class="col-8">
                        <p class="text-center">Agen kami akan menghubungi anda segera atau silakan untuk datang ke <br><br> KANTOR PEMASARAN  MAESTRO RESIDENCE PERUMAHAN SUBSIDI BERKUALITAS DEVELOPER PT. MAESTRO PUTRA TIMUR Jl. KH. Wahid hasim no.146 kel. Bapangan rt.04 rw.01 Jepara <br><br> Untuk menindaklanjuti pesanan anda dalam jangka waktu 7 hari kerja dan melengkapi berkas yang dibutuhkan. atau anda dapat mengubungi Kontak berikut untuk info lebih lanjut mengenai kelengkapan berkas.</p>
                        <div class="d-flex justify-content-center">
                            <a href="/#kontak" class="btn btn-primary btn-block main-bg">Hubungi Kami</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo view('/theme/footerfull')?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

