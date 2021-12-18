<?= $this->extend('/theme/head') ?>

<!-- Import css here -->
<?= $this->section('css') ?>

<?= $this->endSection() ?>

<!-- Import Javascript here -->

<?= $this->section('js') ?>
<script src="/assets/js/admin/kategoriperumahan.js"></script>
<?= $this->endSection() ?>


<!-- Content Section -->

<?= $this->section('content') ?>
<div class="container-fluid m-0 p-0 main-c">
    <!-- Modal -->
    <div class="mymodal-container p-5 d-none">
        <div class="d-flex justify-content-center">
            <div class="mymodal">
                <div class="mymodal-header d-flex justify-content-between align-items-center p-2 main-bg">
                    <h4 id="mymodal-title">Tambah Perumahan</h4>
                    <a href="#" onclick="tutupModal()"><span class="material-icons-round">close</span></a>
                </div>
                <div id="data-perumahan" class="p-3">
                    <form method="post" id="form-kategori-perumahan">
                        <?= csrf_field() ?>
                        <div class='form-group d-none'>
                            <label for="id_perumahan">ID Perumahan</label>
                            <input type="text" class="form-control" name="id_perumahan" id="id_perumahan">
                        </div>
                        <div class='form-group'>
                            <label for="nama_perumahan">Nama Perumahan</label>
                            <input type="text" class="form-control" name="nama_perumahan" id="nama_perumahan" required>
                        </div>
                        <div class='form-group'>
                            <label for="keterangan_perumahan">Deskripsi</label>
                            <textarea name="keterangan_perumahan" rows="5" class='form-control' maxlength="200" id="keterangan_perumahan" required></textarea>
                        </div>
                        <div class='form-group'>
                            <label for="lokasi_perumahan">Lokasi</label>
                            <input type="text" class="form-control" name="lokasi_perumahan" id="lokasi_perumahan" required>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary main-bg" required>Simpan Perumahan</button>
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
            <?php echo view('/theme/sidemenu')?>
        </div>
        <div class="col-12 col-sm-8 col-md-9 col-lg-10 p-3 content-bg content-container" id='content'>
            <div class="container-fluid p-4 m-0 item-bg">
            <div class="row">
                <div class="row">
                    <!-- Header Section -->
                    <div class="col-12">
                        <h3>Kategori Perumahan</h3>
                    </div>
                    <!-- Allert pendaftaran berhasil -->
                    <?php $session = \Config\Services::session();?>
                    <?php if($session->getFlashdata('success')):?>
                    <div class="alert alert-success" role="alert" id="aleart">
                        <?php  echo $session->getFlashdata('success'); ?>
                    </div>
                    <?php endif;?>
                <!-- --------------------------------- -->
                </div>
                <!-- Category Table -->
                <div class="row">
                    <!-- Control -->
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <a href="#" class="btn btn-primary main-bg my-3 text-nowrap" onClick="openModal()" id="form-save-btn">Tambah Perumahan</a>
                            </div>
                        </div>
                        <!-- Table -->
                        <table class="table">
                            <thead class="main-bg">
                                <tr>
                                    <th scope="col" class="text-center text-nowrap">No</th>
                                    <th scope="col" class="text-center">Nama Perumahan</th>
                                    <th scope="col" class="text-center text-nowrap display-md-none" style="min-width: 100px">Deskripsi</th>
                                    <th scope="col" class="text-center text-nowrap" style="min-width: 100px">Lokasi</th>
                                    <th scope="col" class="text-center text-nowrap" style="min-width: 150px">Kontrol</th>
                                </tr>
                            </thead>
                            <tbody id="category-table">
                                <?php $number = 1 ?>
                                <?php foreach( $perumahanData as $pd):?>
                                    <tr>
                                        <td><?= $number++?></td>
                                        <td><?= $pd['nama_perumahan'] ?></td>
                                        <td class="display-md-none"><?= $pd['keterangan_perumahan'] ?></td>
                                        <td><?= $pd['lokasi_perumahan'] ?></td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-primary main-bg edit-kategori-perumahan-btn" onclick="editPerumahan('<?= $pd['id_perumahan']?>')" >Edit</a>
                                            <a href="#" class="btn btn-danger " onclick="deletePerumahan('<?= $pd['id_perumahan']?>')">Hapus</a>
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
                        url: "<?php echo base_url().'/AdminController/deletePerumahan'?>",
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
                    url: "<?php echo base_url().'/AdminController/getDataPerumahanId'?>",
                    data: `id=${id}`,
                    dataType: "json",
                    success: function (response) {
                        var data = response[0]
                        $("#id_perumahan").attr("value", data['id_perumahan']);
                        $("#nama_perumahan").attr("value", data['nama_perumahan']);
                        $("#keterangan_perumahan").text(data['keterangan_perumahan']);
                        $("#lokasi_perumahan").attr("value", data['lokasi_perumahan']);
                    }
                });
            });
        }
    </script>

</div>
<?= $this->endSection() ?>

