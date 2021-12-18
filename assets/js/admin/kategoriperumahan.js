$(document).ready(function () {
    $("#form-save-btn").click(function (e) { 
        e.preventDefault();
        $("#aleart").addClass("d-none");
        $("#form-kategori-perumahan").attr("action", "/admincontroller/postPerumahan");
        $("#id_perumahan").attr("value", '');
        $("#nama_perumahan").attr("value", '');
        $("#keterangan_perumahan").text('');
        $("#lokasi_perumahan").attr("value", '');
    });

    $(".edit-kategori-perumahan-btn").click(function (e) { 
        e.preventDefault();
        $("#form-kategori-perumahan").attr("action", "/admincontroller/putPerumahan");
    });
    
    
});