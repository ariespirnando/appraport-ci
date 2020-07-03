<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content ">
            
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">SMA NEGERI 2 KOTA BEKASI</h2>
                     <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb"> 
                                <li class="breadcrumb-item active" aria-current="page">Selamat Datang, <b>Achmad Aries Pirnando</b></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div> 
        <div class="ecommerce-widget">

        <?php if($this->session->userdata('rule')==1){ ?> 
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 text-center">
                    <div class="card">
                        <div class="card-body"> 
                        <div style='margin: auto;' class='center'>
                            Upload Raport
                            <hr>
                            <img src="<?php echo base_url() ?>/assets/new/assets/images/upload.png" alt="">
                        </div>
                        </div> 
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 text-center">
                    <div class="card">
                        <div class="card-body">
                        <div style='margin: auto;' class='center'>
                            Data Raport
                            <hr>
                            <img src="<?php echo base_url() ?>/assets/new/assets/images/raport.png" alt="">
                        </div>
                        </div> 
                    </div>
                </div> 
            </div>
        <?php } else { ?>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 text-center">
                    <div class="card">
                        <div class="card-body"> 
                        <div style='margin: auto;' class='center'>
                            Download Raport
                            <hr>
                            <img src="<?php echo base_url() ?>/assets/new/assets/images/download.png" alt="">
                        </div>
                        </div> 
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 text-center">
                    <div class="card">
                        <div class="card-body">
                        <div style='margin: auto;' class='center'>
                            Ubah Password
                            <hr>
                            <img src="<?php echo base_url() ?>/assets/new/assets/images/setting.png" alt="">
                        </div>
                        </div> 
                    </div>
                </div> 
            </div>
        <?php } ?>
        </div>
    </div>
</div>