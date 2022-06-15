<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('peminjaman') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						<div class="float-right">
							<!-- <a href="<?= base_url('peminjaman/export') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a> -->
							<!-- <a href="<?= base_url('peminjaman/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a> -->
						</div>
					</div>
					<hr>
					<?php if ($this->session->flashdata('success')) : ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<?= $this->session->flashdata('success') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php elseif($this->session->flashdata('error')) : ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<?= $this->session->flashdata('error') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php endif ?>
					<div class="card shadow">
						<div class="card-header"><strong>Data Diri Mahasiswa</strong></div>
						<div class="card-body">
							<?php if ($jumlah_pengguna > 0) { ?>
								<?php foreach ($data_pengguna as $pengguna): ?>
									<div class="form-row">
										<div class="form-group col-4">
											<label>NIM</label>
											<input type="text" class="form-control" value="<?= $pengguna->kode_pengguna ?>" readonly>
										</div>
										<div class="form-group col-4">
											<label>Nama</label>
											<input type="text" class="form-control" value="<?= $pengguna->nama_pengguna ?>" readonly>
										</div>
										<div class="form-group col-4">
											<label>Program Studi</label>
											<input type="text" class="form-control" value="<?= $pengguna->username_pengguna ?>" readonly>
										</div>
									</div>
								<?php endforeach ?>
							<?php } else { ?>
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									Data tidak ditemukan.
								</div>
							<?php } ?>
						</div>				
					</div>
					<br>
					<div class="card shadow">
						<div class="card-header"><strong>Hasil Pengecekan Data Tanggungan Peminjaman</strong></div>
						<div class="card-body">
							<?php if ($jumlah_pengguna > 0) { ?>
								<?php if ($jumlah_tanggungan > 0) { ?>
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										Anda memiliki <strong><?= $jumlah_tanggungan ?> tanggungan peminjaman</strong> yang harus diselesaikan
									</div>
								<?php } else { ?>
									<div class="alert alert-success alert-dismissible fade show" role="alert">
										Anda tidak memiliki tanggungan peminjaman yang harus diselesaikan
									</div>
									<div>
										<a href="<?= base_url('cek/download/'.$kode_pengguna) ?>" class="btn btn-danger"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;SK Bebas Peminjaman</a>
									</div>
								<?php } ?>
							<?php } else { ?>
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									Data tidak ditemukan.
								</div>
							<?php } ?>
						</div>				
					</div>
					<br>
					<div class="card shadow">
						<div class="card-header"><strong>Data Tanggungan Peminjaman</strong></div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<td>NIM</td>
											<td>Nama Mahasiswa</td>
											<td>Dosen</td>
											<td>Waktu Pinjam</td>
											<td>Waktu Kembali</td>
											<td>Status</td>
											<td>Aksi</td>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($all_peminjaman as $peminjaman): ?>
											<?php if ($peminjaman->status == '3' || $peminjaman->status == '2') { ?>
												<tr>
													<td><?= $peminjaman->nim ?></td>
													<td><?= $peminjaman->nama_pengguna ?></td>
													<td><?= $peminjaman->nama_dosen ?></td>
													<td><?= $peminjaman->waktu_pinjam ?></td>
													<td><?= $peminjaman->waktu_kembali ?></td>
													<td>
														<?php
														if ($peminjaman->status == '1') {
															echo "<span class='badge badge-pill badge-info'>Diajukan</span>";
														} else if ($peminjaman->status == '2') {
															date_default_timezone_set("Asia/Bangkok");
															$time = strtotime($peminjaman->waktu_kembali);
															$now = strtotime(date('Y-m-d H:i:s'));
															if ($now >= $time) {
																echo "<span class='badge badge-pill badge-danger'>Overtime</span>";
															} else {
																echo "<span class='badge badge-pill badge-primary'>Diterima</span>";
															}
														} else if ($peminjaman->status == '3') {
															if ($peminjaman->status == '3') {
																echo "<span class='badge badge-pill badge-warning'>Tanggungan</span>";
															}
															else {
																echo "<span class='badge badge-pill badge-success'>Selesai</span>";
															}
														} else if ($peminjaman->status == '4') {
															echo "<span class='badge badge-pill badge-success'>Selesai</span>";
														} else if ($peminjaman->status == '5') {
															echo "<span class='badge badge-pill badge-dark'>Ditolak</span>";
														} 
														?>
													</td>
													<td>
														<a href="<?= base_url('peminjaman/detail/' . $peminjaman->id) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
														<?php if (($peminjaman->status == '1' || $peminjaman->status == '2' || ($peminjaman->status == '3') AND $this->session->login['role'] == 'teknisi')) { ?>
															<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('peminjaman/hapus/' . $peminjaman->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
														<?php } else if ($peminjaman->status == '1' AND $this->session->login['role'] == 'mahasiswa') { ?>
															<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('peminjaman/hapus/' . $peminjaman->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
														<?php } ?>
													</td>
												</tr>
											<?php } ?>
										<?php endforeach ?>
									</tbody>
								</table>
							</div>
						</div>				
					</div>
				</div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>