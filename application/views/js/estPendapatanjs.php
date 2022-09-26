<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="<?= base_url(); ?>assets/stisla/assets/js/stisla.js"></script>

<script src="<?= base_url(); ?>assets/plugin/sweetalert2/dist/sweetalert2.all.min.js"></script>

<!-- JS Libraies -->
<script src="<?= base_url(); ?>assets/stisla/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js">
</script>

<script src="<?= base_url(); ?>assets/plugin/datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url(); ?>assets/plugin/bdaterangepicker/daterangepicker.js"></script>
<script src="<?= base_url(); ?>assets/plugin/chosen/chosen.jquery.min.js"></script>

<!-- JS Libraies -->
<script src="<?= base_url(); ?>assets/stisla/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="<?= base_url(); ?>assets/stisla/node_modules/chart.js/dist/Chart.min.js"></script>
<script src="<?= base_url(); ?>assets/stisla/node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
<script src="<?= base_url(); ?>assets/stisla/node_modules/summernote/dist/summernote-bs4.js"></script>
<script src="<?= base_url(); ?>assets/stisla/node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

<!-- <script src="<?= base_url(); ?>assets/stisla/assets/js/page/index.js"></script> -->

<?php if($this->session->flashdata('Pesan')): ?>
<!-- doing this-->
<?= $this->session->flashdata('Pesan') ?>
<?php elseif($judul == 'Print Laporan'): ?>

<?php else: ?>
<script>
$(document).ready(function() {
    let timerInterval
    Swal.fire({
        title: 'Memuat...',
        timer: 1000,
        onBeforeOpen: () => {
            Swal.showLoading()
        },
        onClose: () => {
            clearInterval(timerInterval)
        }
    }).then((result) => {

    })
});
</script>
<?php endif; ?>

<script>
$(document).ready(function() {

    $('#idP').on('change', function() {
        getData();
    });

    $("#btnSubmit").hide();
    $("#loder").hide();

});

function filter() {
    var base_url = $('#baseurl').val();
    var tahun = $('#thn').val();
    lodingklik();
    window.location.href = base_url + "Epp/index/" + tahun;
}

function filterLE() {
    var base_url = $('#baseurl').val();
    var tahun = $('#thn').val();
    var idC = $('#customer').val();
    lodingklik();
    window.location.href = base_url + "Epp/laporan/" + tahun + "/" + idC;
}

function printLE() {
    var base_url = $('#baseurl').val();
    var tahun = $('#thn').val();
    var idC = $('#customer').val();
    window.open(base_url + "Epp/laporanPrint/" + tahun + "/" + idC);
}

function getData() {

    var link = $('#baseurl').val();
    var base_url = link + 'epp/getData';
    var id = $('#idP').val();
    $("#formInput").empty();
    $("#loder").show();

    if (id == '') {
        $("#formInput").append("<div class='col-lg-12'>" +
            "<div class='card'>"+
                "<div class='card-body'>" + "<center><h4 class='mt-4 mb-4'>...</h4></center>" + "</div>"
            +"</div>" +
            "</div>");

        $("#btnSubmit").fadeOut();
    } else {
        
        $.ajax({
            type: 'POST',
            data: 'idP=' + id,
            url: base_url,
            dataType: 'json',
            success: function(hasil) {
                $("#btnSubmit").fadeIn();
               $("#loder").fadeOut();

                for (i = 0; i < hasil.jml_bulan; i++) {
                    no = 1 + i;
                    var dateSrt = new Date(hasil.tgl_awal);
                    dateSrt.setMonth(dateSrt.getMonth() + i);

                    $("#formInput").append(
                        "<div class='col-lg-4'> " +
                        "<div class='card'> " +
                        "<div class='card-header'> <h4>" + formatDate(dateSrt) + "</h4> </div>" +
                        "<div class='card-body'> " +
                        "<label>Nilai Kontrak</label> <input type='text' class='form-control' value='" +
                        formatRupiah(hasil.nilai_kontrak, '') + "' readonly>" +
                        "<input type='hidden' name='bulan[]' class='form-control' value='" +
                        getBulan(dateSrt) + "'>" +
                        "<input type='hidden' name='tahun[]' class='form-control' value='" +
                        getTahun(dateSrt) + "'>" +
                        "<input type='hidden' name='idP[]' class='form-control' value='" +
                        hasil.id_projek + "'>" +
                        " </div>" +
                        " </div>" +
                        " </div>"
                    );
                }


            }
        });

    }


}

function formatDate(orginaldate) {
    var date = new Date(orginaldate);
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    switch (month) {
        case 1:
            month = "Januari";
            break;
        case 2:
            month = "Februari";
            break;
        case 3:
            month = "Maret";
            break;
        case 4:
            month = "April";
            break;
        case 5:
            month = "Mei";
            break;
        case 6:
            month = "Juni";
            break;
        case 7:
            month = "Juli";
            break;
        case 8:
            month = "Agustus";
            break;
        case 9:
            month = "September";
            break;
        case 10:
            month = "Oktober";
            break;
        case 11:
            month = "November";
            break;
        case 12:
            month = "Desember";
            break;

        default:
            month = " ";
            break;

    }

    var date = month + " " + year;
    return date;
};

function getBulan(orginaldate){
    var date = new Date(orginaldate);
    var month = date.getMonth() + 1;

    switch (month) {
        case 1:
            month = "Januari";
            break;
        case 2:
            month = "Februari";
            break;
        case 3:
            month = "Maret";
            break;
        case 4:
            month = "April";
            break;
        case 5:
            month = "Mei";
            break;
        case 6:
            month = "Juni";
            break;
        case 7:
            month = "Juli";
            break;
        case 8:
            month = "Agustus";
            break;
        case 9:
            month = "September";
            break;
        case 10:
            month = "Oktober";
            break;
        case 11:
            month = "November";
            break;
        case 12:
            month = "Desember";
            break;

        default:
            month = " ";
            break;

    }

    var date = month;
    return date;

}

function getTahun(orginaldate){
    var date = new Date(orginaldate);
    var year = date.getFullYear();

    var date = year;
    return date;
}





function tya(tahun) {
    resetOptTahun();
    $("#tahun").html(tahun);
    $('#thn').val(tahun);
    $('#tya').addClass("active");
}

function py(tahun) {
    resetOptTahun();
    $("#tahun").html(tahun);
    $('#thn').val(tahun);
    $('#py').addClass("active");
}

function yn(tahun) {
    resetOptTahun();
    $("#tahun").html(tahun);
    $('#thn').val(tahun);
    $('#yn').addClass("active");
}


function resetOptTahun() {
    $("#tya").removeClass("active");
    $("#py").removeClass("active");
    $("#yn").removeClass("active");
    $('#thn').val('');
}


function konfirmasi(id, tahun) {
    var base_url = $('#baseurl').val();

    swal.fire({
        title: "Hapus Data ini?",
        icon: "warning",
        closeOnClickOutside: false,
        showCancelButton: true,
        confirmButtonText: 'Iya',
        confirmButtonColor: '#6777ef',
        cancelButtonText: 'Batal',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.value) {
            lodingklik();
            window.location.href = base_url + "epp/proses_hapus/" + id + "/" + tahun;
        }
    });

}

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
}


function pesan(judul, status) {
    swal.fire({
        title: judul,
        icon: status,
        confirmButtonColor: '#6777ef',
    });
}




function lodingklik() {
    let timerInterval
    Swal.fire({
        title: 'Memuat...',
        onBeforeOpen: () => {
            Swal.showLoading()
        },
        onClose: () => {}
    }).then((result) => {

    })
};




$('.chosen').chosen({});
</script>