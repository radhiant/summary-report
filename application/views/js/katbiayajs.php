<!-- modal tambah -->
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori Biaya</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>katbiaya/proses_tambah" name="myForm" method="POST"
                    onsubmit="return validateForm()">
                    <div class="form-group">
                        <label for="">ID Kategori Biaya</label>
                        <input type="text" class="form-control" name="katbiayaid" value="<?= $genID ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="">Nama Kategori Biaya</label>
                        <input type="text" class="form-control" name="namaK">
                    </div>


            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal <i
                        class="fas fa-times-circle"></i></button>
                <button type="submit" class="btn btn-primary">Simpan <i class="fas fa-check-circle"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal update -->
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModalU">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Kategori Biaya</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>katbiaya/proses_ubah" name="myFormUpdate" method="POST"
                    onsubmit="return validateFormUpdate()">
                    <div class="form-group">
                        <label for="">ID Kategori Biaya</label>
                        <input type="text" class="form-control" name="katbiayaid" id="katbiayaid" readonly>
                    </div>

                    <div class="form-group">
                        <label for="">Nama Kategori Biaya</label>
                        <input type="text" class="form-control" name="namaK" id="namaK">
                    </div>


            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal <i
                        class="fas fa-times-circle"></i></button>
                <button type="submit" class="btn btn-success" id="btnU"> <span id="btnUText">Simpan Perubahan</span> <i
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
<script src="<?= base_url(); ?>/assets/stisla/assets/js/stisla.js"></script>

<script src="<?= base_url(); ?>assets/plugin/sweetalert2/dist/sweetalert2.all.min.js"></script>


<!-- JS Libraies -->
<script src="<?= base_url(); ?>assets/stisla/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js">
</script>

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
            window.location.href = base_url + "katbiaya/proses_hapus/" + id;
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
            window.location.href = base_url + "katbiaya/hapus_all";
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

function ambilData(id) {
    disable();
    var link = $('#baseurl').val();
    var base_url = link + 'katbiaya/getData';

    $.ajax({
        type: 'POST',
        data: 'id=' + id,
        url: base_url,
        dataType: 'json',
        success: function(hasil) {
            $('#katbiayaid').val(hasil[0].katbiaya_id);
            $('#namaK').val(hasil[0].katbiaya_nama);
            enable();
        }
    });
}

var table;
$(document).ready(function() {

    //datatables
    table = $('#table-1').DataTable({
        "lengthMenu": [
            [5, 10, 25, 50, 100],
            [5, 10, 25, 50, 100]
        ],
        "pageLength": 10,

        lengthChange: false,

        dom: 'Bfrtip',

        buttons: [
            {
                extend: 'pageLength',
                className: 'btn-info ml-2',
                titleAttr: 'Page Length',

            },
            {
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

        "columnDefs": [{
                "targets": [0],
                "orderable": false,
            },
            {
                "targets": [3],
                "orderable": false,
            },
        ],

    });

    table.buttons().container()
        .appendTo('#example_wrapper .col-md-6:eq(0)');

});

function validateForm() {
    lodingklik();
    var namaK = document.forms["myForm"]["namaK"].value;

    if (namaK == "") {
        pesan('Nama Kategori wajib di isi!', 'warning');
        return false;
    }

}

function validateFormUpdate() {
    lodingklik();
    var namaK = document.forms["myFormUpdate"]["namaK"].value;

    if (namaK == "") {
        pesan('Nama Kategori wajib di isi!', 'warning');
        return false;
    }
}

function disable() {
    $("#btnUText").html("Memuat..");
    $("#btnU").removeClass("btn-success");
    $("#btnU").addClass("btn-secondary");
    $('#btnU').attr('disabled', 'disabled');

}

function enable() {
    $("#btnUText").html("Simpan Perubahan");
    $("#btnU").removeClass("btn-secondary");
    $("#btnU").addClass("btn-success");
    $('#btnU').removeAttr("disabled");
}
</script>