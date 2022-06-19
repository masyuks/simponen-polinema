<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<link href="<?= base_url('sb-admin') ?>/css/sb-admin-2.min.css" rel="stylesheet">
	<!-- Favicon-->
	<link rel="shortcut icon" href="<?=base_url()?>assets/img/polinema-loss.png">
</head>
<body>
	<div class="row">
		<br>
		<img src="<?=base_url()?>assets/img/polinema-loss.png" style="width: 80px; margin-left: 3%;">
		<img src="<?=base_url()?>assets/img/kan-logo.jpg" style="width: 85px; margin-left: 71%;">
		<div class="col-8 text-center" style="margin-top: -110px; margin-left: 100px;">
			<span style="font-family: serif; color: black;">
				<strong>KEMENTERIAN RISET, TEKNOLOGI, <br> DAN PENDIDIKAN TINGGI <br> POLITEKNIK NEGERI MALANG </strong> <br> Jalan Soekarno-Hatta No.9 Malang 65141 <br>
				Telp (0341) 404424-404425 Fax (0341) 404420
			</span>
		</div>
	</div>
	<hr style="border-top: 2px solid black;">
	<div class="row" style="margin-left: 5px;">
		<span style="font-family: serif; color: black; font-weight: bold; font-size: 20px;">
			<center>
				<?= $title; ?>
			</center>
		</span>
		<span style="font-family: serif; color: black; font-size: 15px;">
			Yang berdata diri dibawah ini :
		</span>
		<br>
		<div class="row">
			<div class="col-md-4">
				<table style="color: black; text-align: left; font-family: serif;">
					<?php foreach ($data_pengguna as $pengguna): ?>
						<tr>
							<td>Nama</td>
							<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
							<td><?= $pengguna->nama_pengguna ?></td>
						</tr>
						<tr>
							<td>NIM</td>
							<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
							<td><?= $pengguna->kode_pengguna ?></td>
						</tr>
						<tr>
							<td>Program Studi</td>
							<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
							<td><?= $pengguna->username_pengguna ?></td>
						</tr>
						<tr>
							<td>Jurusan</td>
							<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
							<td><?= $pengguna->jurusan_pengguna ?></td>
						</tr>
					<?php endforeach ?>
				</table>
			</div>
		</div>
		<br>
		<span style="font-family: serif; color: black; font-size: 15px;">
			Dengan ini menyatakan bahwa mahasiswa dengan data diri tersebut dinyatakan telah terbebas dari tanggungan peminjaman
			alat dan komponen pada Laboratorium Gedung AI Politeknik Negeri Malang dengan rekap data peminjaman sebagai berikut :
		</span>
		<br>
		<br>
		<table style="font-family: serif; color: black; text-align: center;" border="1" width="97%">
			<thead>
				<tr>
					<th>Periode</th>
					<th>Jumlah Peminjaman</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				for ($i=1; $i <= 8; $i++) { 
					$semester[$i] = 0;
				}
				foreach ($all_peminjaman as $peminjaman) {
					if ($peminjaman->status == 4) {
						for ($i=1; $i <= 8; $i++) { 
							if ($peminjaman->semester == $i) {
								$semester[$i]++;
							}
						} 
					}
				}
				for ($i=1; $i <= 8; $i++) { 
					?>
					<tr>
						<td>Semester <?= $i ?></td>
						<td><?= $semester[$i] ?> Peminjaman Selesai</td>

					</tr>
				<?php } ?>
			</tbody>
		</table>
		<br>
		<span style="font-family: serif; color: black; font-size: 15px;">
			Demikian Surat Pernyataan ini dibuat untuk dapat digunakan sebagaimana mestinya. 
		</span>
	</div>
	<br><br>
	<span style="font-family: serif; color: black; font-size: 15px; margin-left: 70%;">
		<?php 
		date_default_timezone_set("Asia/Bangkok");
		$year = date('Y');
		$day = date('d');
		$month = date('m');
		if ($month == '1') {
			$name_month = 'Januari';
		}
		if ($month == '2') {
			$name_month = 'Februari';
		}
		if ($month == '3') {
			$name_month = 'Maret';
		}
		if ($month == '4') {
			$name_month = 'April';
		}
		if ($month == '5') {
			$name_month = 'Mei';
		}
		if ($month == '6') {
			$name_month = 'Juni';
		}
		if ($month == '7') {
			$name_month = 'Juli';
		}
		if ($month == '8') {
			$name_month = 'Agustus';
		}
		if ($month == '9') {
			$name_month = 'September';
		}
		if ($month == '10') {
			$name_month = 'Oktober';
		}
		if ($month == '11') {
			$name_month = 'November';
		}
		if ($month == '12') {
			$name_month = 'Desember';
		} 
		?>
		Malang, <?php echo $day.' '.$name_month.' '.$year; ?>
	</span>
	<br>
	<span style="font-family: serif; color: black; font-size: 15px; margin-left: 70%;">
		Mengetahui,
	</span>
	<br>
	<span style="font-family: serif; color: black; font-size: 15px; margin-left: 70%;">
		Kepala Laboratorium,
	</span>
	<br><br><br><br>
	<span style="font-family: serif; color: black; font-size: 15px; margin-left: 70%;">
		Usman Z., ST.
	</span>
	<script src="<?= base_url('sb-admin') ?>/vendor/jquery/jquery.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/js/sb-admin-2.min.js"></script>
</body>
</html>