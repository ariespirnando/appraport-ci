<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<div class="clearfix">
        <div class="page-header">
					<h1>
						Data Kelas
						<small>
							<i class="ace-icon fa fa-angle-double-right"></i>
							Ubah Kelas
						</small>
					</h1>
				</div>
				<div class="pull-right"><a href='<?php echo base_url().'index.php/datakelas' ?>' class="btn btn-xs btn-warning">Kembali</a></div>
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
            <label class="col-sm-2 col-form-label">Peminatan</label>
            <div class="col-sm-10">
              <select class="form-control"  name='kodejuruan' >
                <?php foreach ($jurusan as $k) {
                  if ($res['kodejuruan']==$k['kodejuruan']){
                    echo '<option selected value="'.$k['kodejuruan'].'">'.$k['kodejuruan'].'</option>';
                  }else{
                    echo '<option value="'.$k['kodejuruan'].'">'.$k['kodejuruan'].'</option>';
                  } 
                }?>
              </select> 
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Kode Kelas</label>
            <div class="col-sm-10">
              <select class="form-control"  name='kodekelas' >
                <?php foreach ($kelas as $k) {
                  if ($res['kodekelas']==$k['kodekelas']){
                    echo '<option selected value="'.$k['kodekelas'].'">'.$k['kodekelas'].'</option>';
                  }else{
                    echo '<option value="'.$k['kodekelas'].'">'.$k['kodekelas'].'</option>';
                  } 
                }?>
              </select> 
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nama Kelas</label>
            <div class="col-sm-10"> 
              <input type="hidden" class="form-control"  name='guidkelas' value='<?php echo $id ?>'>
              <input type="text" class="form-control"  name='namakelas' placeholder="Nama Kelas" value="<?php echo $res['namakelas'] ?>">
            </div>
          </div> 

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">NIK Walikelas</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  name='nikwalikelas' placeholder="Nama Kelas" value="<?php echo $res['nikwalikelas'] ?>">
            </div>
          </div> 

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nama Walikelas</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  name='namawalikelas' placeholder="Nama Kelas" value="<?php echo $res['namawalikelas'] ?>">
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

 
