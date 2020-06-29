 
<body style="background-color: #FFFFFF;">  
</div>
    <table class="tablettdhd" width='100%' style='margin-right:70px;'> 
        <tr> 
            <th width='10%' rowspan='6'>
            <img src="<?php echo base_url() ?>/assets/images/logo.png" style='width: 100px;'>

        </th>
            <th class='tthd'width='90%'>PEMERINTAH DAERAH PROVINSI JAWA BARAT</th> 
        </tr> 
        <tr> 
            <th class='tthdS'><b>DINAS PENDIDIKAN</b></th> 
        </tr> 
        <tr> 
            <th class='tthdS'><b>SMA NEGERI 2 KOTA BEKASI</b></th> 
        </tr>
        <tr> 
            <td class='tthdSm' style="text-align: center; vertical-align: middle;"><i>Jl. Tangkuban Perahu No.1 Perumnas II Kayuringin Jaya Bekasi Selatan Telp. (021) 8843280</i></td> 
        </tr>    
        <tr> 
            <td style="text-align: center; vertical-align: middle;" class='tthdSm'>Faximile: (021) 88853753 website: <b><u>http://www.sman2-bks.sch.id</u></b>  e-mail: <b><u>info@sman2-bks.sch.id</u></b></td> 
        </tr>
        <tr> 
            <td style="text-align: center; vertical-align: middle;" class='tthd'>KOTA BEKASI - 17144</td> 
        </tr>     
    </table>
    <hr class="style2"> 
    <br> 
    <table class="tablettdhd" width='100%'>
		<tr>
            <th class='tthd' width='100%'>LAPORAN PENILAIAN AKHIR SEMESTER <?php echo $tipe ?></th> 
        </tr>  
        <tr>
            <th class='tthd' width='100%'>TAHUN PELAJARAN <?php echo $tahunajaran ?></th> 
        </tr>     
    </table>
    <br>
    <table class="tablettd" width='100%'>
		<tr>
            <td class='tttd' width='13%'>Nama</td>
            <td class='tttd' width='2%'>:</td>
            <td class='tttd' width='33%'><?php echo $namasiswa ?></td> 
            <td class='tttd' width='13%'>Kelas</td>
            <td class='tttd' width='2%'>:</td> 
            <td class='tttd' width='33%'><?php echo $namakelas ?></td>  
        </tr>  
        <tr>
            <td class='tttd' width='13%'>No Induk</td>
            <td class='tttd' width='2%'>:</td>
            <td class='tttd' width='33%'><?php echo $niksiswa ?></td> 
            <td class='tttd' width='13%'>Semester</td>
            <td class='tttd' width='2%'>:</td> 
            <td class='tttd' width='33%'><?php echo $semester ?></td>  
        </tr>  
    </table>
    <br>
	<table class="table1" width='100%'>
		<tr>
			<th class='borderth' width='6%'  rowspan='2'>No</th>
			<th class='borderth' width='18%' rowspan='2'>Mata Pelajaran</th>
			<th class='borderth' width='8%'  rowspan='2'>KKM</th>
			<th class='borderth' width='18%' colspan='2'>Pengetahuan</th>
            <th class='borderth' width='18%' colspan='2'>Keterampilan</th>
            <th class='borderth' width='13%' rowspan='2'>Keterangan</th>
            <th class='borderth' width='10%' rowspan='2'>Sikap</th>
		</tr>
        <tr>
			<th class='borderth' width='7%'>Nilai</th>
			<th class='borderth' width='11%'>Predikat</th>
            <th class='borderth' width='7%'>Nilai</th>
			<th class='borderth' width='11%'>Predikat</th> 
		</tr> 
        <tr>
            <td  class='bordertd' colspan='9'><b>Kelompok A (Umum)</b></td>
        </tr>

        <?php 
            $ini = 1;
            $index = 0;
            foreach($kela as $ka){
                ?>
                    <tr>
                        <th class='borderth'><?php echo $ini ?></th>
                        <td class='bordertd'><?php echo $ka['namapelajaran'] ?></td> 
                        <td class='bordertd' style="text-align: center; vertical-align: middle;"><?php echo $ka['kkm'] ?></td> 
                        <?php 
                            for($i=0;$i<6;$i++){ 
                                 echo "<td class='bordertd' style='text-align: center; vertical-align: middle;'>".$nilaia[$index][$ka['kodepelajaran']][$i]['nilai']."</td>"; 
                            }
                        ?> 
                    </tr>
                <?php
                $index++;
                $ini++;
            }
        ?>
         
        <tr>
            <td class='bordertd' colspan='9'><b>Kelompok B (Umum)</b></td>
        </tr>
        <?php 
            $ini = 1;
            $index = 0;
            foreach($kelb as $ka){
                ?>
                    <tr>
                        <th class='borderth'><?php echo $ini ?></th>
                        <td class='bordertd'><?php echo $ka['namapelajaran'] ?></td> 
                        <td class='bordertd' style="text-align: center; vertical-align: middle;"><?php echo $ka['kkm'] ?></td> 
                        <?php 
                            for($i=0;$i<6;$i++){ 
                                 echo "<td class='bordertd' style='text-align: center; vertical-align: middle;'>".$nilaib[$index][$ka['kodepelajaran']][$i]['nilai']."</td>"; 
                            }
                        ?> 
                    </tr>
                <?php
                $index++;
                $ini++;
            }
        ?>
 
        <tr>
            <td class='bordertd' colspan='9'><b>Kelompok C (Minat)</b></td>
        </tr>
        <?php 
            $ini = 1;
            $index = 0;
            foreach($kelc as $ka){
                ?>
                    <tr>
                        <th class='borderth'><?php echo $ini ?></th>
                        <td class='bordertd'><?php echo $ka['namapelajaran'] ?></td> 
                        <td class='bordertd' style="text-align: center; vertical-align: middle;"><?php echo $ka['kkm'] ?></td> 
                        <?php 
                            for($i=0;$i<6;$i++){ 
                                 echo "<td class='bordertd' style='text-align: center; vertical-align: middle;'>".$nilaic[$index][$ka['kodepelajaran']][$i]['nilai']."</td>"; 
                            }
                        ?> 
                    </tr>
                <?php
                $index++;
                $ini++;
            }
        ?>
         
        <tr>
            <td class='bordertd' colspan='9'><b>Kelompok D ( Lintas Minat)</b></td>
        </tr>
        <?php 
            $ini = 1;
            $index = 0;
            foreach($keld as $ka){
                ?>
                    <tr>
                        <th class='borderth'><?php echo $ini ?></th>
                        <td class='bordertd'><?php echo $ka['namapelajaran'] ?></td> 
                        <td class='bordertd' style="text-align: center; vertical-align: middle;"><?php echo $ka['kkm'] ?></td> 
                        <?php 
                            for($i=0;$i<6;$i++){ 
                                 echo "<td class='bordertd' style='text-align: center; vertical-align: middle;'>".$nilaid[$index][$ka['kodepelajaran']][$i]['nilai']."</td>"; 
                            }
                        ?> 
                    </tr>
                <?php
                $index++;
                $ini++;
            }
        ?>
         
        <tr>
            <td class='bordertd' colspan='9'><b>Kelompok E ( Muatan Lokal)</b></td>
        </tr>
        <?php 
            $ini = 1;
            $index = 0;
            foreach($kele as $ka){
                ?>
                    <tr>
                        <th class='borderth'><?php echo $ini ?></th>
                        <td class='bordertd'><?php echo $ka['namapelajaran'] ?></td> 
                        <td class='bordertd' style="text-align: center; vertical-align: middle;"><?php echo $ka['kkm'] ?></td> 
                        <?php 
                            for($i=0;$i<6;$i++){ 
                                 echo "<td class='bordertd' style='text-align: center; vertical-align: middle;'>".$nilaie[$index][$ka['kodepelajaran']][$i]['nilai']."</td>"; 
                            }
                        ?> 
                    </tr>
                <?php
                $index++;
                $ini++;
            }
        ?>
         
	</table>	
    <br>
    <table class="table1" width='100%'>
		<tr>
			<td class='bordertd' width='30%' ><b>Pramuka</b></td>
			<td class='bordertd' width='70%' ><?php echo $nilaikegiatanwajib ?></td> 
		</tr>
        <?php if($kegiatanextra!='' && $kegiatanextra != '...' && $kegiatanextra != '---'){ ?>
            <tr>
                <td class='bordertd' width='30%' ><b><?php echo $kegiatanextra ?></b></td>
                <td class='bordertd' width='70%' ><?php echo $nilaikegiatan ?></td> 
            </tr>
        <?php } ?>
    </table>
    <br>
    <table class="table1" width='100%'>
        <tr>
			<td class='bordertd' width='30%' ><b>Keterangan</b></td>
			<td class='bordertd' width='70%' ><b><?php echo $statuskenaikan ?></b></td> 
		</tr> 
    </table>
    <br>
    <table class="table1" width='100%'>
        <tr>
			<td class='bordertd' width='100%' >Catatan Wali Kelas :<br><br><hr class="new3"></td> 
		</tr> 
    </table> 
    <br>
    <table class="tablettd" width='100%'>
		<tr>
			<th class='tttd' width='33%'></th>
			<th class='tttd' width='33%'></th> 
            <th class='tttd' width='33%'>Bekasi, <?php echo $tanggalsekarang ?></th> 
        </tr> 
        <tr>
			<td class='tttd' width='33%'>Orang Tua / Wali Siswa</td>
			<td class='tttd' width='33%'>Wali Kelas</td> 
            <td class='tttd' width='33%'>Kepala Sekolah</th> 
        </tr>
        <tr>
			<td class='tttd' width='33%'></td>
			<td class='tttd' width='33%'><?php if($ttdwalikelas!=1){?>
                                                <img src="<?php echo base_url() ?>/assets/images/ttdwali/<?php echo $ttdwalikelas ?>" style='width: 100px;'>
                                              <?php } ?>
                                    </td> 
            <td class='tttd' width='33%'><?php if($ttdkepsek!=1){?>
                                                <img src="<?php echo base_url() ?>/assets/images/ttdwali/<?php echo $ttdkepsek ?>" style='width: 100px;'>
                                              <?php } ?>
                                            </td> 
        </tr> 
        <tr>
			<td class='tttd' width='33%'>( . . . . . . . . . . . . . . . . . . . . . . )</td>
			<td class='tttd' width='33%'><?php echo $namawalikelas ?></td> 
            <td class='tttd' width='33%'><?php echo $namakepsek ?></th> 
        </tr> 
        <tr>
			<td class='tttd' width='33%'></td>
			<td class='tttd' width='33%'>NIP. <?php echo $nikwalikelas ?></td> 
            <td class='tttd' width='33%'>NIP. <?php echo $nikkepsek ?></th> 
		</tr> 
    </table>
</body> 

<style>
.chgwhite{
    color:white;
}
.table1 {
    font-family: cambria;
    font-size: 11px;
    color: #232323;
    border-collapse: collapse;
}

.table1 , .borderth, .bordertd {
    border: 1px solid #999;
    padding: 3px 15px;
}
.tablettd {
    font-family: cambria;
    font-size: 11px;
    color: #232323;
    border-collapse: collapse;
}
.tablettd , .tttd{ 
    padding: 2px 10px;
}
.tablettdhd {
    font-family: cambria;
    font-size: 13px;
    color: #232323;
    border-collapse: collapse;
}
.tablettdhd , .tthd{ 
    padding: 2px 10px;
}
.tthdS{
    padding: 2px 10px;
    font-family: cambria;
    font-size: 16px;
}
.tthdSm{
    padding: 2px 10px;
    font-family: cambria;
    font-size: 11px;
}
hr.new3 {
  border-top: 1px dotted black !important;
}
hr.style2 {
    height:3px;
	color:black;
}

@page {
    margin: 1.75cm 1cm 1cm 1.75cm !important;
    padding: 0px 0px 0px 0px !important;
    size: auto;
}
.center {
  margin: auto; 
  text-align: center;
}
</style>