<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content ">
            
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Transaksi</h2>
                     <div class="page-breadcrumb">
                     <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Transaksi</a></li> 
                                        <li class="breadcrumb-item active" aria-current="page">Upload Raport</li>
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
                <form method="post" action="<?php echo base_url().'index.php/upload' ?>">
                    <table class="table">
                        <thead>

                        <?php if($this->session->userdata('rule')==1){ ?>
                        <tr>
                        <td colspan="9" class="center text-left">
                        <a href='<?php echo $add ?>' class="btn btn-xs btn-primary">Upload</a>
                        </td>
                        </tr>
                        <?php } ?>


                        <tr> 
              <td colspan="6" class="center text-left">
                <input type="text" class="form-control btn-xs" name="search" value="<?php echo $search ?>" placeholder='Cari Data'>
              </td>
              <td colspan="3" class="center text-right">
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
                            <th width="10%" class="center text-center">Kelas</th>
                            <th width="10%" class="center text-center">Semester</th>
                            <th width="10%" class="center text-center">Jurusan</th>
                            <th width="10%" class="center text-center">Tahun Ajaran</th> 
                            <th width="20%" class="center text-center">Keterangan</th>   
                            <th width="20%" class="center text-center">Tanggal Raport</th>
                            <th width="16%" colspan='2' class="center text-center">Opsi</th> 
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $n = $page+1;
                            foreach ($upload as $k) {
                            echo '
                                <tr>
                                <td widtd="5%" class="center text-center">'.$n++.'</td>
                                <td widtd="15%" class="text-center">'.$k['namakelas'].'</td>
                                <td widtd="15%" class="text-center">'.$k['semester'].'</td>
                                <td widtd="15%" class="text-center">'.$k['kodejuruan'].'</td> 
                                <td widtd="15%" class="text-center">'.$k['tahunajaran'].'</td> 
                                <td widtd="20%" class="">'.$k['keterangan'].'</td>
                                <td widtd="15%" class="center text-center">'.$k['tanggal_raport'].'</td>';
                                    echo '<td widtd="8%" class="center"><a class="btn btn-xs btn-primary" href="'.base_url().'index.php/upload/edittgl_upload/'.$k['guidupload'].'">';
                                    echo '<i class="ace-icon fa fa-edit bigger-120"></i></a></td>';
                                if($this->session->userdata('rule')==1){
                                    echo '<td widtd="8%" class="cente text-centerr"><a class="btn btn-xs btn-danger" href="'.base_url().'index.php/upload/hapus_upload/'.$k['guidupload'].'">';
                                    echo '<i class="ace-icon fa fa-trash bigger-120"></i></a></td>';
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