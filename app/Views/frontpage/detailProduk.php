<?= $this->extend('/theme/head') ?>

<!-- Import css here -->
<?= $this->section('css') ?>
<link rel="stylesheet" href="/assets/css/frontpage/detailproduk.css">
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
                <!-- Image Slider -->
                <div class="col-12 col-md-6">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <!-- Render image -->
                        <?php 
                            $image = json_decode($data['product_pic']);
                            $id = 0;
                            $active = '';
                        ?>
                        <?php foreach($image as $i):?>
                            <?php 
                            if($id == 0){
                                $active = 'active';
                            } else {
                                $active = '';
                            }
                            $id++;
                            ?>
                        <div class="carousel-item <?=$active?>">
                            <img class="d-block w-100" src="/assets/images/imagestore/produk/<?= $i ?>" alt="First slide">
                        </div>
                        <?php endforeach;?>
                        <!-- ------------ -->
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
                </div>
                <div class="col-12 col-md-6 w-bg p-4">
                    <h3><?= $data['judul_p'] ?></h3>
                    <div class="main-bg p-3 d-flex align-items-center">
                        <h5 class="mt-3"> <del>Rp, <?= number_format($data['harga_normal']) ?></del></h5> <h3 class="mx-5">Harga Spesial: Rp, <?= number_format($data['harga_diskon']) ?></h3>
                    </div>
                    <div class="my-4">
                        <ul class="detail-item">
                            <li class="d-flex align-items-center my-2"><span class="material-icons-round mx-2">maps_home_work</span> <?= $data['kategori_p'] ?></li>
                            <li class="d-flex align-items-center my-2"><span class="material-icons-round mx-2">location_on</span> <?= $data['alamat'] ?></li>
                            <li class="d-flex align-items-center my-2"><span class="material-icons-round mx-2">home</span>Subsidi:  <?= $data['subsidi'] ?></li>
                            <li class="d-flex align-items-center my-2"><span class="material-icons-round mx-2">other_houses</span>Unit Tersisa: <?= $data['unit_tersisa'] ?></li>
                        </ul>
                    </div>
                    <div class="d-flex justify-content-start">
                        <div class="btn btn-outline-dark border d-flex align-items-center justify-content-center mx-1" style="min-width:80px">
                            <span class="material-icons-round">bed</span><b><?= $data['kt'] ?></b> 
                        </div>
                        <div class="btn btn-outline-dark border d-flex align-items-center justify-content-center mx-1" style="min-width:80px">
                            <span class="material-icons-round">bathtub</span><b><?= $data['km'] ?></b> 
                        </div>
                        <div class="btn btn-outline-dark border d-flex align-items-center justify-content-center mx-1" style="min-width:80px">
                            <span class="material-icons-round">fit_screen</span><b><?= $data['luas_area'] ?> <sup>2</sup></b> 
                        </div>
                        <div class="btn btn-outline-dark border d-flex align-items-center justify-content-center mx-1" style="min-width:80px">
                            <span class="material-icons-round">bolt</span><b><?= $data['listrik'] ?> VA</b> 
                        </div>
                        <div class="btn btn-outline-dark border d-flex align-items-center justify-content-center mx-1" style="min-width:80px">
                            <span class="material-icons-round">water_drop</span><b><?= $data['air'] ?></b> 
                        </div>
                    </div>
                    <div class="d-flex my-4">
                        <a href="#deskripsi" class="btn btn-primary main-bg mx-1">Lihat Deskripsi</a>
                        <a href="#" class="btn btn-warning mx-1" onclick="saveproduct('<?= $data['id_produk'] ?>')">Simpan Rumah</a>
                    </div>
                    <a href="/buat-pesanan/<?= implode('-', explode(' ', $data['judul_p']))?>" class="btn btn-primary main-bg btn-block w-100 btn-lg">Pesan Sekarang</a>
                </div>
                <div class="row mt-3">
                    <div class="col-12 w-bg p-5" id="deskripsi">
                        <h3>Deskripsi Rumah</h3>
                        <div>
                            <?= $data['deskripsi'] ?>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-md-6 w-bg p-5 inline-block border">
                        <!-- Kirim Pesan -->
                        <h3>Hubungi Kami</h3>
                        <form id="message-form"class="mt-3">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" class="form-control my-2">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control my-2">
                            </div>
                            <div class="form-group">
                                <label for="phone">Nomor HP/WA</label>
                                <input type="text" name="phone" class="form-control my-2">
                            </div>
                            <div class="form-group d-none">
                                <label for="id_produk">Id Produk</label>
                                <input type="text" name="id_produk" class="form-control my-2" value="<?= $data['id_produk']?>">
                            </div>
                            <div class="form-group">
                                <label for="pesan">Pesan</label>
                                <textarea name="pesan" class="form-control my-2" cols="30" rows="10"></textarea>
                            </div>
                            
                            <div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                                <p style="font-size: 10px">Kami akan menghubungi anda kembali melalui email atau nomor telepon yang anda kirimkan. Informasi mengenai nomor dan email anda akan kami simpan dan tidak akan kami sebarluaskan.</p>
                                <a href="#" class="btn btn-primary main-bg" onclick="sendMessage()">Kirim Pesan</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-6 w-bg p-5 border">
                        <h3>Simulasi KPR</h3>
                        <div class="d-flex">
                            <a href="https://www.btnproperti.co.id/simulasi-kpr-konvensional.html" class="m-2 kalkualator-kpr-container">
                                <div class="kalkualator-kpr-item border d-flex align-items-center justify-content-center">
                                    <img src="/assets/images/systemimages/bbtnlogo.png" alt="logo btn">
                                </div>
                            </a>
                            <a href="https://www.bankmandiri.co.id/kalkulator-kpr" class="m-2 kalkualator-kpr-container">
                                <div class="kalkualator-kpr-item border d-flex align-items-center justify-content-center">
                                    <img src="/assets/images/systemimages/bmandirilogo.png" alt="logo btn">
                                </div>
                            </a>
                            <a href="#" class="m-2 kalkualator-kpr-container">
                                <div class="kalkualator-kpr-item border d-flex align-items-center justify-content-center">
                                    <img src="/assets/images/systemimages/bbsilogo.png" alt="logo btn">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo view('/theme/footerfull')?>
        </div>
    </div>

    <script>
        const sendMessage = () => {
            console.log("a")

            $(document).ready(function () {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url().'/frontpagecontroller/sendmessage'?>",
                    data:$("#message-form").serialize(),
                    dataType: "json",
                    success: function (response) {
                        console.log(response)
                        alert('pesan anda telah terkirim')
                        location.reload() 
                    }
                });
            });
        }
    </script>

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
<?= $this->endSection() ?>

