</div>
</div>
</div>
</div>

<!-- Template JS File -->
<script src="<?= base_url(); ?>/assets/stisla/assets/js/scripts.js"></script>
<script src="<?= base_url(); ?>/assets/stisla/assets/js/custom.js"></script>

<script>
function logout() {

    var base_url = $('#baseurl').val();

    swal.fire({
        title: "Anda ingin logout?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'Iya',
        confirmButtonColor: '#4e73df',
    }).then((result) => {
        if (result.value) {
            Swal.fire({
                title: 'Memuat...',
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });
            window.location.href = base_url + "login/logout/";
        }
    });

}
</script>

</body>

</html>