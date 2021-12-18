<?= $this->extend('/theme/head') ?>

<!-- Import css here -->
<?= $this->section('css') ?>

<?= $this->endSection() ?>

<!-- Import Javascript here -->

<?= $this->section('js') ?>
<script src="/assets/js/admin/bank.js"></script>
<?= $this->endSection() ?>


<!-- Content Section -->

<?= $this->section('content') ?>
<div class="container-fluid m-0 p-0 main-c">
    <!-- Modal -->
    <div class="mymodal-container p-5 d-none">
        <div class="d-flex justify-content-center">
            <div class="mymodal">
                <div class="mymodal-header d-flex justify-content-between align-items-center p-2 main-bg">
                    <h4 id="mymodal-title">Bank</h4>
                    <a href="#" onclick="tutupModal()"><span class="material-icons-round">close</span></a>
                </div>
                <div id="data-perumahan" class="p-3">
                    <form method="post" id="form-kategori-bank">
                        <?= csrf_field() ?>
                        <div class='form-group d-none'>
                            <label for="id_bank">ID Bank</label>
                            <input type="text" class="form-control" name="id_bank" id="id_bank">
                        </div>
                        <div class='form-group'>
                            <label for="nama_bank">Nama Bank</label>
                            <input type="text" class="form-control" name="nama_bank" id="nama_bank" required>
                        </div>
                        <div class='form-group'>
                            <label for="nama_penerima">Nama Penerima</label>
                            <input name="nama_penerima" class='form-control' id="nama_penerima" required>
                        </div>
                        <div class='form-group'>
                            <label for="nomor_pembayaran">Nomor Pembayaran</label>
                            <input type="text" class="form-control" name="nomor_pembayaran" id="nomor_pembayaran" required>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary main-bg" required>Simpan Bank</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->

    <?php echo view('/theme/header')?>
    <div class="row p-0 m-0" style="height: 100vh">
        <div class="col-12 col-sm-4 col-md-3 col-lg-2 p-0 m-0" id="sidebar">
            <?php echo view('/theme/Sidemenu')?>
        </div>
        <div class="col-12 col-sm-8 col-md-9 col-lg-10 p-3 content-bg content-container" id='content'>
            <div class="container-fluid p-4 m-0 item-bg">
            <div class="row">
                <div class="row">
                    <!-- Header Section -->
                    <div class="col-12">
                        <h3>Informasi Bank</h3>
                    </div>
                    <div class="col-12">
                        <?php $session = \Config\Services::session();?>
                        <?php if($session->getFlashdata('success')):?>
                        <div class="alert alert-success" role="alert" id="aleart">
                            <?php  echo $session->getFlashdata('success'); ?>
                        </div>
                        <?php endif;?>
                    </div>
                    <!-- Allert pendaftaran berhasil -->
                <!-- --------------------------------- -->
                </div>
                <!-- Category Table -->
                <div class="row">
                    <!-- Control -->
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <a href="#" class="btn btn-primary main-bg my-3 text-nowrap" onClick="openModal()" id="form-save-btn">Tambah Bank</a>
                            </div>
                        </div>
                        <!-- Table -->
                        <table class="table">
                            <thead class="main-bg">
                                <tr>
                                    <th scope="col" class="text-center text-nowrap">No</th>
                                    <th scope="col" class="text-center">Nama Bank</th>
                                    <th scope="col" class="text-center text-nowrap display-md-none" style="min-width: 100px">Nama Penerima</th>
                                    <th scope="col" class="text-center text-nowrap display-md-none" style="min-width: 100px">Nomor Pembayaran</th>
                                    <th scope="col" class="text-center text-nowrap" style="min-width: 150px">Kontrol</th>
                                </tr>
                            </thead>
                            <tbody id="category-table">
                                <?php $number = 1 ?>
                                <?php foreach( $bankData as $pd):?>
                                    <tr>
                                        <td><?= $number++?></td>
                                        <td><?= $pd['nama_bank'] ?></td>
                                        <td class="display-md-none"><?= $pd['nama_penerima'] ?></td>
                                        <td class="display-md-none"><?= $pd['nomor_pembayaran'] ?></td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-primary main-bg edit-kategori-perumahan-btn" onclick="editPerumahan('<?= $pd['id_bank']?>')" >Edit</a>
                                            <a href="#" class="btn btn-danger " onclick="deletePerumahan('<?= $pd['id_bank']?>')">Hapus</a>
                                        </td>

                                    </tr>
                                <?php endforeach;?>
                                <!-- Table data rendered from ajax function -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo view('/theme/footer')?>


    <!-- Ajax -->

    <script>
        const deletePerumahan = (id) => {
            var confirmation = confirm('Apakah anda yakin menghapus data ini?');
            if(confirmation){
                $(document).ready(function () {
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url().'/AdminController/deleteBank'?>",
                        data: "id=" + id,
                        dataType: "json",
                        success: function (response) {

                        }
                    });
                });
            }
            setTimeout(() => {
                location.reload()              
            }, 300);          
        }
    </script>
    <script>
        const editPerumahan = (id) => {
            $("#aleart").fadeOut()
            openModal()
            $(document).ready(function () {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url().'/AdminController/getDataBankId'?>",
                    data: `id=${id}`,
                    dataType: "json",
                    success: function (response) {
                        var data = response[0]
                        $("#id_bank").attr("value", data['id_bank']);
                        $("#nama_bank").attr("value", data['nama_bank']);
                        $("#nama_penerima").attr("value", data['nama_penerima']);
                        $("#nomor_pembayaran").attr("value", data['nomor_pembayaran']);
                    }
                });
            });
        }
    </script>

</div>
<?= $this->endSection() ?>

