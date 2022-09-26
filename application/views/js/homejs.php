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
<script src="<?= base_url(); ?>assets/plugin/chosen/chosen.jquery.min.js"></script>

<?php if($this->session->flashdata('Pesan')): ?>
<!-- doing this-->
<?= $this->session->flashdata('Pesan') ?>
<?php elseif($judul == 'Print Pendapatan'): ?>

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
    getPendapatan();
});

    
$('.chosen').chosen({});

function pesan(judul, status) {
    swal.fire({
        title: judul,
        icon: status,
        confirmButtonColor: '#6777ef',
    });
}

function projek(){
    getPendapatan();
}



function getPendapatan(){
    $("#pendapatan").addClass("card-progress");
    $("#totalCard").removeClass("animate__bounceIn");

    var link = $('#baseurl').val();
    var base_url = link + 'home/getData';
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
            $('#npendapatan').text(formatRupiah(hasil.pendapatan, ''));
            $('#npi').text(formatRupiah(hasil.investasi, ''));
            $('#npni').text(formatRupiah(hasil.nonprojek, ''));
            $('#total').text(total(hasil.pendapatan, hasil.investasi, hasil.nonprojek));
            $("#pendapatan").removeClass("card-progress");
            $("#totalCard").addClass("animate__bounceIn");
        }
    });
}

function total(pendapatan, investasi, nonprojek){
    var totalInvest = parseInt(investasi) + parseInt(nonprojek);
    var fTotal = parseInt(pendapatan) - parseInt(totalInvest);
    var total = String(fTotal);
    if(total < 0 ){
        $("#totalCard").removeClass('bg-primary');
        $("#totalCard").addClass('bg-danger');
        return '-' + formatRupiah(total);
    }else{
        $("#totalCard").removeClass('bg-danger');
        $("#totalCard").addClass('bg-primary');
        return formatRupiah(total);
    }
    
}



function jan(){
    resetOptBulan();
    $('#bulan').text('Januari');
    $('#bln').val('January');
    $('#jan').addClass("active");
    getPendapatan();
}

function feb(){
    resetOptBulan();
    $('#bulan').text('Februari');
    $('#bln').val('February');
    $('#feb').addClass("active");
    getPendapatan();
}

function mart(){
    resetOptBulan();
    $('#bulan').text('Maret');
    $('#bln').val('March');
    $('#mart').addClass("active");
    getPendapatan();
}

function apr(){
    resetOptBulan();
    $('#bulan').text('April');
    $('#bln').val('April');
    $('#apr').addClass("active");
    getPendapatan();
}

function may(){
    resetOptBulan();
    $('#bulan').text('Mei');
    $('#bln').val('May');
    $('#may').addClass("active");
    getPendapatan();
}

function jun(){
    resetOptBulan();
    $('#bulan').text('Juni');
    $('#bln').val('June');
    $('#jun').addClass("active");
    getPendapatan();
}

function jul(){
    resetOptBulan();
    $('#bulan').text('Juli');
    $('#bln').val('July');
    $('#jul').addClass("active");
    getPendapatan();
}

function agus(){
    resetOptBulan();
    $('#bulan').text('Agustus');
    $('#bln').val('August');
    $('#agus').addClass("active");
    getPendapatan();
}

function sep(){
    resetOptBulan();
    $('#bulan').text('September');
    $('#bln').val('September');
    $('#sep').addClass("active");
    getPendapatan();
}

function oct(){
    resetOptBulan();
    $('#bulan').text('Oktober');
    $('#bln').val('October');
    $('#oct').addClass("active");
    getPendapatan();
}

function nov(){
    resetOptBulan();
    $('#bulan').text('November');
    $('#bln').val('November');
    $('#nov').addClass("active");
    getPendapatan();
}

function dec(){
    resetOptBulan();
    $('#bulan').text('Desember');
    $('#bln').val('December');
    $('#dec').addClass("active");
    getPendapatan();
}

function tya(tahun){
    resetOptTahun();
    $("#tahun").html(tahun);
    $('#thn').val(tahun);
    $('#tya').addClass("active");
    getPendapatan();
}

function py(tahun){
    resetOptTahun();
    $("#tahun").html(tahun);
    $('#thn').val(tahun);
    $('#py').addClass("active");
    getPendapatan();
}

function yn(tahun){
    resetOptTahun();
    $("#tahun").html(tahun);
    $('#thn').val(tahun);
    $('#yn').addClass("active");
    getPendapatan();
}

function reset(){
    resetOptBulan();
    $('#bulan').text('Pilih Bulan');
    getPendapatan();
}

function resetOptBulan(){
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

function resetOptTahun(){
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

</script>

