<?php 
	if($this->session->userdata('login_session')['login'] == 'GLBKU'){
        
	}else{
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
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/loder.css">

</head>

<body onBlur="self.focus();">
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>

                    </ul>
                </form>

                <ul class="navbar-nav navbar-right">

                    <!-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                            class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Messages
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-message">
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-avatar">
                                        <img alt="image"
                                            src="<?= base_url(); ?>/assets/stisla/assets/img/avatar/avatar-1.png"
                                            class="rounded-circle">
                                        <div class="is-online"></div>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Kusnaedi</b>
                                        <p>Hello, Bro!</p>
                                        <div class="time">10 Hours Ago</div>
                                    </div>
                                </a>

                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>

                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                            class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Notifications
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-icon bg-primary text-white">
                                        <i class="fas fa-code"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Template update is available now!
                                        <div class="time text-primary">2 Min Ago</div>
                                    </div>
                                </a>

                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li> -->

                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image"
                                src="<?= base_url(); ?>/assets/upload/user/<?= $this->session->userdata('login_session')['foto']; ?>"
                                class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">
                                <?= $this->session->userdata('login_session')['nama_lengkap']; ?>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">

                            <a href="<?= base_url() ?>profile" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>

                            <div class="dropdown-divider"></div>

                            <a href="#" onclick="logout()" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>

            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="<?= base_url() ?>home"><img src="<?= base_url() ?>assets/icon/judul.png"
                                height="50"></a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="<?= base_url() ?>home">GL</a>
                    </div>
                    <ul class="sidebar-menu">
                        <?php if($this->session->userdata('login_session')['level'] == '1'): ?>
                        <li class="menu-header">Dashboard</li>
                        <li class="<?= ($judul == 'Home') ? "active" : "" ?>"><a class="nav-link"
                                href="<?= base_url() ?>home">
                                <i class="fas fa-home"></i>
                                <span>Home</span>

                            </a></li>
                        <?php endif; ?>

                        <li class="menu-header">Data</li>

                        <!-- akses -->
                        <?php if($this->session->userdata('login_session')['level'] == '3' || $this->session->userdata('login_session')['level'] == '2' || $this->session->userdata('login_session')['level'] == '1'): ?>

                        <li
                            class="nav-item dropdown <?= ($judul == 'Est Pendapatan' || $judul == 'Customer' || $judul == 'Project' || $judul == 'Kategori Biaya' || $judul == 'Vendor') ? "active" : "" ?>">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-edit"></i></i><span>Master
                                    Data</span></a>
                            <ul class="dropdown-menu">
                                <?php if($this->session->userdata('login_session')['level'] == '3'): ?>
                                <li class="<?= ($judul == 'Vendor') ? "active" : "" ?>"><a class="nav-link"
                                        href="<?= base_url() ?>vendor">Vendor</a></li>
                                <?php else: ?>
                                <li class="<?= ($judul == 'Customer') ? "active" : "" ?>"><a class="nav-link"
                                        href="<?= base_url() ?>customer">Customer</a></li>
                                <li class="<?= ($judul == 'Project') ? "active" : "" ?>"><a class="nav-link"
                                        href="<?= base_url() ?>project">Project</a></li>
                                <li class="<?= ($judul == 'Kategori Biaya') ? "active" : "" ?>"><a class="nav-link"
                                        href="<?= base_url() ?>katbiaya">Kategori Biaya</a></li>
                                <li class="<?= ($judul == 'Vendor') ? "active" : "" ?>"><a class="nav-link"
                                        href="<?= base_url() ?>vendor">Vendor</a></li>
                                <li class="<?= ($judul == 'Est Pendapatan') ? "active" : "" ?>"><a class="nav-link"
                                        href="<?= base_url() ?>estPendapatan">
                                        <span>Est Pendapatan</span>

                                    </a></li>
                                <?php endif; ?>
                            </ul>
                        </li>

                        <?php endif; ?>
                        <!-- end akses -->

                        <!-- akses -->
                        <?php if($this->session->userdata('login_session')['level'] == '2' || $this->session->userdata('login_session')['level'] == '1'): ?>

                        <li class="<?= ($judul == 'Pendapatan') ? "active" : "" ?>"><a class="nav-link"
                                href="<?= base_url() ?>pendapatan"><i class="fas fa-long-arrow-alt-up"></i>
                                <span>Pendapatan</span></a></li>

                        <li class="<?= ($judul == 'Piutang') ? "active" : "" ?>"><a class="nav-link"
                                href="<?= base_url() ?>piutang"><i class="far fa-money-bill-alt"></i>
                                <span>Piutang</span></a></li>

                        <?php endif; ?>
                        <!-- end akses -->


                        <!-- akses -->
                        <?php if($this->session->userdata('login_session')['level'] == '3' || $this->session->userdata('login_session')['level'] == '4' || $this->session->userdata('login_session')['level'] == '5' || $this->session->userdata('login_session')['level'] == '1'): ?>

                        <li class="<?= ($judul == 'Pembiayaan') ? "active" : "" ?>"><a class="nav-link"
                                href="<?= base_url() ?>pembiayaan"><i class="fas fa-money-bill"></i>
                                <span>Pembiayaan</span></a></li>

                        <?php endif; ?>
                        <!-- end akses -->

                        <!-- akses -->
                        <?php if($this->session->userdata('login_session')['level'] == '3' || $this->session->userdata('login_session')['level'] == '1' || $this->session->userdata('login_session')['level'] == '5'): ?>

                        <li class="<?= ($judul == 'Hutang') ? "active" : "" ?>"><a class="nav-link"
                                href="<?= base_url() ?>hutang"><i class="far fa-credit-card"></i>
                                <span>Hutang</span></a></li>

                        <li class="<?= ($judul == 'Angsuran') ? "active" : "" ?>"><a class="nav-link"
                                href="<?= base_url() ?>angsuran"><i class="fas fa-money-check-alt"></i>
                                <span>Angsuran</span></a></li>

                        <?php endif; ?>
                        <!-- end akses -->



                        <!-- akses -->
                        <?php if($this->session->userdata('login_session')['level'] == '1'): ?>

                        <li class="menu-header">Laporan</li>

                        <li
                            class="nav-item dropdown <?= ($judul == 'Laporan Est Pendapatan' || $judul == 'Laporan Grafik' || $judul == 'Laporan Per Kategori' || $judul == 'Laporan Per Projek' || $judul == 'Laporan Non Investasi' || $judul == 'Laporan Detail Project' || $judul == 'Laporan Hutang') ? "active" : "" ?>">
                            <a href="#" class="nav-link has-dropdown"><i
                                    class="fas fa-print"></i></i><span>Laporan</span></a>
                            <ul class="dropdown-menu">
                                <li class="<?= ($judul == 'Laporan Per Kategori') ? "active" : "" ?>"><a
                                        class="nav-link" href="<?= base_url() ?>perkategori">
                                        <span>Per Kategori</span>

                                <li class="<?= ($judul == 'Laporan Per Projek') ? "active" : "" ?>"><a class="nav-link"
                                        href="<?= base_url() ?>perprojek">
                                        <span>Per Project</span>

                                    </a></li>

                                <li class="<?= ($judul == 'Laporan Non Investasi') ? "active" : "" ?>"><a
                                        class="nav-link" href="<?= base_url() ?>noninvestasi">
                                        <span>Non Investasi</span>

                                    </a></li>

                                <li class="<?= ($judul == 'Laporan Detail Project') ? "active" : "" ?>"><a
                                        class="nav-link" href="<?= base_url() ?>detailproject">
                                        <span>Detail Project</span>

                                    </a></li>

                                <li class="<?= ($judul == 'Laporan Grafik') ? "active" : "" ?>"><a class="nav-link"
                                        href="<?= base_url() ?>grafik">
                                        <span>Grafik</span>

                                    </a></li>

                                <li class="<?= ($judul == 'Laporan Est Pendapatan') ? "active" : "" ?>"><a
                                        class="nav-link" href="<?= base_url() ?>LestPendapatan">
                                        <span>Est Pendapatan</span>

                                    </a></li>


                                <li class="<?= ($judul == 'Laporan Hutang') ? "active" : "" ?>"><a class="nav-link"
                                        href="<?= base_url() ?>lapHutang">
                                        <span>Hutang</span>

                                    </a></li>

                                <li class="<?= ($judul == 'Invest Project') ? "active" : "" ?>"><a class="nav-link"
                                        href="<?= base_url() ?>investp">
                                        <span>Invest Project</span></a></li>



                            </ul>
                        </li>




                        <li class="menu-header">Lainnya</li>
                        <li class="<?= ($judul == 'User') ? "active" : "" ?>"><a class="nav-link"
                                href="<?= base_url() ?>user"><i class="fas fa-users"></i> <span>User</span></a></li>

                        <?php if($this->session->userdata('login_session')['username'] == 'dev'): ?>

                        <li class="<?= ($judul == 'Export Import') ? "active" : "" ?>"><a class="nav-link"
                                href="<?= base_url() ?>eximp"><i class="fas fa-file-export"></i>
                                <span>Export/Import</span></a></li>

                        <?php endif; ?>

                        <?php endif; ?>
                        <!-- end akses -->


                    </ul>



                    <!-- akses -->
                    <?php if($this->session->userdata('login_session')['level'] != '1'): ?>

                    <div class="mt-2 mb-4 p-3 hide-sidebar-mini">
                        <a href="<?= base_url() ?>profile" class="btn btn-primary btn-lg btn-block btn-icon-split">
                            <i class="fas fa-user"></i> Profile
                        </a>

                        <a href="#" onclick="logout()" class="btn btn-danger btn-lg btn-block btn-icon-split">
                            <i class="fas fa-sign-out-alt"></i> Log Out
                        </a>
                    </div>

                    <?php endif; ?>
                    <!-- end akses -->

                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <!-- Link BASE_URL buat file JS -->
                <input type="hidden" value="<?= base_url() ?>" id="baseurl">