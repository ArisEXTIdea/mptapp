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
                        <h3>Transaksi KPR</h3>
                    </div>
                </div>
                <!-- Users Tabele -->
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <a href="#" class="btn btn-success" onclick="downloadAsExcel()">
                                    <i class="fas fa-file-excel"></i>
                                    Download
                                </a>
                            </div>
                            <div>
                                <form class="d-flex" action="/admincontroller/cariKprData" method="get">
                                    <div class="form-group mx-2">
                                        <input type="text" class="form-control" placeholder="Cari nama pembeli disini" id="seacrh" name="searchKey">
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
                                    <th scope="col" class="user-img">Order Id</th>
                                    <th scope="col" class="user-fullname text-center">Nama Produk</th>
                                    <th scope="col" class="user-address text-center display-md-none">Pemesan</th>
                                    <th scope="col" class="user-phone text-center display-sm-none">Tanggal</th>
                                    <th scope="col" class="text-center">Status Bank</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $number=1;?>
                                <?php foreach($data as $d):?>
                                    <tr>
                                        <td><?= $number++ ?></td>
                                        <td><?= $d['id_pesanan'] ?></td>
                                        <td><?= $d['judul_p'] ?></td>
                                        <td class="display-md-none"><?= $d['full_name'] ?></td>
                                        <td class="display-sm-none"><?= $d['order_date'] ?></td>
                                        <td><?= $d['status_bank'] ?></td>
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
        var data = []
        const downloadData = () => {
            $(document).ready(function () {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url().'/AdminController/getPesananKprDatatoDownload'?>",
                    dataType: "json",
                    success: function (response) {
                        response.forEach(element => {
                            data.push(element)
                        });
                    }
                });
            });
        }

        const EXCEL_TYPE = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=UTF-8';
        const EXCEL_EXTENSION = '.xlsx';

        const downloadAsExcel = () => {
            alert('Perhatian! data yang didownload adalah keseluruhan data di semua tahun termasuk data pesanan yang belum diseteujui. Harap untuk mengedit kembali file yang telah didownload untuk kemudian digunakan')

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
            saveAs(data, 'KPR' + fileName+'_export_'+new Date().getTime()+EXCEL_EXTENSION)
        }

        downloadData()
    </script>
</div>
<?= $this->endSection() ?>

