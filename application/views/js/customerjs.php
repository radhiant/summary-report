<!-- modal tambah -->
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>customer/proses_tambah" name="myForm" method="POST"
                    onsubmit="return validateForm()">
                    <div class="form-group">
                        <label for="">ID Customer</label>
                        <input type="text" class="form-control" name="customerid" value="<?= $genID ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="">Nama Customer</label>
                        <input type="text" class="form-control" name="namaC">
                    </div>

                    <div class="form-group">
                        <label for="">Pilih Kategori</label>
                        <select name="kategori" class="form-control">
                            <option value="">--Pilih--</option>
                            <option value="Pemerintahan">Pemerintahan</option>
                            <option value="Swasta">Swasta</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Pilih Akun Manager</label>
                        <select name="am" class="form-control">
                            <option value="">--Pilih--</option>
                            <?php foreach($user as $usr): ?>
                            <option value="<?= $usr->user_id ?>"><?= $usr->user_nmlengkap ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Pilih Kondisi</label>
                        <select name="kondisi" class="form-control">
                            <option value="">--Pilih--</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
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
                <h5 class="modal-title">Ubah Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>customer/proses_ubah" name="myFormUpdate" method="POST"
                    onsubmit="return validateFormUpdate()">
                    <div class="form-group">
                        <label for="">ID Customer</label>
                        <input type="text" class="form-control" name="customerid" id="customerid" readonly>
                    </div>

                    <div class="form-group">
                        <label for="">Nama Customer</label>
                        <input type="text" class="form-control" name="namaC" id="namaC">
                    </div>

                    <div class="form-group">
                        <label for="">Pilih Kategori</label>
                        <select name="kategori" class="form-control" id="kategori">
                            <option value="">--Pilih--</option>
                            <option value="Pemerintahan">Pemerintahan</option>
                            <option value="Swasta">Swasta</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Pilih Akun Manager</label>
                        <select name="am" class="form-control" id="am">
                            <option value="">--Pilih--</option>
                            <?php foreach($user as $usr): ?>
                            <option value="<?= $usr->user_id ?>"><?= $usr->user_nmlengkap ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Pilih Kondisi</label>
                        <select name="kondisi" class="form-control" id="kondisi">
                            <option value="">--Pilih--</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
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
            window.location.href = base_url + "customer/proses_hapus/" + id;
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
            window.location.href = base_url + "customer/hapus_all";
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
    var base_url = link + 'customer/getData';

    $.ajax({
        type: 'POST',
        data: 'id=' + id,
        url: base_url,
        dataType: 'json',
        success: function(hasil) {
            $('#customerid').val(hasil[0].customer_id);
            $('#namaC').val(hasil[0].customer_nama);
            $("#kategori").val(hasil[0].customer_kategori).trigger("chosen:updated");
            $("#am").val(hasil[0].customer_am).trigger("chosen:updated");
            $("#kondisi").val(hasil[0].customer_kondisi).trigger("chosen:updated");
            enable();
        }
    });
}

var table;
$(document).ready(function() {

    // $("#check-all").click(function() { // Ketika user men-cek checkbox all
    //     if ($(this).is(":checked")) // Jika checkbox all diceklis
    //         $(".check-item").prop("checked",
    //         true); // ceklis semua checkbox siswa dengan class "check-item"
    //     else // Jika checkbox all tidak diceklis
    //         $(".check-item").prop("checked",
    //         false); // un-ceklis semua checkbox siswa dengan class "check-item"
    // });

    //datatables
    table = $('#table-1').DataTable({
        "lengthMenu": [
            [5, 10, 25, 50, 100],
            [5, 10, 25, 50, 100]
        ],
        "pageLength": 10,

        "order": [
            [0, "desc"]
        ],

        lengthChange: false,

        dom: 'Bfrtip',

        buttons: [{
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
                action: function(e, dt, node, config) {
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
            "targets": [6],
            "orderable": false,
        }, ],

    });

    table.buttons().container()
        .appendTo('#example_wrapper .col-md-6:eq(0)');

});

function validateForm() {
    lodingklik();
    var namaC = document.forms["myForm"]["namaC"].value;
    var kategori = document.forms["myForm"]["kategori"].value;
    var am = document.forms["myForm"]["am"].value;
    var kondisi = document.forms["myForm"]["kondisi"].value;

    if (namaC == "") {
        pesan('Nama Customer wajib di isi!', 'warning');
        return false;
    } else if ($kategori == "") {
        pesan('Pilih Kategori!', 'warning');
        return false;
    } else if ($am == "") {
        pesan('Pilih Akun Manager!', 'warning');
        return false;
    } else if ($kondisi == "") {
        pesan('Pilih Kondisi!', 'warning');
        return false;
    }

}

function validateFormUpdate() {
    lodingklik();
    var namaC = document.forms["myFormUpdate"]["namaC"].value;
    var kategori = document.forms["myFormUpdate"]["kategori"].value;
    var am = document.forms["myFormUpdate"]["am"].value;

    if (namaC == "") {
        pesan('Nama Customer wajib di isi!', 'warning');
        return false;
    } else if ($kategori == "") {
        pesan('Pilih Kategori!', 'warning');
        return false;
    } else if ($am == "") {
        pesan('Pilih Akun Manager!', 'warning');
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