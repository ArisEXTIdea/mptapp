<?= $this->extend('/theme/head') ?>

<!-- Import css here -->
<?= $this->section('css') ?>
<link rel="stylesheet" href="/assets/css/frontpage/home.css">
<?= $this->endSection() ?>

<!-- Import Javascript here -->

<?= $this->section('js') ?>
<script src="/assets/js/frontpage/home.js">

</script>
<?= $this->endSection() ?>


<!-- Content Section -->

<?= $this->section('content') ?>
<div class="container-fluid m-0 p-0 main-c">
    <!-- Intro -->
    <?php echo view('/theme/navbar')?>
    <div class="row home-intro">
        <div class="col-12">
            <div class="row justify-content-center">
                <div class="col-12 home-intro-introtext d-flex align-items-center justify-content-center" style="background-image: url('/assets/images/imagestore/konten/<?= $kontenData['front_illustration_pic']?>');">
                    <div class="text-center">
                        <h1 class="home-header-text"><?= $kontenData['slogan'] ?></h1>
                        <p><?= $kontenData['keterangan_slogan'] ?></p>
                        <form action="/FrontPageController/searchProduct" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg" name="searchKey">
                            </div>
                        </form>
                        <a href="/semua-rumah" class="btn btn-primary main-bg px-5 border-light mt-3">Lihat Produk Kami</a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="text-center my-5 border-bottom"  id="produk">
                        <h4>Beli Sekarang</h4>
                        <p>Rumah berkualitas dengan segala tipe</p>
                    </div>
                    <div class="row justify-content-center">
                        <?php foreach($dataProduk as $dp):?>
                        <?php $productpic = json_decode( $dp['product_pic'])?>
                        <div class="card col-12 col-md-4 m-3 p-0" style="width: 18rem;">
                            <img class="card-img-top" src="/assets/images/imagestore/produk/<?= $productpic[0]?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title mb-3"><?= $dp['judul_p'] ?></h5>
                                <div class="my-3a">
                                    <p class="d-flex align-items-center">
                                        <span class="material-icons-round">sell</span> Rp, <?= number_format($dp['harga_normal']) ?>
                                    </p>
                                    <p class="d-flex align-items-center">
                                        <span class="material-icons-round">place</span> <?= $dp['alamat'] ?>
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="/rumah/<?= implode('-', explode(' ', $dp['judul_p'])) ?>" class="btn btn-primary main-bg px-5">Beli</a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                        <div class="d-flex justify-content-center mt-3">
                            <a href="/semua-rumah" class="btn btn-primary main-bg">Temukan Lebih Banyak</a>
                        </div>
                    </div>
                    <div class="text-center my-5 border-bottom">
                        <h4>Perumahan Kami</h4>
                        <p>Perumahan dengan akses jalan mudah</p>
                    </div>
                    <div class="row justify-content-center mb-5">
                        <?php foreach($dataKategori as $dk):?>
                        <div class="card mx-1 col-12 col-md-4 m-1" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title"><?= $dk['nama_perumahan'] ?></h5>
                                <p class="card-text"><?= $dk['keterangan_perumahan'] ?></p>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                    <div class="text-center my-5 border-bottom" id="tentang">
                        <h4>Tentang Kami</h4>
                        <p>Perumahan dengan akses jalan mudah</p>
                    </div>
                    <div>
                        <?= $kontenData['tentang_kami'] ?>
                    </div>
                    <div class="text-center my-5 border-bottom" id="kontak">
                        <h4>Hubungi Kami</h4>
                        <p>Hubungi untuk info lebih lengkap</p>
                    </div>
                    <div class="row p-0 m-0">
                        <div class="card p-0" style="width: 100rem;">
                            <div class="card-header">
                                Kontak
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex align-items-center"><i class="fas fa-house-user mx-2" style="color: #E1306C; font-size: 30px"></i> <?= $kontenData['alamat'] ?></li>
                                <li class="list-group-item d-flex align-items-center"><i class="fab fa-whatsapp mx-2" style="color: #25D366; font-size: 30px"></i><?= $kontenData['wa'] ?></li>
                                <li class="list-group-item d-flex align-items-center"><i class="fas fa-at mx-2" style="color: #DB4437; font-size: 30px"></i> <?= $kontenData['email'] ?></li>
                                <li class="list-group-item d-flex align-items-center"><i class="fab fa-facebook mx-2" style="color: #4267B2; font-size: 30px"></i> <?= $kontenData['fb'] ?></li>
                                <li class="list-group-item d-flex align-items-center"><i class="fab fa-instagram mx-2" style="color: #833AB4; font-size: 30px"></i> <?= $kontenData['ig'] ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="text-center my-5 border-bottom" id="cara-beli">
                        <h4>Cara Pemesanan</h4>
                        <p>Beli Rumah Mudah dan Cepat</p>
                    </div>
                    <?= $kontenData['cara_pemesanan'] ?>
                </div>
            </div>
            <?php echo view('/theme/footerfull')?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

