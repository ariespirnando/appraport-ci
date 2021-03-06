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
                                        <li class="breadcrumb-item active" aria-current="page">Kepala Sekolah</li>
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
                <div class="table-responsive ">
                <form method="post" action="<?php echo base_url().'index.php/datakepsek' ?>">
                    <table class="table">
                        <thead>

                        <tr> 
                          <td colspan="4" class="center text-left">
                            <input type="text" class="form-control btn-xs" name="search" value="<?php echo $search ?>" placeholder='Cari Data'>
                          </td>
                          <td colspan="1" class="center text-right">
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
                        <th width="5%" class="center text-center">No</th>
                        <th width="15%" class="center text-center">Nama Kepala Sekolah</th> 
                        <th width="15%" class="center text-center">NIK Walikepala sekolah</th>  
                        <th width="15%" class="center text-center">TTD Walikepala sekolah</th>   
                        <th width="16%" class="center text-center">Opsi</th> 
                        </tr>
                        </thead>
                        <tbody>
                        <?php
            $n = $page+1;
            foreach ($datakepsek as $k) {
              echo '
                <tr>
                  <td widtd="5%" class="center text-center">'.$n++.'</td>
                  <td widtd="15%" class="">'.$k['namakepsek'].'</td>
                  <td widtd="15%" class="">'.$k['nikkepsek'].'</td>';
                  if($k['ttdkepsek']==""){
                    echo '<td widtd="15%" class="">-</td>';
                  }else{
                    $filename = realpath('assets/images/ttdwali/'.$k['ttdkepsek']);
                    if(file_exists($filename)){ 
                      echo '<td class="center text-center" widtd="15%" class=""><img src="'.base_url().'/assets/images/ttdwali/'.$k['ttdkepsek'].'" style="width: 50px;"></td>';
                    }else{
                      echo '<td widtd="15%" class="">-</td>';
                    }
                  } 
                  if($this->session->userdata('rule')==1){
                    echo'<td widtd="8%" class="center text-center">'; 
                    echo '<a class="btn btn-xs btn-warning" href="'.base_url().'index.php/datakepsek/edit_datakepsek/'.$k['guidkepsek'].'">';
                    echo '<i class="ace-icon fa fa-edit bigger-120"></i>';
                    echo '</a></td>'; 
                  }else{
                    echo '<td>-</td>'; 
                  } 
                echo '</tr>';
            }
           ?>
                        </tbody>
                    </table>
                    </form>
                </div>
                <br>
                <?php echo $pagination; ?>
            </div>
        </div> 
    </div>  
    </div>
</div>
</div>