<?= $this->extend('/theme/head') ?>

<!-- Import css here -->
<?= $this->section('css') ?>
<link rel="stylesheet" href="/assets/css/frontpage/allproduct.css">
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
                <div class="col-11 col-md-9 product-search m-2 p-0 d-flex justify-content-between">
                    <div>
                        <a href="#" class="btn btn-primary main-bg" id="filter-slide-button">Filter </a>
                    </div>
                    <form action="/frontPageController/searchProduct" method="post" class="d-flex">
                        <?= csrf_field() ?>
                        <div class="form-group mx-2">
                            <input type="text" name="searchKey" placeholder="Cari Produk di sini..." class="form-control form-search mr-2">
                        </div>
                        <div>
                            <button class="btn btn-primary main-bg">Cari</button>
                        </div>
                    </form>
                </div>
                <div class="col-11 col-md-9 product-search m-2 p-0 d-flex justify-content-between">
                    <h4>Hasil Pencarian: <?= count($dataProduk) ?> </h4>
                </div>


                <!-- Filter -->
                <div class="col-11 col-md-9 product-filter m-2 p-2 px-3 pb-3" id="search-filter" style="display:none">
                    <h4>Filter</h4>
                    <h6 class="mt-4"><b>Subsidi</b></h6>
                    <form action="/frontpagecontroller/filterSearch" method="post">
                        <?= csrf_field() ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="subsidi" id="flexRadioDefault1" value="Iya">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Iya
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="subsidi" id="flexRadioDefault2" value="Tidak">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Tidak
                            </label>
                        </div>
                        <!-- <div class="mt-3">
                            <label><b>Rentang Harga</b></label>
                            <div class="form-group d-flex justify-content-between mt-2">
                                <input type="number" name="harga-min" placeholder="Harga minimal" class="form-control" value = '0' required>
                                <div style="width: 100px">

                                </div>
                                <input type="number" name="harga-max" placeholder="Harga maksimal" class="form-control">
                            </div>
                        </div> -->
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary main-bg">Aplly Filter</button>
                        </div>
                    </form>
                </div>

                <!-- Product -->

                <div class="d-flex justify-content-end">
                    <div class="toast p-0 m-0 position-fixed" role="alert" aria-live="assertive" aria-atomic="true" style="z-index: 1">
                        <div class="toast-header main-bg p-2 m-0">
                            <strong class="mr-auto toast-h">Sukses</strong>
                        </div>
                        <div class="toast-body">
                            Produk berhasil disimpan.
                        </div>
                    </div>
                </div>

                <div class="col-11 col-md-9 product-display m-2 ">
                    <div class="row justify-content-between">
                        <?php foreach($dataProduk as $dp):?>
                        <div class="card p-0 m-3" style="max-width: 33rem;">
                            <img height="250" class="card-img-top" src="/assets/images/imagestore/produk/<?=json_decode($dp['product_pic'])[0] ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?= $dp['judul_p'] ?></h5>
                                <div>
                                    <table>
                                        <tr>
                                            <td> Nama Perumahan</td>
                                            <td> : <?= $dp['kategori_p'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Harga</td>
                                            <td> : <b>Rp <?= number_format($dp['harga_normal']) ?></b></td>
                                        </tr>
                                        <tr>
                                            <td>Subsidi</td>
                                            <td> : <?= $dp['subsidi'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Lokasi Perumahan</td>
                                            <td> : <?= $dp['alamat'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Luas Bangunan</td>
                                            <td> : <?= $dp['luas_area'] ?>m<sup>2</sup></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    <a href="/rumah/<?= implode('-', explode(' ', $dp['judul_p'])) ?>" class="btn btn-primary main-bg d-flex justify-content-center align-items-center my-2">Lihat Perumahan</a>
                                    <a href="#" class="btn btn-danger d-flex justify-content-center align-items-center" onclick="saveproduct('<?= $dp['id_produk'] ?>')"><span class="material-icons-round" >add_shopping_cart</span></a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                        <?= $pager->links() ?>
                    </div>
                </div>
            </div>
            <?php echo view('/theme/footerfull')?>
        </div>
        <script>
        const saveproduct = (id) => {
            $(document).ready(function () {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url().'/Customercontroller/saveProduct'?>",
                    data: `id=${id}`,
                    dataType: "json",
                    success: function (response) {
                        $(".toast-body").text('Produk Berhasil Disimpan');
                        $(".toast-h").text('Sukses');
                        $('.toast').toast('show')
                    },
                    error: function (err) {
                        $(".toast-h").text('Perhatian');
                        $(".toast-body").text('Produk sudah pernah Disimpan');
                        $('.toast').toast('show')
                    }   
                });
            });
        }
    </script>
    </div>
</div>
<?= $this->endSection() ?>

