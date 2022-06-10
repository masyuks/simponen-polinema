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
							<a href="<?= base_url('peminjaman/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
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
						<div class="card-header"><strong>Daftar peminjaman</strong></div>
						<div class="card-body">
							<div class="table-responsive">
								<form action="<?= base_url('peminjaman/filter') ?>" id="form-filter" method="POST">
									<div class="row">
										<div class="col-5">
											<div class="form-group">
												<div class="row">
													<div class="col-12">
														<label>Tanggal Awal</label>	
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<input type="date" name="tanggal_awal" value="" placeholder="Mulai" class="form-control" required>	
													</div>
												</div>
											</div>
										</div>
										<div class="col-5">
											<div class="form-group">
												<div class="row">
													<div class="col-12">
														<label>Tanggal Akhir</label>
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<input type="date" name="tanggal_akhir" value="" placeholder="Akhir" class="form-control" required>
													</div>
												</div>
											</div>
										</div>
										<div class="col-2">
											<div class="form-group">
												<div class="row">
													<div class="col-12">
														<label>&nbsp;</label>
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<button type="submit" class="btn btn-primary" style="width: 100%;"><i class="fa fa-filter"></i></button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
								<hr>
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
											<tr>
												<td><?= $peminjaman->nim ?></td>
												<td><?= $peminjaman->nama_pengguna ?></td>
												<td><?= $peminjaman->nama_dosen ?></td>
												<td><?= $peminjaman->waktu_pinjam ?></td>
												<td><?= $peminjaman->waktu_kembali ?></td>
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
											<td>
												<a href="<?= base_url('peminjaman/detail/' . $peminjaman->id) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
												<?php if ($peminjaman->status == '1' || $peminjaman->status == '2' || ($peminjaman->status == '3' AND $this->session->login['role'] == 'teknisi')) { ?>
													<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('peminjaman/hapus/' . $peminjaman->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
												<?php } ?>
											</td>
										</tr>
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