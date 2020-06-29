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
						Data Siswa 
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
 
        <form method="post" action="<?php echo base_url().'index.php/datasiswa' ?>">
        <table id="table" class="table table-striped table-bordered table-hover" width="90%">
          <thead>
            <tr> 
            
              <td colspan="5" class="center">
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
              <th width="15%" class="center">Nomor Induk</th>
              <th width="30%" colspan="2" class="center">Nama Siswa</th> 
              <th width="5%" class="center">Jenis Kelamin</th>
              <th width="5%" class="center">Reset Password</th>  
              <th width="5%" class="center">Delete</th>  
            </tr> 
          </thead> 
          <tbody> 
           <?php
            $n = $page+1;
            foreach ($datasiswa as $k) {
              echo '
                <tr>
                  <td widtd="5%" class="center">'.$n++.'</td>
                  <td widtd="15%" class="">'.$k['niksiswa'].'</td>
                  <td widtd="30%" colspan="2" class="">'.$k['namasiswa'].'</td> 
                  <td widtd="5%" class="">'.$k['kelamin'].'</td>
                  <td widtd="5%" class="center"><a class="btn btn-xs btn-danger" href="'.base_url().'index.php/datasiswa/rstdatasiswa/'.$k['guidsiswa'].'">Reset</a></td>
                  <td widtd="5%" class="center"><a class="btn btn-xs btn-danger" href="'.base_url().'index.php/datasiswa/deletedatasiswa/'.$k['guidsiswa'].'">Delete</a></td>';  
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

			</div>
			<div class="hr hr2 hr-double"></div>
		</div><!-- /.col -->
	</div><!-- /.row -->
</div>
 

 
 
