$(document).ready(function () {
    $("#form-save-btn").click(function (e) { 
        e.preventDefault();
        $("#aleart").addClass("d-none");
        $("#form-kategori-bank").attr("action", "/admincontroller/postBank");
        $("#id_bank").attr("value", '');
        $("#nama_bank").attr("value", '');
        $("#nama_penerima").text('');
        $("#nomor_pembayaran").attr("value", '');
    });

    $(".edit-kategori-perumahan-btn").click(function (e) { 
        e.preventDefault();
        $("#form-kategori-bank").attr("action", "/admincontroller/putBank");
    });
    
    
});