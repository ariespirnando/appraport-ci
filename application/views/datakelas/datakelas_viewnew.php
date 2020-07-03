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
                                        <li class="breadcrumb-item active" aria-current="page">Kelas</li>
                                    </ol>
                                </nav>
                            </div>
                    </div>
                </div>
            </div>
        </div>  
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Responsive Table</h5>
            <div class="card-body">
                <div class="table-responsive ">
                    <table class="table">
                        <thead>
                        <tr>
                        <th width="5%" class="center">No</th>
              <th width="15%" class="center">Nama Kelas</th>
              <th width="15%" class="center">Peminatan</th> 
              <th width="15%" class="center">Kode Kelas</th>   
              <th width="15%" class="center">NIK Walikelas</th> 
              <th width="30%" class="center">Nama Walikelas</th> 
              <th width="15%" class="center">TTD Walikelas</th>   
              <th width="16%" colspan='2' class="center">Opsi</th> 
                            </tr>
                        </thead>
                        <tbody>
                        <?php
            $n = $page+1;
            foreach ($datakelas as $k) {
              echo '
                <tr>
                  <td widtd="5%" class="center">'.$n++.'</td>
                  <td widtd="15%" class="">'.$k['namakelas'].'</td>
                  <td widtd="15%" class="">'.$k['kodejuruan'].'</td>
                  <td widtd="15%" class="">'.$k['kodekelas'].'</td>
                  <td widtd="15%" class="">'.$k['nikwalikelas'].'</td>
                  <td widtd="30%" class="">'.$k['namawalikelas'].'</td>';
                  if($k['ttdwalikelas']==""){
                    echo '<td widtd="15%" class="">-</td>';
                  }else{
                    $filename = realpath('assets/images/ttdwali/'.$k['ttdwalikelas']);
                    if(file_exists($filename)){ 
                      echo '<td class="center" widtd="15%" class=""><img src="'.base_url().'/assets/images/ttdwali/'.$k['ttdwalikelas'].'" style="width: 50px;"></td>';
                    }else{
                      echo '<td widtd="15%" class="">-</td>';
                    }
                  } 
                  if($this->session->userdata('rule')==1){
                    echo'<td widtd="8%" class="center">'; 
                    echo '<a class="btn btn-xs btn-warning" href="'.base_url().'index.php/datakelas/edit_datakelas/'.$k['guidkelas'].'">';
                    echo '<i class="ace-icon fa fa-edit bigger-120"></i>';
                    echo '</a></td>';
                    echo '<td widtd="8%" class="center"><a class="btn btn-xs btn-danger" href="'.base_url().'index.php/datakelas/hapus_datakelas/'.$k['guidkelas'].'">';
                    echo '<i class="ace-icon fa fa-trash bigger-120"></i></td>';
                  }else{
                    echo '<td>-</td>';
                    echo '<td>-</td>';
                  } 
                echo '</tr>';
            }
           ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <?php echo $pagination; ?>
            </div>
        </div> 
    </div>  
    </div>
</div>