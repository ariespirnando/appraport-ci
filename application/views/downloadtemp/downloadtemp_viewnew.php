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
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Upload Raport</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Upload</a></li>  
                                        <li class="breadcrumb-item active" aria-current="page">Template</li>
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
                <form method="post" action="<?php echo base_url().'index.php/datasiswa' ?>">
                    <table class="table">
                        <thead>

                        <tr> 
              <td colspan="6" class="center text-left"><a href='<?php echo $add ?>' class="btn btn-xs btn-warning">Kembali</a></td></tr>
                        

                        <tr> 
              <td colspan="4" class="center text-left">
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
              <th width="15%" class="center text-center">Kode Kelas</th> 
              <th width="15%" class="center text-center">Kode Jurusan</th>  
              <th width="15%" class="center text-center">Kode Dokumen</th> 
              <th width="15%" class="center text-center">Nama Dokumen</th>   
              <th width="15%" class="center text-center">Download</th> 
            </tr> 
                        </thead>
                        <tbody>
                        <?php
            $n = $page+1;
            foreach ($downloadtemp as $k) {
              echo '
                <tr>
                  <td widtd="5%" class="center text-center">'.$n++.'</td>
                  <td widtd="5%" class="text-center">'.$k['kodekelas'].'</td>
                  <td widtd="5%" class="text-center">'.$k['kodejuruan'].'</td>
                  <td widtd="15%" class="">'.$k['namadok'].'</td>
                  <td widtd="15%" class="">'.$k['pathdownload'].'</td>';;
                  
                  if($k['pathdownload']==""){
                    echo '<td widtd="15%" class="">-</td>';
                  }else{
                    $filename = realpath('assets/template/'.$k['pathdownload']);
                    if(file_exists($filename)){ 
                      echo '<td widtd="5%" class="center text-center"><a class="btn btn-xs btn-primary" href="'.base_url().'/assets/template/'.$k['pathdownload'].'">';
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
                </div>
                <br>
                <?php echo $pagination; ?>
            </div>
        </div> 
    </div>  
    </div>
</div>
</div>