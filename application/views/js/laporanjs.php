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
var table;

$(document).ready(function() {

    getPendapatan();

    //datatables
    table = $('#tableP').DataTable({

        "lengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "Semua "]
        ],
        "pageLength": 25,
        "ordering": false,
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "searching": false,

    });

    //datatables
    table1 = $('#tablepp').DataTable({

        "ordering": false,
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "searching": false,

    });


});

function getPendapatan() {
    $("#pendapatan").addClass("card-progress");
    $("#pembiayaan").addClass("card-progress");

    var link = $('#baseurl').val();
    var base_url = link + 'laporan/getPendapatan';
    var bulan = $('#bln').val();
    var tahun = $('#thn').val();

    $.ajax({
        type: 'POST',
        url: base_url,
        data: {
            bulan: bulan,
            tahun: tahun
        },
        dataType: 'json',
        success: function(hasil) {
            var pemerintahan = parseInt(hasil.pemerintahanSewa) + parseInt(hasil.pemerintahanJual) + parseInt(hasil.pemerintahanLain);
            var swasta = parseInt(hasil.swastaSewa) + parseInt(hasil.swastaJual) + parseInt(hasil
                .swastaRepair) + parseInt(hasil.swastaLain);
            var totalPendapatan = pemerintahan + swasta;


            $('#pSewa').text('Rp ' + formatRupiah(hasil.pemerintahanSewa, ''));
            $('#pJual').text('Rp ' + formatRupiah(hasil.pemerintahanJual, ''));
            $('#pLain').text('Rp ' + formatRupiah(hasil.pemerintahanLain, ''));
            $('#sSewa').text('Rp ' + formatRupiah(hasil.swastaSewa, ''));
            $('#sJual').text('Rp ' + formatRupiah(hasil.swastaJual, ''));
            $('#sRepair').text('Rp ' + formatRupiah(hasil.swastaRepair, ''));
            $('#sLain').text('Rp ' + formatRupiah(hasil.swastaLain, ''));

            $('#totalP').text('Rp ' + formatRupiah(String(pemerintahan), ''));
            $('#totalS').text('Rp ' + formatRupiah(String(swasta), ''));

            $('#totalK').text('Rp ' + formatRupiah(String(totalPendapatan), ''));

            $("#pendapatan").removeClass("card-progress");

            getPembiayaan(totalPendapatan);
        }
    });
}

function getPembiayaan(pendapatan) {

    var link = $('#baseurl').val();
    var base_url = link + 'laporan/getPembiayaan';
    var bulan = $('#bln').val();
    var tahun = $('#thn').val();

    $.ajax({
        type: 'POST',
        url: base_url,
        data: {
            bulan: bulan,
            tahun: tahun
        },
        dataType: 'json',
        success: function(hasil) {
            var pemerintahan = parseInt(hasil.pemerintahanSewa) + parseInt(hasil.pemerintahanJual) + parseInt(hasil.pemerintahanLain);
            var swasta = parseInt(hasil.swastaSewa) + parseInt(hasil.swastaJual) + parseInt(hasil
                .swastaRepair) + parseInt(hasil.swastaLain);
            var totalPendapatan = pemerintahan + swasta;


            $('#ppSewa').text('Rp ' + formatRupiah(hasil.pemerintahanSewa, ''));
            $('#ppJual').text('Rp ' + formatRupiah(hasil.pemerintahanJual, ''));
            $('#ppLain').text('Rp ' + formatRupiah(hasil.pemerintahanLain, ''));
            $('#ssSewa').text('Rp ' + formatRupiah(hasil.swastaSewa, ''));
            $('#ssJual').text('Rp ' + formatRupiah(hasil.swastaJual, ''));
            $('#ssRepair').text('Rp ' + formatRupiah(hasil.swastaRepair, ''));
            $('#ssLain').text('Rp ' + formatRupiah(hasil.swastaLain, ''));

            $('#totalPP').text('Rp ' + formatRupiah(String(pemerintahan), ''));
            $('#totalSS').text('Rp ' + formatRupiah(String(swasta), ''));

            $('#totalKK').text('Rp ' + formatRupiah(String(totalPendapatan), ''));

            getMargin(pendapatan, totalPendapatan);

            $("#pembiayaan").removeClass("card-progress");
        }
    });
}

function getMargin(pendapatan, pembiayaan) {
    var total = parseInt(pendapatan) - parseInt(pembiayaan);
    if (total < 0) {
        $('#totalKabeh').text('Rp -' + formatRupiah(String(total), ''));
    } else {
        $('#totalKabeh').text('Rp ' + formatRupiah(String(total), ''));
    }

}

function filter() {
    var base_url = $('#baseurl').val();
    if ($('#bln').val() == '') {
        var bulan = 'Semua';
    } else {
        var bulan = $('#bln').val();
    }
    var tahun = $('#thn').val();
    lodingklik();
    window.location.href = base_url + "Laporan/index2/" + bulan + "/" + tahun;
};

function filterni() {
    var base_url = $('#baseurl').val();
    if ($('#bln').val() == '') {
        var bulan = 'Semua';
    } else {
        var bulan = $('#bln').val();
    }
    var tahun = $('#thn').val();
    lodingklik();
    window.location.href = base_url + "Laporan/noninvest/" + bulan + "/" + tahun;
};

function lihatDetail() {
    var base_url = $('#baseurl').val();
    var idp = $('#idP').val();
    if (idp == '') {
        pesan('Pilih Project!', 'warning');
    } else {
        if ($('#bln').val() == '') {
            var bulan = 'Semua';
        } else {
            var bulan = $('#bln').val();
        }
        var tahun = $('#thn').val();
        lodingklik();
        window.location.href = base_url + "Laporan/detailProject/" + idp + "/" + bulan + "/" + tahun;
    }

};

function printprojek() {
    var base_url = $('#baseurl').val();
    if ($('#bln').val() == '') {
        var bulan = 'Semua';
    } else {
        var bulan = $('#bln').val();
    }
    var tahun = $('#thn').val();
    //lodingklik();
    //window.location.href = base_url + "Laporan/index2print/"+bulan+"/"+tahun;
    window.open(base_url + "Laporan/index2print/" + bulan + "/" + tahun);
}

function printprojekni() {
    var base_url = $('#baseurl').val();
    if ($('#bln').val() == '') {
        var bulan = 'Semua';
    } else {
        var bulan = $('#bln').val();
    }
    var tahun = $('#thn').val();
    //lodingklik();
    //window.location.href = base_url + "Laporan/index2print/"+bulan+"/"+tahun;
    window.open(base_url + "Laporan/noinvestprint/" + bulan + "/" + tahun);
}


function printdp() {
    var base_url = $('#baseurl').val();
    var idp = $('#idP').val();
    if (idp == '') {
        pesan('Pilih Project!', 'warning');
    } else {
        if ($('#bln').val() == '') {
            var bulan = 'Semua';
        } else {
            var bulan = $('#bln').val();
        }
        var tahun = $('#thn').val();
        window.open(base_url + "Laporan/detailProjectPrint/" + idp + "/" + bulan + "/" + tahun);
    }
}


function printHutang() {
    var base_url = $('#baseurl').val();
 
        if ($('#bln').val() == '') {
            var bulan = 'Semua';
        } else {
            var bulan = $('#bln').val();
        }
        var tahun = $('#thn').val();
        window.open(base_url + "hutang/laporanPrint/" + bulan + "/" + tahun);
}

function printInvestP() {
    var base_url = $('#baseurl').val();
 
        // if ($('#bln').val() == '') {
        //     var bulan = 'Semua';
        // } else {
        //     var bulan = $('#bln').val();
        // }
        // var tahun = $('#thn').val();
        window.open(base_url + "laporan/investPprint");
}

function jan() {
    resetOptBulan();
    $('#bulan').text('Januari');
    $('#bln').val('January');
    $('#jan').addClass("active");
    getPendapatan();
}

function feb() {
    resetOptBulan();
    $('#bulan').text('Februari');
    $('#bln').val('February');
    $('#feb').addClass("active");
    getPendapatan();
}

function mart() {
    resetOptBulan();
    $('#bulan').text('Maret');
    $('#bln').val('March');
    $('#mart').addClass("active");
    getPendapatan();
}

function apr() {
    resetOptBulan();
    $('#bulan').text('April');
    $('#bln').val('April');
    $('#apr').addClass("active");
    getPendapatan();
}

function may() {
    resetOptBulan();
    $('#bulan').text('Mei');
    $('#bln').val('May');
    $('#may').addClass("active");
    getPendapatan();
}

function jun() {
    resetOptBulan();
    $('#bulan').text('Juni');
    $('#bln').val('June');
    $('#jun').addClass("active");
    getPendapatan();
}

function jul() {
    resetOptBulan();
    $('#bulan').text('Juli');
    $('#bln').val('July');
    $('#jul').addClass("active");
    getPendapatan();
}

function agus() {
    resetOptBulan();
    $('#bulan').text('Agustus');
    $('#bln').val('August');
    $('#agus').addClass("active");
    getPendapatan();
}

function sep() {
    resetOptBulan();
    $('#bulan').text('September');
    $('#bln').val('September');
    $('#sep').addClass("active");
    getPendapatan();
}

function oct() {
    resetOptBulan();
    $('#bulan').text('Oktober');
    $('#bln').val('October');
    $('#oct').addClass("active");
    getPendapatan();
}

function nov() {
    resetOptBulan();
    $('#bulan').text('November');
    $('#bln').val('November');
    $('#nov').addClass("active");
    getPendapatan();
}

function dec() {
    resetOptBulan();
    $('#bulan').text('Desember');
    $('#bln').val('December');
    $('#dec').addClass("active");
    getPendapatan();
}

function tya(tahun) {
    resetOptTahun();
    $("#tahun").html(tahun);
    $('#thn').val(tahun);
    $('#tya').addClass("active");
    getPendapatan();
}

function py(tahun) {
    resetOptTahun();
    $("#tahun").html(tahun);
    $('#thn').val(tahun);
    $('#py').addClass("active");
    getPendapatan();
}

function yn(tahun) {
    resetOptTahun();
    $("#tahun").html(tahun);
    $('#thn').val(tahun);
    $('#yn').addClass("active");
    getPendapatan();
}

function reset() {
    resetOptBulan();
    $('#bulan').text('Pilih Bulan');
    getPendapatan();
}

function resetOptBulan() {
    $("#jan").removeClass("active");
    $("#feb").removeClass("active");
    $("#mart").removeClass("active");
    $("#apr").removeClass("active");
    $("#may").removeClass("active");
    $("#jun").removeClass("active");
    $("#jul").removeClass("active");
    $("#agus").removeClass("active");
    $("#sep").removeClass("active");
    $("#oct").removeClass("active");
    $("#nov").removeClass("active");
    $("#dec").removeClass("active");
    $('#bln').val('');
}

function resetOptTahun() {
    $("#tya").removeClass("active");
    $("#py").removeClass("active");
    $("#yn").removeClass("active");
    $('#thn').val('');
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


function validasi(judul, status) {
    swal.fire({
        title: judul,
        icon: status,
        confirmButtonColor: '#4e73df',
    });
}

$('.chosen').chosen({});
</script>