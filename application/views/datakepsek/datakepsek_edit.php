<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<div class="clearfix">
        <div class="page-header">
					<h1>
						Data Kepala Sekolah 
						<small>
							<i class="ace-icon fa fa-angle-double-right"></i>
							Ubah Kepala Sekolah 
						</small>
					</h1>
				</div>
				<div class="pull-right"><a href='<?php echo base_url().'index.php/datakepsek' ?>' class="btn btn-xs btn-warning">Kembali</a></div>
			</div>
			 <div>  
        <?php
            if($this->session->userdata('message') <> ''){
                $msg = 'warning';
                if($this->session->userdata('info')==1){
                  $msg = 'info';
                }
                echo '<br><div class="alert alert-'.$msg.'">
                        <button class="close" data-dismiss="alert">
                          <i class="ace-icon fa fa-times"></i>
                        </button>
                        '.$this->session->userdata('message').'
                      </div>';
            }
        ?> 
			 </div>
			<div class="hr hr2 hr-double"></div>
      <br> 
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

		</div><!-- /.col -->
	</div><!-- /.row -->
</div>

 
