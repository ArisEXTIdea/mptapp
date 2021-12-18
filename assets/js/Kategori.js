

// Modal Tambah Kategori

$(document).ready(function () {
    $("#form-save-btn").click(function (e) { 
       console.log("a")
       $("#modal-btn").attr("onclick", "saveKategori()");
       $("#mymodal-title").text("Tambah Kegiatan");
    });
});



const editModalShow = (data) => {
    $(document).ready(function () {
        openModal()
        $("#modal-btn").attr("onclick", "editKategori()");
        $("#mymodal-title").text("Edit Kegiatan");
        $("#id-kategori-form").attr("value", data['id_kategori']);
        $("#nama-kategori-form").attr("value", data['nama_kategori']);
        $("#deskripsi-kategori-form").attr("value", data['deskripsi']);
    });
}
