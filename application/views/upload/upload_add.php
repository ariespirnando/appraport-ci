<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<div class="clearfix">
        <div class="page-header">
					<h1>
						Transaksi
						<small>
							<i class="ace-icon fa fa-angle-double-right"></i>
							Upload Raport
						</small>
					</h1>
				</div>
        <div class="pull-left"><a class="btn btn-xs btn-primary" href="<?php echo base_url()?>index.php/downloadtemp">Download Template</a></div>
				<div class="pull-right"><a href='<?php echo base_url().'index.php/upload' ?>' class="btn btn-xs btn-warning">Kembali</a></div>
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
        <form enctype="multipart/form-data" method="post" action="<?php echo $action ?>"> 
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Kelas</label>
            <div class="col-sm-10">
              <select class="form-control"  name='guidkelas' >
                <?php foreach ($kelas as $k) {
                  echo '<option value="'.$k['guidkelas'].'">'.$k['namakelas'].' - Jurusan '.$k['kodejuruan'].'</option>';
                }?>
              </select> 
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Semester</label>
            <div class="col-sm-10">
              <select class="form-control"  name='guidsemester' >
                <?php foreach ($semester as $k) {
                  echo '<option value="'.$k['guidsemester'].'">'.$k['tahunajaran'].'-'.$k['semester'].'</option>';
                }?>
              </select> 
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Keterangan Upload</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  name='keterangan' placeholder="Keterangan">
            </div>
          </div> 
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tanggal TTD Raport</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id='datepicker' name='tanggal_raport' placeholder="Tanggal TTD Raport">
            </div>
          </div> 
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Upload File</label>
            <div class="col-sm-10">
              <input type="file" class="form-control"  name='uploadfile' placeholder="uploadfile">
            </div>
          </div> 
          <div class="hr hr2 hr-double"></div>
          <br>
          <div class="form-group row"> 
            <div class="col-sm-5">
              <button type="submit" class="btn btn-xs btn-primary">Simpan</button>
              <button type="reset" class="btn btn-xs btn-danger">Batal</button>
            </div>
          </div>
        </form>

		</div><!-- /.col -->
	</div><!-- /.row -->
</div>

<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>

 
