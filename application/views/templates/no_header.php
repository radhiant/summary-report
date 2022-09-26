<?php 
	if(!$this->session->userdata('login_session')['login'] == 'GLBKU'){
        redirect('login/logout');
        exit;
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>GLBKU | <?= $judul; ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/icon/logoBKU-circle.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/stisla/node_modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/stisla/node_modules/weathericons/css/weather-icons.min.css">
    <link rel="stylesheet"
        href="<?= base_url(); ?>assets/stisla/node_modules/weathericons/css/weather-icons-wind.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/stisla/node_modules/summernote/dist/summernote-bs4.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="<?= base_url(); ?>assets/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?= base_url(); ?>assets/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />

    <!-- Select datepicker -->
    <link href="<?= base_url(); ?>assets/plugin/datepicker/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/plugin/bdaterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Select Chosen -->
    <link href="<?= base_url(); ?>assets/plugin/chosen/dist/css/component-chosen.min.css" rel="stylesheet">


    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/stisla/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/stisla/assets/css/components.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/all.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/table-print.css">

</head>

<body onload="window.print()" style="background-color: white; important!">
    <div id="app">
        <div class="main-wrapper">
        
            <!-- Main Content -->
            <div class="container">
                <!-- Link BASE_URL buat file JS -->
                <input type="hidden" value="<?= base_url() ?>" id="baseurl">