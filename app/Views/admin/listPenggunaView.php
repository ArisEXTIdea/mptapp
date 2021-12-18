<?= $this->extend('/theme/head') ?>

<!-- Import css here -->
<?= $this->section('css') ?>
<link rel="stylesheet" href="/assets/css/admin/listpengguna.css">
<?= $this->endSection() ?>

<!-- Import Javascript here -->

<?= $this->section('js') ?>
<script src="/assets/js/admin/pengguna.js"></script>
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
                <div id="data-diri" class="p-3">
    
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
                    <!-- Header Section -->
                    <div class="col-12">
                        <h3>Pengguna</h3>
                    </div>
                </div>
                <!-- Users Tabele -->
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="pengguna-baru" class="btn btn-primary main-bg my-1">Daftarkan User Baru</a>
                            </div>
                            <div>
                                <form>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Cari User disini" id="user-search" onkeyup="userSearch()">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table class="table table-striped">
                            <thead class='main-bg'>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col" class="user-img">Foto</th>
                                    <th scope="col" class="user-fullname text-center">Nama Lengkap</th>
                                    <th scope="col" class="user-address text-center display-md-none">Alamat</th>
                                    <th scope="col" class="user-phone text-center display-sm-none">Telepon</th>
                                    <th scope="col" class="user-email text-center display-sm-none" >Email</th>
                                    <th scope="col" class="user-level text-center display-sm-none">Level</th>
                                    <th scope="col" class="user-level text-center display-sm-none">Status</th>
                                    <th scope="col" class="text-center">Kontrol</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>    
                    </div>
                </div>
            </div>
        </div>
        <?php echo view('/theme/footer')?>
    </div>

    <!-- Ajax request -->

    <!-- Render data to table -->

    <script>
        const getData = () => {

            $(document).ready(function () {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url().'/AdminController/getuser'?>",
                    dataType: "json",
                    success: function (response) {
                        var renderHtml = [];
                        var number = 1;
                        response.map(
                            dataRow => {
                                var statusCondition = "";
                                if(dataRow['status'] === "Aktif"){
                                    statusCondition = "btn btn-success"
                                }
                                else{
                                    statusCondition = "btn btn-danger"
                                }
                                renderHtml.push(
                                    '<tr class="align-middle">' +
                                        '<th scope="row">'+ number++ +'</th>' +
                                        '<td class="user-img display-md"><img src="/assets/images/imagestore/profilepicture/'+dataRow['profile_picture']+'" alt="Gambar" ></td>' +
                                        '<td class="user-fullname">'+dataRow['full_name']+'</td>' +
                                        '<td class="user-address display-md-none">'+dataRow['address']+'</td>' +
                                        '<td class="user-phone display-sm-none">'+dataRow['phone']+'</td>' +
                                        '<td class="user-email display-sm-none">'+dataRow['email']+'</td>' +
                                        '<td class="user-level text-center display-sm-none"><b>'+dataRow['user_level']+'</b></td>' +
                                        `<td class="user-level text-center display-sm-none" style="min-width:110px"><div class="${statusCondition}">`+dataRow['status']+'</div></td>' +
                                        '<td>' +
                                            '<a href="#" class="btn btn-success main-bg" onclick="detailUser('
                                            +'\''+dataRow['userId']+'\''+ ',' +
                                            '\''+dataRow['status']+'\''+')">Detail</a>' +
                                        '</td>' +
                                    '</tr>'
                                )
                            }
                        )
                        $("tbody").html(renderHtml);
                    }
                });
            });
        }
        getData()
    </script>

    <!-- Buka Modal Detaik User -->
    <script>
        const detailUser = (id, status) => {
            openModal()
           var userId = `userId=${id}`
            $(document).ready(function () {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url().'/AdminController/getuserid'?>",
                    data: userId,
                    dataType: "json",
                    success: function (response) {
                        var statusFunc;
                        var statusBtn;
                        var statusBootsrap;
                        if(status === 'Aktif'){
                            statusFunc = "userSuspend"
                            statusBtn = "Nonaktifkan User"
                            statusBootsrap = "btn-danger"
                        }
                        else{
                            statusFunc = "userReactive"
                            statusBtn = "Aktifkan User"
                            statusBootsrap = "btn-success"
                        }
                        $("#data-diri").html(
                            '<div>' +
                                '<div class="d-flex justify-content-center">' +
                                    `<img src="/assets/images/imagestore/profilepicture/${response['profile_picture']}" alt="foto profil" width="200" height="200" style="border-radius: 50%">` +
                                '</div>' +
                                '<div>' +
                                    `<a href="#" class="btn ${statusBootsrap}" onclick="${statusFunc}(`+ '\'' + `${response['userId']}`+'\'' +`)">${statusBtn}</a>` +
                                '</div>' +
                                '<div class="my-3">' +
                                    '<table class="table table-striped">' +
                                    '<tbody>' +
                                        '<tr>' +
                                            '<th scope="row"><b>Nama</b></th>' +
                                            `<td>${response['full_name']}</td>` +
                                        '</tr>' +
                                        '<tr>' +
                                            '<th scope="row"><b>Alamat</b></th>' +
                                            `<td>${response['address']}</td>` +
                                        '</tr>' +
                                        '<tr>' +
                                            '<th scope="row"><b>Nomor Telepon</b></th>' +
                                            `<td>${response['phone']}</td>` +
                                        '</tr>' +
                                        '<tr>' +
                                            '<th scope="row"><b>Email</b></th>' +
                                            `<td>${response['email']}</td>` +
                                        '</tr>' +
                                        '<tr>' +
                                            '<th scope="row"><b>Status Akun</b></th>' +
                                            `<td>${response['status']}</td>` +
                                        '</tr>' +
                                    '</tbody>' +
                                    '</table>' +
                                '</div>' +
                                '<div class="mt-5">' +
                                    '<h4><b>KTP</b></h4>' +
                                    `<a href="<?= base_url()?>/assets/images/imagestore/ktpkk/${response['scan_ktp']}"><img src="/assets/images/imagestore/ktp/${response['scan_ktp']}" alt="ktp" width="300"></a>` +
                                    '<h4><b>KK</b></h4>' +
                                    `<a href="<?= base_url()?>/assets/images/imagestore/ktpkk/${response['scan_kk']}"><img src="/assets/images/imagestore/kk/${response['scan_kk']}" alt="kk" width="300"></a>` +
                                '</div>' +
                            '</div>'
                        );
                    }
                });
            });
        }
        getData()
    </script>

    <!-- Suspend User -->
    <script>
        const userSuspend = (id) => {
            var suspendAsk = confirm('Apakah anda yakin untuk menonaktifkan status user ini nya?')
            if(suspendAsk){
                $(document).ready(function () {
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url().'/AdminController/userSuspend'?>",
                        data: "userId=" + id,
                        dataType: "json",
                        success: function (response) {
                            tutupModal()
                            getData()
                        }
                    });
                });
            }
        }
    </script>

    <!-- Mengaktifkan kembali user -->
    <script>
        const userReactive = (id) => {
            var suspendAsk = confirm('Apakah anda yakin untuk mengaktifkan status user ini?')
            if(suspendAsk){
                $(document).ready(function () {
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url().'/AdminController/userReactive'?>",
                        data: "userId=" + id,
                        dataType: "json",
                        success: function (response) {
                            tutupModal()
                            getData()
                        }
                    });
                });
            }
        }
    </script>

    <!-- Seraching-->
    <script>
        const userSearch = () => {
            $(document).ready(function () {
                var searchKey = $("#user-search").val();
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url().'/AdminController/userSearch'?>",
                    data: "key=" + searchKey,
                    dataType: "json",
                    success: function (response) {
                        var renderHtml = [];
                        var number = 1;
                        response.map(
                            dataRow => {
                                var statusCondition = "";
                                if(dataRow['status'] === "Aktif"){
                                    statusCondition = "btn btn-success"
                                }
                                else{
                                    statusCondition = "btn btn-danger"
                                }
                                renderHtml.push(
                                    '<tr class="align-middle">' +
                                        '<th scope="row">'+ number++ +'</th>' +
                                       ' <td class="user-img display-md"><img src="/assets/images/imagestore/profilepicture/'+dataRow['profile_picture']+'" alt="Gambar" ></td>' +
                                        '<td class="user-fullname">'+dataRow['full_name']+'</td>' +
                                        '<td class="user-address display-md-none">'+dataRow['address']+'</td>' +
                                        '<td class="user-phone display-sm-none">'+dataRow['phone']+'</td>' +
                                        '<td class="user-email display-sm-none">'+dataRow['email']+'</td>' +
                                        '<td class="user-level display-sm-none">'+dataRow['user_level']+'</td>' +
                                        `<td class="user-level text-center display-sm-none"><div class="${statusCondition}">`+dataRow['status']+'</div></td>' +
                                        '<td>' +
                                            '<a href="#" class="btn btn-success main-bg" onclick="detailUser('
                                            +'\''+dataRow['userId']+'\''+ ',' +
                                            '\''+dataRow['status']+'\''+')">Detail</a>' +
                                        '</td>' +
                                    '</tr>'
                                )
                            }
                        )
                        $("tbody").html(renderHtml);
                    }
                });
            });
        }
    </script>
    
</div>
<?= $this->endSection() ?>

