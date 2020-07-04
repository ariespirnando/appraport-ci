<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags --> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Online Raport | SMA NEGERI 2 KOTA BEKASI</title>  
    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/images/logo.png" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/new/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="<?php echo base_url() ?>/assets/new/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/new/assets/libs/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/new/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
     
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/new/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/new/assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <title>Concept - Bootstrap 4 Admin Dashboard Template</title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="<?php echo base_url()?>index.php/home"">Online Raport</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top"> 
                        <li class="nav-item ">
                            <a class="nav-link " href="<?php echo base_url().'index.php/login/logout'?>"  aria-expanded="false"><img src="<?php echo base_url() ?>/assets/new/assets/images/exit.png" alt="" class="user-avatar-md "></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light"> 
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                        <?php if($this->session->userdata('rule')==1){ ?> 
                            <?php
                            $class = '';
                            if($modul=='Transaksi'){
                                $class = 'active';
                            }
                            ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $class ?>" href="<?php echo base_url() ?>/assets/new/#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fab fa-fw fa-wpforms"></i>Transaksi</a>
                                <div id="submenu-2" class="collapse submenu" style="">
                                    <ul class="nav flex-column"> 
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo base_url()?>index.php/upload">Upload Raport</a>
                                        </li> 
                                    </ul>
                                </div>
                            </li>
                        <?php }?>

                        <?php
                        $class = '';
                        if($modul=='Raport'){
                            $class = 'active';
                        }
                        ?>

                            <li class="nav-item">
                                <a class="nav-link <?php echo $class ?>" href="<?php echo base_url() ?>/assets/new/#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-fw fa-chart-pie"></i>Raport</a>
                                <div id="submenu-3" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo base_url()?>index.php/raportsiswa">Raport Siswa</a>
                                        </li> 
                                    </ul>
                                </div>
                            </li>
                        
                            <?php if($this->session->userdata('rule')==1){ ?> 
                            <?php
                            $class = '';
                            if($modul=='Master'){
                                $class = 'active open';
                            }
                            ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $class ?>" href="<?php echo base_url() ?>/assets/new/#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5"><i class="fas fa-fw fa-table"></i>Master</a>
                                <div id="submenu-5" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo base_url() ?>index.php/datasiswa">Siswa</a>
                                        </li>
										<li class="nav-item">
                                            <a class="nav-link" href="<?php echo base_url() ?>index.php/datakelas">Kelas</a>
                                        </li>
										<li class="nav-item">
                                            <a class="nav-link" href="<?php echo base_url() ?>index.php/datasemester">Semester</a>
                                        </li>
										<li class="nav-item">
                                            <a class="nav-link" href="<?php echo base_url() ?>index.php/datakepsek">Kepala Sekolah</a>
                                        </li> 
                                    </ul>
                                </div>
                            </li>
							<?php }?> 
                            <?php
                            $class = '';
                            if($modul=='Pengaturan'){
                                $class = 'active open';
                            }
                            ?>
							 
                            <li class="nav-item">
                                <a class="nav-link  <?php echo $class ?>" href="<?php echo base_url() ?>/assets/new/#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6" aria-controls="submenu-6"><i class="fas fa-fw fa-columns"></i> Pengaturan </a>
                                <div id="submenu-6" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo base_url().'index.php/pengguna/ganti_pwpengguna'?>">Ubah Password</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo base_url().'index.php/login/logout'?>">Keluar Sistem</a>
                                        </li> 
                                    </ul>
                                </div>
                            </li>
                              
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <?php echo $contents ;?> 
        </div> 
    </div> 
    <script src="<?php echo base_url() ?>/assets/new/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="<?php echo base_url() ?>/assets/new/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="<?php echo base_url() ?>/assets/new/assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="<?php echo base_url() ?>/assets/new/assets/libs/js/main-js.js"></script>
       
</body>
 
</html>