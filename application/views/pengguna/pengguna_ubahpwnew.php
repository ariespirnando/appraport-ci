<?php
$rule = array(1=>'Human Resource',2=>'Head of Division', 3=>'Karyawan',4=>'Direksi & Manajemen', 5=>'Administrator');
?>

<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content ">
            
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Pengaturan</h2>
                     <div class="page-breadcrumb">
                     <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pengaturan</a></li> 
                                        <li class="breadcrumb-item active" aria-current="page">Ubah Password </li>
                                    </ol>
                                </nav>
                            </div>
                    </div>
                </div>
            </div>
        </div>  
        <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">

        <?php
            if($this->session->userdata('message') <> ''){
                $msg = 'warning';
                if($this->session->userdata('info')==1){
                  $msg = 'info';
                }
                echo '<div class="alert alert-'.$msg.'">
                        <button class="close" data-dismiss="alert">
                          <i class="ace-icon fa fa-times"></i>
                        </button>
                        '.$this->session->userdata('message').'
                      </div>';
            }
        ?> 


        <div class="card-body"> 
            <form method="post" action="<?php echo $action ?>"> 
            
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Password Lama</label>
                <div class="col-sm-10">
                <input type="password" class="form-control"  name='passwordL' placeholder="Password Lama">
                </div>
            </div> 
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Password Baru</label>
                <div class="col-sm-10">
                <input type="password" class="form-control"  name='passwordB' placeholder="Password Baru">
                </div>
            </div> 
            <div class="hr hr2 hr-double"></div>
            <br>
            <div class="form-group row"> 
                <div class="col-sm-5">
                <button type="submit" class="btn btn-xs btn-primary">Ubah</button>
                <button type="reset" class="btn btn-xs btn-danger">Batal</button>
                </div>
            </div>
            </form>
        <div>
        </div>
        </div>

        </div>
    </div>
</div>

 