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
            <?php echo view('/theme/Sidemenu')?>
        </div>
        <div class="col-12 col-sm-8 col-md-9 col-lg-10 p-3 content-bg content-container" id='content'>
            <div class="container-fluid p-4 m-0 item-bg">
                <div class="row">
                    <!-- Header Section -->
                    <div class="col-12">
                         <!-- Allert pendaftaran berhasil -->
                    <?php $session = \Config\Services::session();?>
                    <?php if($session->getFlashdata('success')):?>
                    <div class="alert alert-success" role="alert">
                        <?php  echo $session->getFlashdata('success'); ?>
                    </div>
                    <?php endif;?>
                    <!-- --------------------------------- -->
                        <h3>Daftar Produk Perumahan</h3>
                    </div>
                </div>
                <!-- Users Tabele -->
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="/admin/produk-baru" class="btn btn-primary main-bg my-1">Tambah Produk Baru</a>
                                <a href="#" class="btn btn-success" onclick="downloadAsExcel()">
                                    <i class="fas fa-file-excel"></i>
                                    Download
                                </a>
                            </div>
                            <div>
                                <form class="d-flex" action="/admincontroller/ProdukPerumahanCari" method="post">
                                    <div class="form-group mx-2">
                                        <input type="text" class="form-control" placeholder="Cari produk disini" id="user-search" name="cariProduk">
                                    </div>
                                    <div>
                                        <button class="btn btn-primary main-bg">Cari</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table class="table table-striped">
                            <thead class='main-bg'>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col" class="user-img">Judul</th>
                                    <th scope="col" class="user-fullname text-center">Kategori Perumahan</th>
                                    <th scope="col" class="user-address text-center display-md-none">Alamat</th>
                                    <th scope="col" class="user-phone text-center display-sm-none">Harga</th>
                                    <th scope="col" class="user-email text-center display-sm-none" >Harga Diskon</th>
                                    <th scope="col" class="text-center">Kontrol</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $number=1;?>
                                <?php foreach($data as $d):?>
                                    <tr>
                                        <td><?= $number++ ?></td>
                                        <td><?= $d['judul_p'] ?></td>
                                        <td><?= $d['kategori_p'] ?></td>
                                        <td class="display-md-none"><?= $d['alamat'] ?></td>
                                        <td class="display-sm-none"><?= $d['harga_normal'] ?></td>
                                        <td class="display-sm-none"><?= $d['harga_diskon'] ?></td>
                                        <td class="text-center">
                                            <a href="/admin/daftar-produk-detail/<?= implode('-' ,explode(' ',$d['judul_p']))?>" class="btn btn-primary main-bg m-1">Detail</a>
                                            <a href="#" class="btn btn-danger m-1" onclick="deleteProduct('<?= $d['id_produk']?>')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>  
                        <?= $pager->links() ?>  
                    </div>
                </div>
            </div>
        </div>
        <?php echo view('/theme/footer')?>
    </div>

    <!-- Ajax request -->

    <script>
        const deleteProduct = (id) => {
            var conf = confirm('Apakah anda yakin menghapus data ini?')

            $(document).ready(function () {
                if(conf){
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url().'/AdminController/deleteProduk'?>",
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
        var data = []
        const downloadData = () => {
            $(document).ready(function () {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url().'/AdminController/getprodukDatatoDownload'?>",
                    dataType: "json",
                    success: function (response) {
                        response.forEach(element => {
                            data.push(element)
                        });
                    }
                });
            });
        }

        console.log(data)

        const EXCEL_TYPE = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=UTF-8';
        const EXCEL_EXTENSION = '.xlsx';

        const downloadAsExcel = () => {
            const worksheet = XLSX.utils.json_to_sheet(data);
            const workbook = {
                Sheets: {
                    'data': worksheet
                },
                SheetNames: ['data']
            }
            const excelBuffer = XLSX.write(workbook, {
                bookType: 'xlsx',
                type: 'array'
            })
            console.log(excelBuffer)
            saveAsExcel(excelBuffer, 'myFile')
        }

        const saveAsExcel = (buffer, fileName) => {
            const data = new Blob([buffer], {type: EXCEL_TYPE})
            saveAs(data, fileName+'_export_'+new Date().getTime()+EXCEL_EXTENSION)
        }

        downloadData()
    </script>
</div>
<?= $this->endSection() ?>

