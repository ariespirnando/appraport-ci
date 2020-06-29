<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<div class="clearfix">
        <div class="page-header">
					<h1>
						Data Semester
						<small>
							<i class="ace-icon fa fa-angle-double-right"></i>
							Ubah Semester
						</small>
					</h1>
				</div>
				<div class="pull-right"><a href='<?php echo base_url().'index.php/datasemester' ?>' class="btn btn-xs btn-warning">Kembali</a></div>
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
        <form method="post" action="<?php echo $action ?>">

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Semester</label>
            <div class="col-sm-10">
              <input type="hidden" class="form-control"  name='guidsemester' value='<?php echo $id ?>'>
              <input type="text" class="form-control"  name='semester' placeholder="Semester" value="<?php echo $res['semester'] ?>">
            </div>
          </div> 

          <?php
            $tipes = array('GANJIL','GENAP'); 
          ?>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tipe</label>
            <div class="col-sm-10">
              <select class="form-control"  name='tipe' >
                <?php foreach ($tipes as $v) {
                  if($v==$res['tipe']){
                    echo '<option selected value="'.$v.'">'.$v.'</option>';
                  }else{
                    echo '<option value="'.$v.'">'.$v.'</option>';
                  } 
                }?>
              </select> 
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tahun Ajaran</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"  name='tahunajaran' placeholder="Tahun Ajaran" value="<?php echo $res['tahunajaran'] ?>">
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

 
