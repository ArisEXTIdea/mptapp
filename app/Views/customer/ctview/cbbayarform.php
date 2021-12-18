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
                    <div class="d-flex justify-content-between">
                        <h3 class="mb-4">Bayar Tagihan CB</h3>
                        <a href="/customer/transaksi" class="btn btn-warning d-flex align-items-center">
                            <span class="material-icons-round">arrow_back</span>
                            Kembali
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form action="/customercontroller/updatepembayaran" enctype="multipart/form-data" method="post">
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
                                <div class="my-3">
                                    <p><b>Nama Penerima : <span id="np">Bank belum dipilih</span></b></p>
                                    <p><b>Nomor Rekening : <span id="nop">Bank belum dipilih</span></b></p>
                                </div>
                                <div class="border p-2 rounded">
                                    <p style="font-size: 10px">Silakan melakukan pembayaran kepada nomor rekening diatas dan mengunggah bukti pembayaran pada upload bukti pembayaran di bawah ini.</p>
                                </div>
                                <div class="form-group">
                                    <label for="bukti_pembayaran" class="my-2">Pilih Bank</label>
                                    <input type="file" name="bukti_pembayaran" class="form-control" required>
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

