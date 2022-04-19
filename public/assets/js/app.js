$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function download_file(value, location) {
    window.location =
        "/download_file?nama_file=" + value + "&&lokasi=" + location;
}

function validasi_file() {
    var inputFile = document.getElementById("file");
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.jpg|\.jpeg|\.png)$/i;
    if (!ekstensiOk.exec(pathFile)) {
        alert("Silakan upload file dengan ekstensi .jpeg/.jpg/.png");
        inputFile.value = "";
        return false;
    }
}

function check_merk(value) {
    if (value == "") {
        $("#nama_merk").removeClass("is-valid");
        $("#nama_merk").removeClass("is-invalid");
        $("#ada_merk").css("display", "none");
        $("#belum_merk").css("display", "none");
        document.getElementById("btn_merk").disabled = true;
    } else {
        $.ajax({
            url: "check_merk",
            type: "post",
            data: {
                id: value,
            },
            success: function (response) {
                if (response > "0") {
                    $("#nama_merk").addClass("is-invalid");
                    $("#nama_merk").removeClass("is-valid");
                    $("#ada_merk").css("display", "block");
                    $("#belum_merk").css("display", "none");
                    document.getElementById("btn_merk").disabled = true;
                } else {
                    $("#nama_merk").addClass("is-valid");
                    $("#nama_merk").removeClass("is-invalid");
                    $("#ada_merk").css("display", "none");
                    $("#belum_merk").css("display", "block");
                    document.getElementById("btn_merk").disabled = false;
                }
            },
        });
    }
}
function cari_session() {
    let ctgl1 = $("#ctgl1").val();
    let ctgl2 = $("#ctgl2").val();
    let cgroup = $("#cgroup").val();

    $.ajax({
        url: "data_session",
        type: "post",
        data: {
            ctgl1: ctgl1,
            ctgl2: ctgl2,
            cgroup: cgroup,
        },
        success: function (result) {
            $("#data_session").html(result);
        },
    });
}

function data_session() {
    $.ajax({
        url: "data_session",
        type: "post",
        data: {
            ctgl1: "",
            ctgl2: "",
            cgroup: "",
        },
        success: function (result) {
            $("#data_session").html(result);
        },
    });
}

function date(value) {
    alert(value);
    $(".datepicker").daterangepicker({
        locale: {
            format: "DD-MM-YYYY",
        },
        startDate: value,
        singleDatePicker: true,
    });
}

function show_temp() {
    $.ajax({
        url: "show_temp",
        type: "post",
        success: function (result) {
            $(".data_temp").html(result);
        },
    });
}

function hitung_kembalian(value) {
    let kembalian = $("#total").val() - value;
    var reverse_kembalian = kembalian.toString().split("").reverse().join(""),
        ribuan_kembalian = reverse_kembalian.match(/\d{1,3}/g);
    ribuan_kembalian = ribuan_kembalian.join(".").split("").reverse().join("");
    document.getElementById("kembalian2").value = 'Rp. '+ribuan_kembalian;
    document.getElementById("kembalian").value = kembalian;
}

function transaksi ()
{

    let bayar       = $("#bayar").val();
    let total       = $("#total").val();
    let kembalian   = $("#kembalian").val();
    let id_penjualan   = $("#id_penjualan").val();

    if (parseInt(bayar) < parseInt(total) || bayar == '') {

        alert("Pembayaran masih kurang.");
        $("#bayar").focus();

    } else {

        $.ajax({

            url : "save_transaksi",
            data: {
                bayar:bayar,
                total:total,
                kembalian:kembalian,
                id_penjualan:id_penjualan
            },
            type:'post',
            success:function(){
                window.location.reload();
            }

        })

    }

}

function detail_laporan (value)
{


    $.ajax({

        url : 'detail_lap',
        data: {
            id:value
        },
        type: 'post',
        success:function(result) {
            $("#DetailLap").modal("show");
            $(".title_transaksi").html(value);
            $(".data_detail_lap").html(result);
        }

    })

}
$(function () {
    data_session();
    show_temp();

    // todo default datatable
    $("#table_id").DataTable({
        scrollX: true,
    });
    // todo datepicker
    // todo plugin select2
    $(".select2").select2();
    $(".select3").select2();
    $(".select4").select2();
    $(".datepicker").daterangepicker({
        locale : {
            format: 'DD-MM-YYYY',
        },
        startDate: new Date,
        singleDatePicker: true,
    });
    // todo edit merk
    $.fn.editable.defaults.mode = "inline";
    $("#data_merk").editable({
        container: "tbody",
        selector: "td.nama_merk",
        url: "update_merk",
        title: "Edit Merk",
        type: "POST",
        dataType: "json",
        validate: function (value) {
            if ($.trim(value) == "") {
                return "This field is required";
            }
        },
        success: function () {
            window.location.reload();
        },
    });
});
