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
							<!-- <a href="#" class="btn btn-danger btn-sm dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a>
 -->							<!-- Dropdown - User Information -->
							<!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#filterModal">Filter</a>
								<a class="dropdown-item" href="<?= base_url('peminjaman/export_rekap') ?>">Semua</a>
							</div> -->
							<a href="<?= base_url('peminjaman/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
						</div>
						<!-- <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<form action="<?= base_url('peminjaman/export_rekap_filter') ?>" id="form-filter" method="POST">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Filter Rekap Peminjaman</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="row">
												<div class="col-6">
													<div class="form-group">
														<label for="message-text" class="col-form-label">Tanggal Awal</label>
														<input type="date" name="tanggal_awal" value="" placeholder="Mulai" class="form-control">
													</div>
												</div>
												<div class="col-6">
													<div class="form-group">
														<label for="message-text" class="col-form-label">Tanggal Akhir</label>
														<input type="date" name="tanggal_akhir" value="" placeholder="Akhir" class="form-control">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-6">
													<div class="form-group">
														<label for="message-text" class="col-form-label">Kelas</label>
														<select name="kelas" id="kelas" class="form-control">
															<option selected disabled>Pilih Kelas</option>
															<?php foreach ($all_kelas as $kelas): ?>
																<option value="<?= $kelas->kelas ?>"><?= $kelas->kelas?></option>
															<?php endforeach ?>
														</select>
													</div>
												</div>
												<div class="col-6">
													<div class="form-group">
														<label for="message-text" class="col-form-label">Semester</label>
														<select name="semester" id="semester" class="form-control">
															<option selected disabled>Pilih Semester</option>
															<?php 
															for ($i=1; $i <= 8; $i++) { 
																?>
																<option value="<?= $i ?>">Semester <?= $i ?></option>
																<?php
															}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-6">
													<div class="form-group">
														<label for="message-text" class="col-form-label">Dosen</label>
														<select name="id_dosen" id="id_dosen" class="form-control">
															<option selected disabled>Pilih Dosen</option>
															<?php foreach ($all_dosen as $dosen): ?>
																<option value="<?= $dosen->id ?>"><?= $dosen->nama_dosen ?></option>
															<?php endforeach ?>
														</select>
													</div>
												</div>
												<div class="col-6">
													<div class="form-group">
														<label for="message-text" class="col-form-label">Mata Kuliah</label>
														<select name="id_mk" id="id_mk" class="form-control">
															<option selected disabled>Pilih Mata Kuliah</option>
															<?php foreach ($all_mk as $mk): ?>
																<option value="<?= $mk->id ?>"><?= $mk->nama_mk ?></option>
															<?php endforeach ?>
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-12">
													<div class="form-group">
														<label for="message-text" class="col-form-label">Mahasiswa</label>
														<select name="id_pengguna" id="id_pengguna" class="form-control">
															<option selected disabled>Pilih Mahasiswa</option>
															<?php foreach ($all_pengguna as $pengguna): ?>
																<option value="<?= $pengguna->id ?>"><?= $pengguna->kode_pengguna.' - '.$pengguna->nama_pengguna ?></option>
															<?php endforeach ?>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div> -->
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
						<div class="card-header"><strong>Tanggungan Peminjaman Barang</strong></div>
						<div class="card-body">
							<div class="table-responsive">
								<form action="<?= base_url('peminjaman/filterTanggungan') ?>" id="form-filter" method="POST">
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
											<td>Program Studi</td>
											<!-- <td>Kelas</td> -->
											<!-- <td>Semester</td> -->
											<!-- <td>Mata Kuliah</td> -->
											<!-- <td>Dosen</td> -->
											<td>Waktu Pinjam</td>
											<td>Waktu Kembali</td>
											<td>Kode Barang</td>
											<td>Barang</td>
											<td>Jumlah</td>
											<td>Status</td>
											<td>Keterangan</td>
											<td>Aksi</td>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($all_peminjaman as $peminjaman): ?>
											<?php if ($peminjaman->status == '3' AND $peminjaman->keterangan != NULL) { ?>
											<tr>
												<td><?= $peminjaman->nim ?></td>
												<td><?= $peminjaman->nama_pengguna ?></td>
												<td><?= $peminjaman->username_pengguna ?></td>
												<!-- <td><?= $peminjaman->kelas ?></td> -->
												<!-- <td><?= $peminjaman->semester ?></td> -->
												<!-- <td><?= $peminjaman->nama_mk ?></td> -->
												<!-- <td><?= $peminjaman->nama_dosen ?></td> -->
												<td><?= $peminjaman->waktu_pinjam ?></td>
												<td><?= $peminjaman->waktu_kembali ?></td>
												<td><?= $peminjaman->kode_barang ?></td>
												<td><?= $peminjaman->nama_barang ?></td>
												<td><?= $peminjaman->jumlah ?></td>
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
													if ($peminjaman->status == '3' AND $peminjaman->keterangan != NULL) {
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
											<?php if ($peminjaman->status == '3') { ?>
												<td><?= $peminjaman->keterangan ?></td>
											<?php } else { ?>
												<td></td>
											<?php } ?>
											<td>
												<a href="<?= base_url('peminjaman/selesai/'.$peminjaman->id.'/4/'.$peminjaman->status) ?>" class="btn btn-success">Selesai</a>
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