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
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Responsive Table</h5>
            <div class="card-body">
                <div class="table-responsive ">
                    <table class="table">
                        <thead>
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
                </div>
                <br>
                <?php echo $pagination; ?>
            </div>
        </div> 
    </div>  
    </div>
</div>