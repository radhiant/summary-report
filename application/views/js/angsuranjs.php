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

<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.bootstrap4.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.colVis.min.js"></script>

<?php if($this->session->flashdata('Pesan')): ?>
<!-- doing this-->
<?= $this->session->flashdata('Pesan') ?>
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

    var level = $('#level').val();

    if(level == '3'){
        $('#bank').hide();
    }else{
        $('#vendor').hide();
    }

    //datatables
    table = $('#table-1').DataTable({

        "processing": true,
        "serverSide": true,
        "order": [],
        "info": false,
        "lengthMenu": [
            [5, 10, 25, 50, 100],
            [5, 10, 25, 50, 100]
        ],
        "pageLength": 10,

        dom: 'Bfrtip',

        buttons: [{
                extend: 'pageLength',
                className: 'btn-info ml-2',
                titleAttr: 'Page Length',

            }, {
                extend: 'copyHtml5',
                className: 'btn-primary ml-2',
                text: '<i class="far fa-copy"></i> Copy',
                titleAttr: 'Copy',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csvHtml5',
                className: 'btn-success ml-2',
                text: '<i class="fas fa-file-csv"></i> CSV',
                titleAttr: 'CSV',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                className: 'btn-danger ml-2',
                text: '<i class="far fa-file-pdf"></i> PDF',
                titleAttr: 'PDF',
                customize: function(doc) {
                    doc.styles.tableHeader.alignment = 'left';
                    doc.content[1].table.widths =
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                },
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excelHtml5',
                className: 'btn-success ml-2',
                text: '<i class="far fa-file-excel"></i> Excel',
                titleAttr: 'Excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                className: 'btn-primary ml-2',
                text: '<i class="fas fa-print"></i> Print',
                titleAttr: 'Print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                text: '<i class="fas fa-trash"></i> Hapus Semua',
                className: 'btn-danger ml-2',
                titleAttr: 'Hapus Semua',
                action: function ( e, dt, node, config ) {
                    hapusBank();
                }
            },
            {
                extend: 'colvis',
                className: 'btn-info ml-2 d-inline',
                text: 'Hide Column',
                titleAttr: 'Hide',
            },


        ],

        "ajax": {
            "url": "<?php echo site_url('angsuran/getDataAngsuranBank')?>",
            "type": "POST"
        },


        "columnDefs": [{
                "targets": [7],
                "orderable": false,
            },
            {
                "targets": [5],
                "visible": false
            },
            {
                "targets": [6],
                "visible": false
            }

        ],

    });

    //datatables
    table1 = $('#table-2').DataTable({

        "processing": true,
        "serverSide": true,
        "order": [],
        "info": false,
        "lengthMenu": [
            [5, 10, 25, 50, 100],
            [5, 10, 25, 50, 100]
        ],
        "pageLength": 10,

        dom: 'Bfrtip',

        buttons: [{
                extend: 'pageLength',
                className: 'btn-info ml-2',
                titleAttr: 'Page Length',

            }, {
                extend: 'copyHtml5',
                className: 'btn-primary ml-2',
                text: '<i class="far fa-copy"></i> Copy',
                titleAttr: 'Copy',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csvHtml5',
                className: 'btn-success ml-2',
                text: '<i class="fas fa-file-csv"></i> CSV',
                titleAttr: 'CSV',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                className: 'btn-danger ml-2',
                text: '<i class="far fa-file-pdf"></i> PDF',
                titleAttr: 'PDF',
                customize: function(doc) {
                    doc.styles.tableHeader.alignment = 'left';
                    doc.content[1].table.widths =
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                },
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excelHtml5',
                className: 'btn-success ml-2',
                text: '<i class="far fa-file-excel"></i> Excel',
                titleAttr: 'Excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                className: 'btn-primary ml-2',
                text: '<i class="fas fa-print"></i> Print',
                titleAttr: 'Print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                text: '<i class="fas fa-trash"></i> Hapus Semua',
                className: 'btn-danger ml-2',
                titleAttr: 'Hapus Semua',
                action: function ( e, dt, node, config ) {
                    hapusVendor();
                }
            },
            {
                extend: 'colvis',
                className: 'btn-info ml-2 d-inline',
                text: 'Hide Column',
                titleAttr: 'Hide',
            },


        ],

        "ajax": {
            "url": "<?php echo site_url('angsuran/getDataAngsuranVendor')?>",
            "type": "POST"
        },


        "columnDefs": [{
                "targets": [7],
                "orderable": false,
            },
            {
                "targets": [5],
                "visible": false
            },
            {
                "targets": [6],
                "visible": false
            }

        ],

    });

});





$('.chosen').chosen({});

function tabBank(){
    $("#btnBank").removeClass();
    $("#btnBank").addClass("btn btn-lg btn-primary");

    $("#btnVendor").removeClass();
    $("#btnVendor").addClass("btn btn-lg btn-outline-primary");

    $("#bank").fadeIn();
    $("#vendor").hide();

    table.ajax.reload();
}


function tabVendor(){
    $("#btnBank").removeClass();
    $("#btnBank").addClass("btn btn-lg btn-outline-primary");

    $("#btnVendor").removeClass();
    $("#btnVendor").addClass("btn btn-lg btn-primary");

    $("#bank").hide();
    $("#vendor").fadeIn();

    table1.ajax.reload();
}


function pesan(judul, status) {
    swal.fire({
        title: judul,
        icon: status,
        confirmButtonColor: '#6777ef',
    });
}

var np = document.getElementById('np');
np.addEventListener('keyup', function(e) {
    np.value = formatRupiah(this.value, '');
});

var nb = document.getElementById('nb');
nb.addEventListener('keyup', function(e) {
    nb.value = formatRupiah(this.value, '');
});

function getCicilan() {
    var link = $('#baseurl').val();
    var base_url = link + 'angsuran/getCicilan';

    var idH = $('#idH').val();
    $('#np').val('Memuat...');

    if (idH == '') {
        $('#np').val('');
    }

    $.ajax({
        type: 'POST',
        data: 'id=' + idH,
        url: base_url,
        dataType: 'json',
        success: function(hasil) {
            $('#np').val(formatRupiah(hasil[0].hutang_cicilan, ''));
        }
    });
}

function getNotagihan() {
    var link = $('#baseurl').val();
    var base_url = link + 'angsuran/getNotagihan';

    var idH = $('#idH').val();
    $('#noT').val('Memuat...');
    $('#np').val('Memuat...');

    if (idH == '') {
        $('#noT').val('');
        $('#np').val('');
    }

    $.ajax({
        type: 'POST',
        data: 'id=' + idH,
        url: base_url,
        dataType: 'json',
        success: function(hasil) {
            $('#noT').val(hasil[0].hutang_no_tagihan);
            $('#np').val(formatRupiah(hasil[0].hutang_nilai, ''));
        }
    });
}


function konfirmasi(id) {
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
            window.location.href = base_url + "angsuran/proses_hapus/" + id;
        }
    });

}

function hapusBank() {
    var base_url = $('#baseurl').val();

    swal.fire({
        title: "Yakin hapus semua?",
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
            window.location.href = base_url + "angsuran/hapus_all/bank";
        }
    });

}

function hapusVendor() {
    var base_url = $('#baseurl').val();

    swal.fire({
        title: "Yakin hapus semua?",
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
            window.location.href = base_url + "angsuran/hapus_all/vendor";
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


function validateBank() {
    var idH = document.forms["myForm"]["idH"].value;
    var periode = document.forms["myForm"]["periode"].value;
    var np = document.forms["myForm"]["np"].value;
    var tgl = document.forms["myForm"]["tgl"].value;

    if (idH == '') {
        validasi('Pilih Bank / Leasing!', 'warning');
        return false;
    } else if (periode == '') {
        validasi('Pilih Periode!', 'warning');
        return false;
    } else if (np == '') {
        validasi('Nilai Pembiayaan wajib di isi!', 'warning');
        return false;
    } else if (tgl == '') {
        validasi('Tanggal wajib di isi!', 'warning');
        return false;
    }

}

function validateVendor() {
    var idH = document.forms["myForm"]["idH"].value;
    var noT = document.forms["myForm"]["noT"].value;
    var np = document.forms["myForm"]["np"].value;
    var tgl = document.forms["myForm"]["tgl"].value;

    if (idH == '') {
        validasi('Pilih Vendor!', 'warning');
        return false;
    } else if (noT == '') {
        validasi('No Tagihan wajib di isi!', 'warning');
        return false;
    } else if (np == '') {
        validasi('Nilai Pembiayaan wajib di isi!', 'warning');
        return false;
    } else if (tgl == '') {
        validasi('Tanggal wajib di isi!', 'warning');
        return false;
    }

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
</script>