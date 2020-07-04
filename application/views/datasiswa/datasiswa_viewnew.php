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
                                        <li class="breadcrumb-item active" aria-current="page">Siswa</li>
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
                    echo '<br><div class="alert alert-'.$msg.'">
                            <button class="close" data-dismiss="alert">
                            <i class="ace-icon fa fa-times"></i>
                            </button>
                            '.$this->session->userdata('message').'
                        </div>';
                }
            ?> 
            <div class="card-body"> 
                <div class="table-responsive ">
                <form method="post" action="<?php echo base_url().'index.php/datasiswa' ?>">
                    <table class="table">
                        <thead>
                        <tr>  
              <td colspan="5" class="center text-left">
                <input type="text" class="form-control btn-xs" name="search" value="<?php echo $search ?>" placeholder='Cari Data'>
              </td>
              <td colspan="2" class="center text-right">
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
                        <th width="15%" class="center text-center">Nomor Induk</th>
                        <th width="30%" colspan="2" class="center text-center">Nama Siswa</th> 
                        <th width="5%" class="center text-center">Jenis Kelamin</th>
                        <th width="5%" class="center text-center">Reset Password</th>  
                        <th width="5%" class="center text-center">Delete</th>  
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n = $page+1;
                            foreach ($datasiswa as $k) {
                            echo '
                                <tr>
                                <td widtd="5%" class="center text-center">'.$n++.'</td>
                                <td widtd="15%" class="">'.$k['niksiswa'].'</td>
                                <td widtd="30%" colspan="2" class="">'.$k['namasiswa'].'</td> 
                                <td widtd="5%" class="text-center">'.$k['kelamin'].'</td>
                                <td widtd="5%" class="center text-center"><a class="btn btn-xs btn-danger" href="'.base_url().'index.php/datasiswa/rstdatasiswa/'.$k['guidsiswa'].'">Reset</a></td>
                                <td widtd="5%" class="center text-center"><a class="btn btn-xs btn-danger" href="'.base_url().'index.php/datasiswa/deletedatasiswa/'.$k['guidsiswa'].'">Delete</a></td>';  
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