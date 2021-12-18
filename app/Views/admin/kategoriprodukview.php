<?= $this->extend('/theme/head') ?>

<!-- Import css here -->
<?= $this->section('css') ?>

<?= $this->endSection() ?>

<!-- Import Javascript here -->

<?= $this->section('js') ?>
<script src="/assets/js/Kategori.js"></script>
<?= $this->endSection() ?>


<!-- Content Section -->

<?= $this->section('content') ?>
<div class="container-fluid m-0 p-0 main-c">
    <!-- Modal -->
    <div class="mymodal-container p-5 d-none">
        <div class="d-flex justify-content-center">
            <div class="mymodal">
                <div class="mymodal-header d-flex justify-content-between align-items-center p-2 main-bg">
                    <h4 id="mymodal-title"></h4>
                    <a href="#" onclick="tutupModal()"><span class="material-icons-round">close</span></a>
                </div>
                <div id="data-diri" class="p-3">
                    <form id="form-kategori" method="post">
                        <div class="form-group mb-3 d-none">
                            <label for="id_kategori" class="mb-2">Nama Kategori</label>
                            <input type="text" class="form-control" name="id_kategori" id="id-kategori-form">
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama_kategori" class="mb-2">Nama Kategori</label>
                            <input type="text" class="form-control" name="nama_kategori" id="nama-kategori-form" required>
                        </div>
                        <div class="form-group" class="mb-3">
                            <label for="nama_kategori" class="mb-2">Deskripsi Kategori</label>
                            <input type="text" class="form-control" name="deskripsi" id="deskripsi-kategori-form" maxlength="100" required>
                        </div>
                        <a href="#" type="submit" class="btn btn-primary main-bg mt-3" id="modal-btn" >Simpan</a>
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
                        <h3>Kategori Produk</h3>
                    </div>
                </div>
                <!-- Category Table -->
                <div class="row">
                    <!-- Control -->
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <a href="#" class="btn btn-primary main-bg my-3 text-nowrap" onClick="openModal()" id="form-save-btn">Tambah Kategori</a>
                            </div>
                            <div>
                                <form>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="category-search" placeholder="Cari Kategori disini" onkeyup="cariKategori()" id="kategori-search-form" >
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Table -->
                        <table class="table">
                            <thead class="main-bg">
                                <tr>
                                    <th scope="col" class="text-center text-nowrap">No</th>
                                    <th scope="col" class="text-center">Nama Kategori</th>
                                    <th scope="col" class="text-center text-nowrap" style="min-width: 100px">Deskripsi</th>
                                    <th scope="col" class="text-center text-nowrap" style="min-width: 100px">Kontrol</th>
                                </tr>
                            </thead>
                            <tbody id="category-table">
                                <!-- Table data rendered from ajax function -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo view('/theme/footer')?>
    <!-- Ajax Request for category module -->

    <!-- Get data and display it in table -->
    <script type="text/javascript">
        function getDataKategori() {
            $(document).ready(function () {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url().'/AdminController/getCategory'?>",
                    dataType: "json",
                    success: function (response) {
                        var dataToRender = response
                        var number = 1
                        var renderHtml = []
                        dataToRender.map(
                            dataRow => {
                                var dataKategori = JSON.stringify(dataRow)
                                console.log(dataKategori)
                                renderHtml.push(
                                    '<tr>' +
                                        '<td scope="row" class="text-center">'+ number++ +'</td>' +
                                        '<td>'+ dataRow['nama_kategori'] +'</td>' +
                                        '<td class="">'+ dataRow['deskripsi'] +'</td>' +
                                        '<td class="text-center">'+
                                            "<a href='#' class='btn btn-primary main-bg mx-1 text-nowrap' onclick='editModalShow("+ dataKategori +")'>Edit</a>" +
                                            '<a href="#" class="btn btn-danger mx-1 text-nowrap" onclick="deleteCategory('+'\''+ dataRow['id_kategori'] +'\''+')">Hapus</a>'+
                                        '</td>' +
                                    '</tr>'
                                )
                            }

                        )
                        $("#category-table").html(
                            renderHtml.map(
                                renderHtml => renderHtml
                            )
                        );
                    }
                });
            });
        }
    
        getDataKategori()
    </script>

<!-- Simpan data -->

    <script type="text/javascript">
        function saveKategori(){
            $(document).ready(function () {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url().'/AdminController/postCategory'?>",
                    data: $("#form-kategori").serialize(),
                    dataType: "json",
                    success: function (response) {
                        getDataKategori();
                        $(".mymodal-container").addClass("d-none");
    
                    }
                });
            });
        }
    </script>


<!-- Hapus Data -->

    <script>
        function deleteCategory(id){
            $status = confirm('Apakah Anda yakin menghapus data ini?');
            if($status){
                $(document).ready(function () {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url().'/AdminController/deleteCategory'?>",
                        data: "id_kategori=" + id,
                        dataType: "json",
                        success: function (response) {
                            getDataKategori()
                        }
                    });
                });
            }
        }
    </script>
    

    <!-- Edit Data -->

    <script type="text/javascript">
        function editKategori(){
            $(document).ready(function () {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url().'/AdminController/editCategory'?>",
                    data: $("#form-kategori").serialize(),
                    dataType: "json",
                    success: function (response) {
                        getDataKategori();
                        $(".mymodal-container").addClass("d-none");
                        $("#id-kategori-form").attr("value", "");
                        $("#nama-kategori-form").attr("value", "");
                        $("#deskripsi-kategori-form").attr("value", "");
                    }
                });
            });
        }
    </script>


<!-- Pencarian data -->
    <script>
        function cariKategori(){
            $(document).ready(function () {
                var data = $("#kategori-search-form").val();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url().'/AdminController/serachCategory'?>",
                    data: "searchKey=" + data,
                    dataType: "json",
                    success: function (response) {
                        var dataToRender = response
                        var number = 1
                        var renderHtml = []
                        dataToRender.map(
                            dataRow => {
                                var dataKategori = JSON.stringify(dataRow)
                                console.log(dataKategori)
                                renderHtml.push(
                                    '<tr>' +
                                        '<td scope="row" class="text-center">'+ number++ +'</td>' +
                                        '<td>'+ dataRow['nama_kategori'] +'</td>' +
                                        '<td>'+ dataRow['deskripsi'] +'</td>' +
                                        '<td class="text-center">'+
                                            "<a href='#' class='btn btn-primary main-bg mx-1' onclick='editModalShow("+ dataKategori +")'>Edit</a>" +
                                            '<a href="#" class="btn btn-danger mx-1" onclick="deleteCategory('+'\''+ dataRow['id_kategori'] +'\''+')">Hapus</a>'+
                                        '</td>' +
                                    '</tr>'
                                )
                            }

                        )
                        $("#category-table").html(
                            renderHtml.map(
                                renderHtml => renderHtml
                            )
                        );
                    }
                });
            });
        }
    </script>
    

    
</div>
<?= $this->endSection() ?>

