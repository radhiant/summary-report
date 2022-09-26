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
            window.location.href = base_url + "User/proses_hapus/" + id;
        }
    });

}



var table;
$(document).ready(function() {

    //datatables
    table = $('#table-1').DataTable({

        "processing": true,
        "serverSide": true,
        "info" : false,
        "order": [],
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua "]],
        "pageLength": 10,

        "ajax": {
            "url": "<?php echo site_url('user/getDataUser')?>",
            "type": "POST"
        },


        "columnDefs": [
            {
            "targets": [6],
            "orderable": false,
        }, 
        {
            "targets": [1],
            "orderable": false,
        }, 
    ],

    });

});


function validateForm() {
    var namaL = document.forms["myForm"]["nmlengkap"].value;
    var user = document.forms["myForm"]["username"].value;
    var level = document.forms["myForm"]["level"].value;
    var pwd = document.forms["myForm"]["pwd"].value;
    var kpwd = document.forms["myForm"]["pwdU"].value;

    if (namaL == "") {
        validasi('Nama Lengkap wajib di isi!', 'warning');
        return false;
    } else if (user == '') {
        validasi('Username wajib di isi!', 'warning');
        return false;
    } else if (level == '') {
        validasi('Level wajib di isi!', 'warning');
        return false;
    } else if (pwd == '') {
        validasi('Password wajib di isi!', 'warning');
        return false;
    } else if (pwd !== '' || kpwd !== '') {

        if (pwd.length < 6) {
            validasi('Panjang Password minimal 6 karakter!', 'warning');
            return false;
        } else if (pwd !== kpwd) {
            validasi('Konfirmasi Password tidak sesuai!', 'warning');
            return false;
        }

    }

}

function validateFormUpdate() {
    var namaL = document.forms["myForm"]["nmlengkap"].value;
    var user = document.forms["myForm"]["username"].value;
    var level = document.forms["myForm"]["level"].value;
    var pwd = document.forms["myForm"]["pwd"].value;
    var kpwd = document.forms["myForm"]["pwdU"].value;

    if (namaL == "") {
        validasi('Nama Lengkap wajib di isi!', 'warning');
        return false;
    } else if (user == '') {
        validasi('Username wajib di isi!', 'warning');
        return false;
    } else if (level == '') {
        validasi('Level wajib di isi!', 'warning');
        return false;
    } else if (pwd !== '' || kpwd !== '') {

        if (pwd.length < 6) {
            validasi('Panjang Password minimal 6 karakter!', 'warning');
            return false;
        } else if (pwd !== kpwd) {
            validasi('Konfirmasi Password tidak sesuai!', 'warning');
            return false;
        }

    }

}

function lodingklik(){
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


function fileIsValid(fileName) {
    var ext = fileName.match(/\.([^\.]+)$/)[1];
    ext = ext.toLowerCase();
    var isValid = true;
    switch (ext) {
        case 'png':
        case 'jpeg':
        case 'jpg':
        case 'tiff':
        case 'gif':
        case 'tif':
        case 'pdf':

            break;
        default:
            this.value = '';
            isValid = false;
    }
    return isValid;
}

function VerifyFileNameAndFileSize() {
    var file = document.getElementById('GetFile').files[0];


    if (file != null) {
        var fileName = file.name;
        if (fileIsValid(fileName) == false) {
            validasi('Format bukan gambar!', 'warning');
            document.getElementById('GetFile').value = null;
            return false;
        }
        var content;
        var size = file.size;
        if ((size != null) && ((size / (1024 * 1024)) > 3)) {
            validasi('Ukuran maximum 1024px', 'warning');
            document.getElementById('GetFile').value = null;
            return false;
        }

        var ext = fileName.match(/\.([^\.]+)$/)[1];
        ext = ext.toLowerCase();

        if (ext == 'pdf') {
            $('#pdf').show();
            $('#img').hide();
            $(".custom-file-label").addClass("selected").html(file.name);
            document.getElementById('outputPdf').src = window.URL.createObjectURL(file);
        } else {
            $('#pdf').hide();
            $('#img').show();
            $(".custom-file-label").addClass("selected").html(file.name);
            document.getElementById('outputImg').src = window.URL.createObjectURL(file);
        }
        return true;

    } else
        return false;
}
</script>