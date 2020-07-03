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
            <h5 class="card-header">Responsive Table</h5>
            <div class="card-body">
                <div class="table-responsive ">
                    <table class="table">
                        <thead>
                        <tr>
                            <th width="5%" class="center">No</th>
                            <th width="10%" class="center">Kelas</th>
                            <th width="10%" class="center">Semester</th>
                            <th width="10%" class="center">Jurusan</th>
                            <th width="10%" class="center">Tahun Ajaran</th> 
                            <th width="20%" class="center">Keterangan</th>   
                            <th width="20%" class="center">Tanggal Raport</th>
                            <th width="16%" colspan='2' class="center" class="center">Opsi</th> 
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
                                    echo '<i class="ace-icon fa fa-trash bigger-120"></i></a></td>';
                                }else{ 
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
</div>