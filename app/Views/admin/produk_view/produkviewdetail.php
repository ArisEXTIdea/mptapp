<?= $this->extend('/theme/head') ?>

<!-- Import css here -->
<?= $this->section('css') ?>
<!-- <link rel="stylesheet" href="/assets/css/admin/listpengguna.css"> -->
<?= $this->endSection() ?>

<!-- Import Javascript here -->

<?= $this->section('js') ?>
<script src="/assets/js/admin/produk.js"></script>
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
                <div class="d-flex justify-content-between my-3">
                    <div>
                        <h3 class="mb-3">Detail Produk Perumahan</h3>
                    </div>
                    <div>
                        <a href="/admin/daftar-produk" class="btn btn-warning d-flex align-items-center">
                        <span class="material-icons-round">arrow_back</span>
                            Kembali
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <?php $productpic = json_decode( $data['product_pic'])?>
                            <?php foreach($productpic as $pp):?>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="/assets/images/imagestore/produk/<?= $pp?>" alt="Second slide">
                            </div>
                            <?php endforeach;?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        </div>
                        <div class="my-3">
                            <a href="/admin/daftar-produk-edit/<?= implode('-' ,explode(' ',$data['judul_p']))?>" class="btn btn-danger main-bg">Edit Produk</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 border py-3">
                        <h3 class="mb-3">Detail Produk Perumahan</h3>
                        <table>
                            <tr>
                                <td>Judul</td>
                                <td>: <?= $data['judul_p'] ?></td>
                            </tr>
                            <tr>
                                <td>Harga</td>
                                <td>: <?= number_format($data['harga_normal']) ?></td>
                            </tr>
                            <tr>
                                <td>Harga Diskon</td>
                                <td>: <?= number_format($data['harga_diskon']) ?></td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td>: <?= $data['kategori_p'] ?></td>
                            </tr>
                            <tr>
                                <td>Alamat Rumah</td>
                                <td>: <?= $data['alamat'] ?></td>
                            </tr>
                            <tr>
                                <td>Subsidi</td>
                                <td>: <?= $data['subsidi'] ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Kamar Tidur</td>
                                <td>: <?= $data['kt'] ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Kamar Mandi</td>
                                <td>: <?= $data['km'] ?></td>
                            </tr>
                            <tr>
                                <td>Luas Bangunan</td>
                                <td>: <?= $data['luas_area'] ?></td>
                            </tr>
                            <tr>
                                <td>Panjang Bangunan</td>
                                <td>: <?= $data['panjang_bangunan'] ?></td>
                            </tr>
                            <tr>
                                <td>Lebar Bangunan</td>
                                <td>: <?= $data['lebar_bangunan'] ?></td>
                            </tr>
                            <tr>
                                <td>Daya Listrik</td>
                                <td>: <?= $data['listrik'] ?></td>
                            </tr>
                            <tr>
                                <td>Sumber Air</td>
                                <td>: <?= $data['air'] ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Unit</td>
                                <td>: <?= $data['jumlah_unit'] ?></td>
                            </tr>
                            <tr>
                                <td>Unit Tersisa</td>
                                <td>: <?= $data['unit_tersisa'] ?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>: <?= $data['status'] ?></td>
                            </tr>
                            <tr>
                                <td>Produk Dibuat Pada</td>
                                <td>: <?= $data['created_at'] ?></td>
                            </tr>
                            <tr>
                                <td>Produk Diupdate Pada </td>
                                <td>: <?= $data['updated_at'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row border p-5 mt-2">
                    <div class="col-8">
                        <h4>Deskripsi Produk</h4>
                        <?= $data['deskripsi'] ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo view('/theme/footer')?>
    </div>
</div>
<?= $this->endSection() ?>

