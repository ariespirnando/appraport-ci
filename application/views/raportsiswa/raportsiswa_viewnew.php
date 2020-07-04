<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content ">
            
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Raport</h2>
                     <div class="page-breadcrumb">
                     <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Raport</a></li> 
                                        <li class="breadcrumb-item active" aria-current="page">Raport Siswa</li>
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
                <form method="post" action="<?php echo base_url().'index.php/raportsiswa' ?>">
                    <table class="table">
                        <thead>
                        <tr>  
                        <td colspan="7" class="center text-left">
                            <input type="text" class="form-control btn-xs" name="search" value="<?php echo $search ?>" placeholder='Cari Data'>
                        </td>
                        <?php if($rule==1){ ?>
                        <td colspan="3" class="center text-right">
                        <?php }else{ ?>
                        <td colspan="3" class="center text-right">
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
                            <th width="3%" class="center text-center">No</th>
                            <th width="10%" class="center text-center">Nomor Induk</th>
                            <th width="25%" class="center text-center">Nama Siswa</th> 
                            <th width="3%" class="center text-center">Jenis Kelamin</th>  
                            <th width="15%" class="center text-center">Kelas & Semester</th> 
                            <th width="5%" class="center text-center">Tahun Ajaran</th>  
                            <th width="5%" class="center text-center">Peminatan</th> 
                            <?php if($rule==1){ ?>
                            <th width="5%" class="center text-center">Status Pembayaran SPP</th> 
                            <?php } ?>
                            <th width="5%" class="center text-center">Status Kenaikan Kelas</th> 
                            <th width="5%" class="center text-center">Download Raport</th> 
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $n = $page+1;
                            foreach ($raportsiswa as $k) {
                                echo '
                                <tr>
                                    <td widtd="3%" class="center text-center">'.$n++.'</td> 
                                    <td widtd="10%" class="">'.$k['niksiswa'].'</td>
                                    <td widtd="25%" class="">'.$k['namasiswa'].'</td>
                                    <td widtd="3%" class="center text-center">'.$k['kelamin'].'</td>
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
                                    <td widtd="5%" class="center text-center"><a class="btn btn-xs btn-primary" href="'.base_url().'index.php/raportsiswa/download1/'.$k['guidraport'].'">';
                                    echo '<i class="ace-icon fa fa-download bigger-120"></i></a></td>
                                </tr>
                                    ';  
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