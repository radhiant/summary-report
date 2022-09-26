<!-- modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dibayarkan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>pendapatan/proses_ubah_bayar" name="myForm" method="POST"
                    onsubmit="return validateFormBayar()">
                    <div class="form-group">

                        <input type="hidden" class="form-control" name="idP" id="idP" readonly>

                    <div class="form-group">
                        <label for="">Tanggal Dibayar</label>
                        <input type="text" class="form-control datepicker" name="tglB" id="tglB" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="">Dibayarkan</label>
                        <input type="text" class="form-control" name="bayarr" id="bayarr">
                    </div>


            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="reset()">Batal <i
                        class="fas fa-times-circle"></i></button>
                <button type="submit" class="btn btn-primary" onclick="lodingklik()">Simpan <i
                        class="fas fa-check-circle"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

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

    //datatables
    table = $('#table-1').DataTable({

        "processing": true,
        "serverSide": true,
        "order": [],
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
                    hapusAll();
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
            "url": "<?php echo site_url('pendapatan/getDataPendapatan')?>",
            "type": "POST"
        },


        "columnDefs": [{
                "targets": [10],
                "orderable": false,
            },
            {
                "targets": [4],
                "visible": false
            },
            {
                "targets": [7],
                "visible": false
            },
            {
                // "targets": [9],
                // "visible": true
            }

        ],

    });

});



$('.chosen').chosen({});
$('.datepicker1').datepicker({});


function pesan(judul, status) {
    swal.fire({
        title: judul,
        icon: status,
        confirmButtonColor: '#6777ef',
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
            window.location.href = base_url + "pendapatan/proses_hapus/" + id;
        }
    });

}

function hapusAll() {
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
            window.location.href = base_url + "pendapatan/hapus_all";
        }
    });

}

function bayarkan(id, nilai){
    $("#bayarr").val(formatRupiah(nilai));
    $("#idP").val(id);
}

function reset() {
    $('#idP').val('');
    $('#tglB').val('');
    $('#bayarr').val('');
};

var nilai = document.getElementById('nilai');
nilai.addEventListener('keyup', function(e) {
    nilai.value = formatRupiah(this.value, '');
});

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

function validateFormBayar() {

var tglB = document.forms["myForm"]["tglB"].value;
var bayarr = document.forms["myForm"]["bayarr"].value;

if (tglB == "") {
    validasi('Tgl Bayar wajib di isi!', 'warning');
    return false;
} else if (bayarr == '') {
    validasi('Dibayarkan wajib di isi!', 'warning');
    return false;
}

}


function validateForm() {
    var idP = document.forms["myForm"]["idP"].value;
    var periode = document.forms["myForm"]["periode"].value;
    var tglP = document.forms["myForm"]["tglP"].value;
    var tglT = document.forms["myForm"]["tglT"].value;
    var jmlT = document.forms["myForm"]["jmlT"].value;
    var ket = document.forms["myForm"]["ket"].value;
    var tglB = document.forms["myForm"]["tglB"].value;

    if (idC == '') {
        validasi('Pilih Customer!', 'warning');
        return false;
    } else if (periode == '') {
        validasi('Pilih Periode!', 'warning');
        return false;
    } else if (tglP == '') {
        validasi('Tanggal Penagihan wajib di isi!', 'warning');
        return false;
    } else if (tglT == '') {
        validasi('Tanggal Tempo wajib di isi!', 'warning');
        return false;
    } else if (jmlB == '') {
        validasi('Tanggal Bayar wajib di isi!', 'warning');
        return false;
    }

}

function getNilaiKontrak() {
    var link = $('#baseurl').val();
    var base_url = link + 'pendapatan/getNilaiKontrak';

    var idP = $('#idP').val();

    if(idP == ''){
        $('#nilai').val('');
    }

    $.ajax({
        type: 'POST',
        data: 'id=' + idP,
        url: base_url,
        dataType: 'json',
        success: function(hasil) {
            $('#nilai').val(formatRupiah(hasil[0].project_kontrak_nilai), '');
        }
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
</script>