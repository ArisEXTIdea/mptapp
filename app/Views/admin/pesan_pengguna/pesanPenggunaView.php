<?= $this->extend('/theme/head') ?>

<!-- Import css here -->
<?= $this->section('css') ?>
<!-- <link rel="stylesheet" href="/assets/css/admin/listpengguna.css"> -->
<?= $this->endSection() ?>

<!-- Import Javascript here -->

<?= $this->section('js') ?>
<!-- <script src="/assets/js/admin/pengguna.js"></script> -->
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
                <div id="pesan-modal" class="p-3">
                    
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
                    <div class="col-12 d-flex justify-content-between">
                        <h3>Pesan</h3>
                        <div class="text-end d-flex">
                            <h6>Total Pesan: <b><?= $totalPesan ?></b>,</h6>
                            <h6 class="mx-3">Dibaca: <b class="text-success"><?= $dibaca ?></b>, </h6>
                            <h6>Belum Dibaca: <b class="text-danger"><?= $belumDibaca ?></b></h6>
                        </div>
                    </div>
                </div>
                <?php foreach($dataPesan as $dp):?>
                <div class="row p-2">
                    <div class="col-12 shadow-sm p-3 rounded border">
                        <div>
                            <div class="d-flex justify-content-between mb-2">
                                <h4><?= $dp['sender_name'] ?></h4>
                            </div>
                            <?php 
                                $message = '';
                                if(strlen($dp['message']) < 100){
                                    $message = $dp['message'];
                                } else {
                                    $message = substr($dp['message'], 0, 400) . '...';
                                }
                            
                            ?>
                            <p> <?= $message ?> </p>
                        </div>
                        <div class="">
                            <div class="d-flex justify-content-between">
                                <p> <b>Dikirim oleh:</b>  <?= $dp['sender_email'] ?>, <?= $dp['sender_phone'] ?></p>
                                <?php 
                                    $status = '';

                                    if($dp['status'] == 'Dibaca'){
                                        $status = 'text-success';
                                    }
                                    else{
                                        $status = 'text-danger';
                                        
                                    }
                                ?>
                                <p class="<?= $status ?> text-end"><?= $dp['status'] ?></p>
                            </div>
                            <div>
                                <p> <b>Dikirim Pada:</b>  <?= $dp['created_at'] ?></p>

                                <a href="#" class="btn btn-primary main-bg" onclick="lihatPesan('<?= $dp['id_message']?>', '<?= $dp['id_produk']?>')">Baca Selengkapnya</a>
                                <a href="#" onclick="deletePesan('<?= $dp['id_message']?>')" class="btn btn-danger">Hapus Pesan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
                <div class="mt-2">
                    <?= $pager->links() ?>  
                </div>
            </div>
        </div>
        <?php echo view('/theme/footer')?>
    </div>

    <!-- Ajax request -->

    <script>
        const deletePesan = (id) => {
            var conf = confirm('Apakah anda yakin menghapus data ini?')
            $(document).ready(function () {
                if(conf){
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url().'/AdminController/deletePesan'?>",
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
        const lihatPesan = (id, id_produk) => {
            openModal()
            $(document).ready(function () {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url().'/AdminController/getPesanId'?>",
                    data:  `id=${id}& id_produk=${id_produk}`,
                    dataType: "json",
                    success: function (response) {
                        console.log(response)
                        var dataPesan = response.dataPesan
                        var namaProduk = response.namaproduk
                        console.log(response.namaproduk)
                        $("#pesan-modal").html(
                            `<h4>Pengirim: ${dataPesan['sender_name']}</h4>`+
                            `<div class="my-4" style="line-height: 10px">` +
                                `<p>Email: ${dataPesan['sender_email']}</p>` +
                                `<p>Nomor Telepon: ${dataPesan['sender_phone']}</p>` +
                                `<p>Nama Produk Rumah: ${namaProduk}</p>` +
                            `</div>` +
                            `<h5>Pesan:</h5>` +
                            `<p style="word-break: break-all;">${dataPesan['message']}</p>
                            <p class="d-flex align-items-center"><span class="material-icons-round">calendar_month</span>${dataPesan['created_at']}</p>` 
                        );
                    }
                });
            });
        }
    </script>
</div>
<?= $this->endSection() ?>

