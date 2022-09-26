<?php 

if ($this->session->has_userdata('login_session')) {
    redirect('home');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>GLBKU | Login</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/icon/logoBKU-circle.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/stisla/node_modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/stisla/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/stisla/assets/css/components.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/all.css">
</head>

<body>
    <div id="app">
        <!-- Link BASE_URL buat file JS -->
        <input type="hidden" value="<?= base_url() ?>" id="baseurl">