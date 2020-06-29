<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<div class="clearfix">
        <div class="page-header">
					<h1>
						Upload Raport
					</h1>
				</div>
        <?php if($this->session->userdata('rule')==1){ ?>
				<div class="pull-right"><a href='<?php echo $add ?>' class="btn btn-xs btn-primary">Upload</a></div>
        <?php } ?>
			</div>
			<div>
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
  
        <div class="row">
            <div class="col-md-6"> 
              
            </div>
            <div class="col-md-6 text-right"> 
              <div class="input-group">
                  
                  <span class="input-group-btn"> 
                    
                  </span>
              </div>
            </div>
        </div>

      <br> 
        <form method="post" action="<?php echo base_url().'index.php/upload' ?>">
        <table id="table" class="table table-striped table-bordered table-hover" width="90%">
          <thead>
            <tr> 
              <td colspan="7" class="center">
                <input type="text" class="form-control btn-xs" name="search" value="<?php echo $search ?>" placeholder='Cari Data'>
              </td>
              <td colspan="2" class="center">
                <input type="submit" name='submit' class="btn btn-xs btn-success" value="Cari Data"> 
                <?php 
                  if($search!=''){
                    ?>
                      <input type="submit" name='reset' class="btn btn-xs btn-primary" value="Reset"> 
                    <?php
                  }
                ?>
              </td>
            </tr>
            <tr>
              <th width="5%" class="center">No</th>
              <th width="10%" class="center">Kelas</th>
              <th width="10%" class="center">Semester</th>
              <th width="10%" class="center">Jurusan</th>
              <th width="10%" class="center">Tahun Ajaran</th> 
              <th width="20%" class="center">Keterangan</th>   
              <th width="20%" colspan='2' class="center">Tanggal TTD Raport</th>
              <th width="16%" class="center" class="center">Opsi</th> 
            </tr> 
          </thead> 
          <tbody> 
           <?php
            $n = $page+1;
            foreach ($upload as $k) {
              echo '
                <tr>
                  <td widtd="5%" class="center">'.$n++.'</td>
                  <td widtd="15%" class="">'.$k['namakelas'].'</td>
                  <td widtd="15%" class="">'.$k['semester'].'</td>
                  <td widtd="15%" class="">'.$k['kodejuruan'].'</td> 
                  <td widtd="15%" class="">'.$k['tahunajaran'].'</td> 
                  <td widtd="20%" class="">'.$k['keterangan'].'</td>
                  <td widtd="15%" class="center">'.$k['tanggal_raport'].'</td>';
                    echo '<td widtd="8%" class="center"><a class="btn btn-xs btn-primary" href="'.base_url().'index.php/upload/edittgl_upload/'.$k['guidupload'].'">';
                    echo '<i class="ace-icon fa fa-edit bigger-120"></i></a></td>';
                  if($this->session->userdata('rule')==1){
                    echo '<td widtd="8%" class="center"><a class="btn btn-xs btn-danger" href="'.base_url().'index.php/upload/hapus_upload/'.$k['guidupload'].'">';
                    echo '<i class="ace-icon fa fa-trash-o bigger-120"></i></a></td>';
                  }else{ 
                    echo '<td>-</td>';
                  } 
                echo '</tr>';
            }
           ?>
          </tbody>
        </table> 
        </form>
          <div class="col">
              <!--Tampilkan pagination-->
              <?php echo $pagination; ?>
          </div> 

        <br>
        <div class="row">
            <div class="col-md-6 text-left">  
              <div style='margin-top: 10px;' id='pagination'></div>
            </div>
            <div class="col-md-6 text-right">  
            </div>
        </div>
			</div>
			<div class="hr hr2 hr-double"></div>
		</div><!-- /.col -->
	</div><!-- /.row -->
</div>

 
 
