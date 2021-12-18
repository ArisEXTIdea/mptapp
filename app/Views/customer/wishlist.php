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
                   <h3 class="mb-4">Wishlist Rumah</h3>
                   <div class="row">
                        <?php foreach($wishListData as $wsd):?>
                        <div class="card" style="width: 19rem;">
                            <img height="150" class="card-img-top" src="/assets/images/imagestore/produk/<?=json_decode($wsd['product_pic'])[0] ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?= $wsd['judul_p'] ?></h5>
                                <p class="card-text d-flex aling-items-center"><span class="material-icons-round mx-1" style="font-size: 17px">sell</span>Rp, <?= $wsd['harga_normal'] ?></p>
                                <p class="card-text d-flex aling-items-center"><span class="material-icons-round mx-1" style="font-size: 17px">apartment</span>Rp, <?= $wsd['harga_normal'] ?></p>
                                <div class="d-flex justify-content-between">
                                    <a href="/rumah/<?= implode('-', explode(' ', $wsd['judul_p']))?>" class="btn btn-primary main-bg d-flex align-items-center"><span class="material-icons-round mx-1">local_mall</span>Beli Sekarang</a>
                                    <a href="#" class="btn btn-danger" onClick="hapusWishlist('<?= $wsd['id_produk'] ?>')"><span class="material-icons-round">delete</span></a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                   </div>
                </div>
            </div>
            <?php echo view('/theme/footerfull')?>
        </div>
    </div>
    
    <script>
        const hapusWishlist = (id) => {
            $(document).ready(function () {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url().'/Customercontroller/deleteWishList'?>",
                    data: "id=" + id,
                    dataType: "json",
                    success: function (response) {
                        location.reload()
                    },
                    error: function (err) {
                        console.log('error')
                    }
                });
            });
        }
    </script>

</div>
<?= $this->endSection() ?>

