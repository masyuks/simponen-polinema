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
		<img src="<?=base_url()?>assets/img/kan-logo.jpg" style="width: 85px; margin-left: 80%;">
		<div class="col-8 text-center" style="margin-top: -90px; margin-left: 170px;">
			<span style="font-family: serif; color: black;">
				<strong>KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN <br> POLITEKNIK NEGERI MALANG </strong> <br> Jalan Soekarno-Hatta No.9 Malang 65141 <br>
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
		<br>
		<span style="font-family: serif; color: black; font-size: 15px;">
			<b>Periode :</b> <?php if (isset($periode)) { echo $periode; } else { echo 'Semua Transaksi Peminjaman'; } ?>
		</span>
		<br> 
		<br>
		<table style="font-family: serif; color: black; text-align: center;" border="1" width="98%">
			<thead>
				<tr>
					<th>NIM</th>
					<th>Nama Mahasiswa</th>
					<th>Program Studi</th>
					<th>Kelas</th>
					<th>Semester</th>
					<th>Mata Kuliah</th>
					<th>Dosen</th>
					<th>Waktu Pinjam</th>
					<th>Waktu Kembali</th>
					<th>Kode Barang</th>
					<th>Barang</th>
					<th>Jumlah</th>
					<th>Status</th>
					<th>Keterangan</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				if ($all_peminjaman != NULL) {
					foreach ($all_peminjaman as $peminjaman): ?>
						<tr>
							<td><?= $peminjaman->nim ?></td>
							<td><?= $peminjaman->nama_pengguna ?></td>
							<td><?= $peminjaman->username_pengguna ?></td>
							<td><?= $peminjaman->kelas ?></td>
							<td><?= $peminjaman->semester ?></td>
							<td><?= $peminjaman->nama_mk ?></td>
							<td><?= $peminjaman->nama_dosen ?></td>
							<td><?= $peminjaman->waktu_pinjam ?></td>
							<td><?= $peminjaman->waktu_kembali ?></td>
							<td><?= $peminjaman->kode_barang ?></td>
							<td><?= $peminjaman->nama_barang ?></td>
							<td><?= $peminjaman->jumlah ?></td>
							<td><?php
							if ($peminjaman->status == '1') {
								echo "Diajukan";
							} else if ($peminjaman->status == '2') {
								echo "Diterima";
							} else if ($peminjaman->status == '3') {
								if ($peminjaman->status == '3' AND $peminjaman->keterangan != NULL) {
									echo "Tanggungan";
								}
								else {
									echo "Selesai";
								}
							} else if ($peminjaman->status == '4') {
								echo "Selesai";
							} else if ($peminjaman->status == '5') {
								echo "Ditolak";
							} 
							?>
						</td>
						<td><?= $peminjaman->keterangan ?></td>
					</tr>
				<?php endforeach ?>
			<?php } else { ?>
				<tr>
					<td>&nbsp;</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<br><br>
<span style="font-family: serif; color: black; font-size: 15px; margin-left: 70%;">
	Penanggung Jawab
</span>
<br><br><br><br>
<span style="font-family: serif; color: black; font-size: 15px; margin-left: 70%;">
	<?php echo $this->session->login['nama']; ?>
</span>
<script src="<?= base_url('sb-admin') ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('sb-admin') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('sb-admin') ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url('sb-admin') ?>/js/sb-admin-2.min.js"></script>
</body>
</html>