<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<link href="<?= base_url('sb-admin') ?>/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
	<div class="row">
		<div class="col text-center">
			<h3 class="h3 text-dark"><?= $title ?></h3>
			<!-- <h4 class="h4 text-dark "><strong><?= $perusahaan->nama_perusahaan ?></strong></h4> -->
		</div>
	</div>
	<hr>
	<div class="row">
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<td>NIM</td>
					<td>Nama Mahasiswa</td>
					<td>Dosen</td>
					<td>Waktu Pinjam</td>
					<td>Waktu Kembali</td>
					<td>Kode Barang</td>
					<td>Barang</td>
					<td>Jumlah</td>
					<td>Status</td>
					<td>Keterangan</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($all_peminjaman as $peminjaman): ?>
					<tr>
						<td><?= $peminjaman->nim ?></td>
						<td><?= $peminjaman->nama_pengguna ?></td>
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
							echo "Tanggungan";
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
		</tbody>
	</table>
</div>
</body>
</html>