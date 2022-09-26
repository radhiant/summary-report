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
var table;

$(document).ready(function() {

    getData();

});

function getData() {
    $('#cardLine').addClass('card-progress');
    $('#myChart').remove();
    $('#cardChart').append('<canvas id="cardTest" height="500"></canvas>'); 
    var link = $('#baseurl').val();
    var base_url = link + 'grafik/getData';
    var tahun = $('#thn').val();

    $.ajax({
        type: 'POST',
        data: 'tahun=' + tahun,
        url: base_url,
        dataType: 'json',
        success: function(hasil) {
            $('#cardLine').removeClass('card-progress');
            $('#cardTest').remove();
            $('#cardChart').append('<canvas id="myChart"><canvas>'); 
            grapik(hasil.pndJan, hasil.pndFeb, hasil.pndMar, hasil.pndApr, hasil.pndMei,
                hasil.pndJun, hasil.pndJul, hasil.pndAgs, hasil.pndSep, hasil.pndOkt,
                hasil.pndNov, hasil.pndDes, hasil.pmbJan, hasil.pmbFeb, hasil.pmbMar,
                hasil.pmbApr, hasil.pmbMei, hasil.pmbJun, hasil.pmbJul, hasil.pmbAgs,
                hasil.pmbSep, hasil.pmbOkt, hasil.pmbNov, hasil.pmbDes);
        }
    });
}

function grapik(jan1, feb1, mar1, apr1, may1, jun1, jul1, ags1, sep1, oct1, nov1, des1, jan2, feb2, mar2, apr2, may2,
    jun2, jul2, ags2, sep2, oct2, nov2, des2, ) {

    "use strict";
    
    var type = $('#type').val();
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: type,
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "August", "Sep", "Oct", "Nov", "Des"],
            datasets: [{
                    label: 'Pendapatan',
                    data: [jan1, feb1, mar1, apr1, may1, jun1, jul1, ags1, sep1, oct1, nov1, des1],
                    borderWidth: 1,
                    backgroundColor: 'rgba(63,82,227,0.3)',
                    borderWidth: 5,
                    borderColor: 'rgba(63,82,227,.8)',
                    pointBorderWidth: 0,
                    pointRadius: 3.5,
                    pointBackgroundColor: 'white',
                    pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
                },
                {
                    label: 'Pembiayaan',
                    data: [jan2, feb2, mar2, apr2, may2, jun2, jul2, ags2, sep2, oct2, nov2, des2],
                    borderWidth: 1,
                    backgroundColor: 'rgba(254,86,83,0.5)',
                    borderWidth: 5,
                    borderColor: 'rgba(254,86,83,.8)',
                    pointBorderWidth: 0,
                    pointRadius: 3.5,
                    pointBackgroundColor: 'white',
                    pointHoverBackgroundColor: 'rgba(254,86,83,.8)',
                }
            ]
        },
        options: {
            legend: {
                display: true
            },

            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                        if (parseInt(value) >= 1000) {
                            return 'Rp' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                                ",");
                        } else {
                            return 'Rp' + value;
                        }
                    }
                } 
            }, 

            scales: {
                yAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false,
                        color: '#f2f2f2',
                    },

                    ticks: {
                        beginAtZero: true,
                        //stepSize: 10000,
                        callback: function(value, index, values) {
                            if (parseInt(value) < 900) {
                                return 'Rp' + value;
                            } else if(parseInt(value) < 900000){
                                return 'Rp' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                                    ",").substr(0,3) + 'rb';
                            }else if(parseInt(value) < 900000000){
                                return 'Rp' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                                    ",").substr(0,3) + 'jt';
                            }else if(parseInt(value) < 900000000000){
                                return 'Rp' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                                    ",").substr(0,3) + 'M';
                            }else{
                                return 'Rp' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                                    ",").substr(0,3) + 'T';
                            }
                        },

                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: true,
                        tickMarkLength: 20,
                        color: '#f2f2f2',
                    }
                }]
            },
        }
    });

}

function tya(tahun) {
    resetOptTahun();
    $("#tahun").html(tahun);
    $('#thn').val(tahun);
    $('#tya').addClass("active");
    getData();
}

function py(tahun) {
    resetOptTahun();
    $("#tahun").html(tahun);
    $('#thn').val(tahun);
    $('#py').addClass("active");
    getData();
}

function yn(tahun) {
    resetOptTahun();
    $("#tahun").html(tahun);
    $('#thn').val(tahun);
    $('#yn').addClass("active");
    getData();
}

function lineG() {
    resetOptGrafik();
    $("#typee").html('Line');
    $('#type').val('line');
    $('#lineG').addClass("active");
    getData();
}

function barG() {
    resetOptGrafik();
    $("#typee").html('Bar');
    $('#type').val('bar');
    $('#barG').addClass("active");
    getData();
}


function resetOptTahun() {
    $("#tya").removeClass("active");
    $("#py").removeClass("active");
    $("#yn").removeClass("active");
    $('#thn').val('');
}

function resetOptGrafik() {
    $("#lineG").removeClass("active");
    $("#barG").removeClass("active");
    $('#type').val('Line');
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