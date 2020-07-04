

  
<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content ">
            
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Master</h2>
                     <div class="page-breadcrumb">
                     <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Master</a></li> 
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Kepala Sekolalas</a></li> 
                                        <li class="breadcrumb-item active" aria-current="page">Ubah</li>
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
        <div class='text-right'>
        <a href='<?php echo base_url().'index.php/datakepsek' ?>' class="btn btn-xs btn-warning">Kembali</a>
        </div>
        <form enctype="multipart/form-data"  method="post" action="<?php echo $action ?>">
        
          
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nama Kepala Sekolah</label>
            <div class="col-sm-10"> 
              <input type="hidden" class="form-control"  name='guidkepsek' value='<?php echo $id ?>'>
              <input type="text" class="form-control"  name='namakepsek' placeholder="Nama Kepala Sekolah" value="<?php echo $res['namakepsek'] ?>">
            </div>
          </div> 

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">NIK Kepala Sekolah</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  name='nikkepsek' placeholder="Nik Kepala Sekolah" value="<?php echo $res['nikkepsek'] ?>">
            </div>
          </div> 
  
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Upload File TTD</label>
            <div class="col-sm-10">
              <input type="file" class="form-control"  name='uploadfile' placeholder="uploadfile">
            </div>
          </div> 
 
          <div class="hr hr2 hr-double"></div>
          <br>
          <div class="form-group row"> 
            <div class="col-sm-5">
              <button type="submit" class="btn btn-xs btn-primary">Update</button> 
            </div>
          </div>
        </form>


        </div>
        </div>
        </div>

        </div>
    </div>
</div>

 
