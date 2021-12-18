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
                <div class="row justify-content-center my-3 mb-4">
                    <div class="col-12 col-md-10">
                        <form action="/FrontPageController/searchProduct" method='post'>
                            <?= csrf_field() ?>
                            <div class="form-group d-flex">
                                <input type="text" class="form-control form-control-lg" placeholder="Cari rumah murah terbaru" name="searchKey">
                                <button class="btn btn-primary main-bg btn-lg d-block ml-3">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 m-3 p-4 w-bg">
                        <h3 class="text-center">Buat Pesanan</h3>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="card p-0 m-3" style="width: 100%;">
                                    <img height="auto" class="card-img-top" src="/assets/images/imagestore/produk/<?= json_decode($produkData['product_pic'])[0] ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $produkData['judul_p']?></h5>
                                        <div>
                                            <table>
                                                <tr>
                                                    <td> Nama Perumahan</td>
                                                    <td> : <?= $produkData['kategori_p']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Harga</td>
                                                    <td> : Rp. <b><?= number_format($produkData['harga_diskon'])?></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Subsidi</td>
                                                    <td> : <?= $produkData['subsidi']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Lokasi Perumahan</td>
                                                    <td> : <?= $produkData['alamat']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Luas Bangunan</td>
                                                    <td> : <?= $produkData['luas_area']?><sup>2</sup></td>
                                                </tr>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <form action="/frontpagecontroller/buatPesanan">
                            <div class="col-12 p-3">
                                <div class="form-group d-none">
                                    <label for="harga">Harga</label>
                                    <input type="text" name="harga" class="form-control" value="<?= number_format($produkData['harga_diskon'])?>">
                                </div><div class="form-group d-none">
                                    <label for="harga">Harga</label>
                                    <input type="text" name="id_produk" class="form-control" value="<?= $produkData['id_produk']?>">
                                </div>
                                </div><div class="form-group d-none">
                                    <label for="harga">Harga</label>
                                    <?php 
                                        $sesionUser = session('login');

                                    ?>
                                    <input type="text" name="userId" class="form-control" value="<?= $sesionUser['userId'] ?>">
                                </div>
                                <div class="form-group my-2">
                                    <label for="pembayaran">Metode Pembayaran</label>
                                    <select name="pembayaran" class="form-select" required>
                                        <option  disabled>--Pilih Status--</option>
                                        <option value="KPR">KPR</option>
                                        <option selected value="Cash Tunai">Cash Tunai</option>
                                        <option value="Cash Bertahap">Cash Bertahap</option>
                                    </select>
                                </div>
                                    <h4 class="my-3">Pilih bank yang akan digunakan untuk pembayaran:</h4>
                                        <div>
                                            <div class="form-check form-check-inline m-2">
                                                <input class="form-check-input" type="radio" name="bank" id="inlineRadio1" value="BTN" required>
                                                <label class="form-check-label" for="inlineRadio1">
                                                    <div class="bank-item d-flex p-2 align-items-center justify-content-center border" >
                                                        <img src="/assets/images/systemimages/bbtn2.png" alt="logo bank" class="img-fluid">
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline m-2">
                                                <input class="form-check-input" type="radio" name="bank" id="inlineRadio1" value="Bank Syariah Indonesia" required>
                                                <label class="form-check-label" for="inlineRadio1">
                                                    <div class="bank-item d-flex p-2 align-items-center justify-content-center border" >
                                                        <img src="/assets/images/systemimages/bbsilogo.png" alt="logo bank" class="img-fluid">
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline m-2">
                                                <input class="form-check-input" type="radio" name="bank" id="inlineRadio1" value="Bank Mandiri" required>
                                                <label class="form-check-label" for="inlineRadio1">
                                                    <div class="bank-item d-flex p-2 align-items-center justify-content-center border" >
                                                        <img src="/assets/images/systemimages/bmandirilogo.png" alt="logo bank" class="img-fluid">
                                                    </div>
                                                </label>
                                            </div>
                                            <h4 class="my-3">Pembayaran Lain</h4>
                                            <div class="form-check form-check m-2">
                                                <input class="form-check-input" type="radio" name="bank" id="inlineRadio1" value="Bank Bpr BKK Jepara" required>
                                                <label class="form-check-label" for="inlineRadio1">Bank BKK
                                                </label>
                                            </div>
                                            <div class="form-check form-check m-2">
                                                <input class="form-check-input" type="radio" name="bank" id="inlineRadio1" value="Koperasi" required>
                                                <label class="form-check-label" for="inlineRadio1">koperasi
                                                </label>
                                            </div>
                                            <div class="form-check form-check m-2">
                                                <input class="form-check-input" type="radio" name="bank" id="inlineRadio1" value="Tunai" required>
                                                <label class="form-check-label" for="inlineRadio1">Tunai
                                                </label>
                                            </div>
                                        </div>
                                        <h3 class="p-4 main-bg">Harga Total: Rp, <?= number_format($produkData['harga_diskon'])?></h3>

                                        <div class="my-3">
                                            <button class="btn btmn-primary main-bg" >Buat Pesanan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo view('/theme/footerfull')?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

