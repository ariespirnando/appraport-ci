<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<div class="clearfix">
        <div class="page-header">
        <h1>
						Transaksi
						<small>
							<i class="ace-icon fa fa-angle-double-right"></i>
							Download Template
						</small>
					</h1>
				</div>

        <?php if($this->session->userdata('rule')==1){ ?>
				<div class="pull-right"><a href='<?php echo $add ?>' class="btn btn-xs btn-warning">Kembali</a></div>
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
        <form method="post" action="<?php echo base_url().'index.php/downloadtemp' ?>">
        <table id="table" class="table table-striped table-bordered table-hover" width="90%">
          <thead>
            <tr> 
              <td colspan="4" class="center">
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
              <th width="15%" class="center">Kode Kelas</th> 
              <th width="15%" class="center">Kode Jurusan</th>  
              <th width="15%" class="center">Kode Dokumen</th> 
              <th width="15%" class="center">Nama Dokumen</th>   
              <th width="15%" class="center">Download</th> 
            </tr> 
          </thead> 
          <tbody> 
           <?php
            $n = $page+1;
            foreach ($downloadtemp as $k) {
              echo '
                <tr>
                  <td widtd="5%" class="center">'.$n++.'</td>
                  <td widtd="5%" class="">'.$k['kodekelas'].'</td>
                  <td widtd="5%" class="">'.$k['kodejuruan'].'</td>
                  <td widtd="15%" class="">'.$k['namadok'].'</td>
                  <td widtd="15%" class="">'.$k['pathdownload'].'</td>';;
                  
                  if($k['pathdownload']==""){
                    echo '<td widtd="15%" class="">-</td>';
                  }else{
                    $filename = realpath('assets/template/'.$k['pathdownload']);
                    if(file_exists($filename)){ 
                      echo '<td widtd="5%" class="center"><a class="btn btn-xs btn-primary" href="'.base_url().'/assets/template/'.$k['pathdownload'].'">';
                      echo '<i class="ace-icon fa fa-download bigger-120"></i></a></td>';
                     }else{
                      echo '<td widtd="15%" class="">-</td>';
                    }
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

 
 
