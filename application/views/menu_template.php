<ul class="nav nav-list">
	<?php
	$class = '';
	if($modul=='Home'){
		$class = 'active open';
	}
	?>
	<li class="<?php echo $class ?>">
		<a href="<?php echo base_url()?>index.php/home">
			<i class="menu-icon fa fa-home"></i>
			<span class="menu-text"> Home </span>
		</a>

		<b class="arrow"></b>
	</li>
<?php if($this->session->userdata('rule')==1){ ?> 
	<?php
	$class = '';
	if($modul=='Transaksi'){
		$class = 'active open';
	}
	?>
	 <li class="<?php echo $class ?>">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-desktop"></i>
			<span class="menu-text">
				Transaksi
			</span>
			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
			<li class="">
				<a href="<?php echo base_url()?>index.php/upload">
					<i class="menu-icon fa fa-caret-right"></i>
					Upload Raport
				</a> 
				<b class="arrow"></b>
			</li> 
		</ul>
	</li>
<?php }?>
	<?php
	$class = '';
	if($modul=='Raport'){
		$class = 'active open';
	}
	?>

	<li class="<?php echo $class ?>">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-file"></i>
			<span class="menu-text">
				Raport
			</span>
			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu"> 
			<li class="">
				<a href="<?php echo base_url()?>index.php/raportsiswa">
					<i class="menu-icon fa fa-caret-right"></i>
					<?php 
						if($this->session->userdata('rule')==1){ 
							echo 'Raport Siswa';
						}else{
							echo 'Download Raport';
						}
					?>  
				</a> 
				<b class="arrow"></b>
			</li>  
		</ul>
	</li>
<?php if($this->session->userdata('rule')==1){ ?> 
	<?php
	$class = '';
	if($modul=='Master'){
		$class = 'active open';
	}
	?>

	 <li class="<?php echo $class ?>">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-list"></i>
			<span class="menu-text">
				Master
			</span>
			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu"> 
			<li class="">
				<a href="<?php echo base_url()?>index.php/datasiswa">
					<i class="menu-icon fa fa-caret-right"></i>
					Data Siswa
				</a> 
				<b class="arrow"></b>
			</li> 
			<li class="">
				<a href="<?php echo base_url()?>index.php/datakelas">
					<i class="menu-icon fa fa-caret-right"></i>
					Data Kelas
				</a> 
				<b class="arrow"></b>
			</li> 
			<li class="">
				<a href="<?php echo base_url()?>index.php/datasemester">
					<i class="menu-icon fa fa-caret-right"></i>
					Data Semester
				</a> 
				<b class="arrow"></b>
			</li>
			<li class="">
				<a href="<?php echo base_url()?>index.php/datakepsek">
					<i class="menu-icon fa fa-caret-right"></i>
					Data Kepala Sekolah
				</a> 
				<b class="arrow"></b>
			</li>     
		</ul>
	</li>
<?php }?>


	<?php
	$class = '';
	if($modul=='Pengaturan'){
		$class = 'active open';
	}
	?>

	<li class="<?php echo $class ?>">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-gear"></i>
			<span class="menu-text">
				Pengaturan
			</span>
			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">  
			<li class="">
				<a href="<?php echo base_url().'index.php/pengguna/ganti_pwpengguna'?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Ubah Password
				</a> 
				<b class="arrow"></b>
			</li>  
  
			<li class="">
				<a href="<?php echo base_url().'index.php/login/logout'?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Keluar Sistem
				</a> 
				<b class="arrow"></b>
			</li>  
		</ul> 
	</li> 
</ul><!-- /.nav-list -->
