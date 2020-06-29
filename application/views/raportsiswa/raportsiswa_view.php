<style type="text/css">
.spinner {
    position: ;
    margin-left: 0px; 
    margin-right: 0px;
    text-align:center;
    overflow: auto;
    padding: 10px 10px 10px 10px;
} 
</style>
<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<div class="clearfix">
        <div class="page-header">
					<h1>
            <?php if($rule==1){
              echo 'Data Raport';
            }else{
              echo 'Download Raport';
            }?> 
					</h1>
				</div> 
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

        <br
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
 
        <form method="post" action="<?php echo base_url().'index.php/raportsiswa' ?>">
        <table id="table" class="table table-striped table-bordered table-hover" width="90%">
          <thead>
            <tr> 
            
              <td colspan="7" class="center">
                <input type="text" class="form-control btn-xs" name="search" value="<?php echo $search ?>" placeholder='Cari Data'>
              </td>
              <?php if($rule==1){ ?>
              <td colspan="3" class="center">
              <?php }else{ ?>
              <td colspan="3" class="center">
              <?php } ?>
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
              <th width="3%" class="center">No</th>
              <th width="10%" class="center">Nomor Induk</th>
              <th width="25%" class="center">Nama Siswa</th> 
              <th width="3%" class="center">Jenis Kelamin</th>  
              <th width="15%" class="center">Kelas & Semester</th> 
              <th width="5%" class="center">Tahun Ajaran</th>  
              <th width="5%" class="center">Peminatan</th> 
              <?php if($rule==1){ ?>
              <th width="5%" class="center">Status Pembayaran SPP</th> 
              <?php } ?>
              <th width="5%" class="center">Status Kenaikan Kelas</th> 
              <th width="5%" class="center">Download Raport</th> 
            </tr> 
          </thead> 
          <tbody> 
           <?php
            $n = $page+1;
            foreach ($raportsiswa as $k) {
              echo '
                <tr>
                  <td widtd="3%" class="center">'.$n++.'</td> 
                  <td widtd="10%" class="">'.$k['niksiswa'].'</td>
                  <td widtd="25%" class="">'.$k['namasiswa'].'</td>
                  <td widtd="3%" class="center">'.$k['kelamin'].'</td>
                  <td widtd="15%" class="">'.$k['namakelas'].'-'.$k['semester'].'</td> 
                  <td widtd="5%" class="">'.$k['tahunajaran'].'</td>
                  <td widtd="5%" class="">'.$k['kodejuruan'].'</td>';
                  
                  if($rule==1){
                    echo '<td widtd="5%" class="">';
                    if($k['statusspp'] == 'Belum Lunas'){
                      echo '<a class="btn btn-xs btn-danger" href="'.base_url().'index.php/raportsiswa/updatespp/'.$k['guidraport'].'">';
                      echo $k['statusspp'].'</a>'; 
                    }else{
                      echo '<a class="btn btn-xs btn-primary" href="'.base_url().'index.php/raportsiswa/updatespp2/'.$k['guidraport'].'">';
                      echo $k['statusspp'].'</a>'; 
                    }
                    echo '</td>';
                  } 
                  
                  echo '<td widtd="5%" class="">';
                  if($rule==1){
                    if($k['statuskenaikan'] == 'Tidak Naik Kelas'){
                      echo '<a class="btn btn-xs btn-danger" href="'.base_url().'index.php/raportsiswa/updatekenaikan/'.$k['guidraport'].'">';
                      echo $k['statuskenaikan'].'</a>'; 
                    }else{
                      echo '<a class="btn btn-xs btn-primary" href="'.base_url().'index.php/raportsiswa/updatekenaikan2/'.$k['guidraport'].'">';
                      echo $k['statuskenaikan'].'</a>';   
                    } 
                  }else{
                    if($k['statuskenaikan'] == 'Tidak Naik Kelas'){
                      echo '<a class="btn btn-xs btn-danger" href="#">';
                      echo $k['statuskenaikan'].'</a>'; 
                    }else{
                      echo $k['statuskenaikan'];
                    } 
                  }
                  echo '</td>
                  <td widtd="5%" class="center"><a class="btn btn-xs btn-primary" href="'.base_url().'index.php/raportsiswa/download1/'.$k['guidraport'].'">';
                  echo '<i class="ace-icon fa fa-download bigger-120"></i></a></td>
                </tr>
                  ';  
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

			</div>
			<div class="hr hr2 hr-double"></div>
		</div><!-- /.col -->
	</div><!-- /.row -->
</div>
 

 
 
