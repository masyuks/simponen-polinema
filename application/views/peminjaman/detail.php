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
							<!-- <a href="<?= base_url('peminjaman/export_detail/' . $peminjaman->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a> -->
							<a href="<?= base_url('peminjaman') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
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
						<div class="card-header"><strong>Detail peminjaman - <?= $peminjaman->id ?></strong></div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<table class="table table-borderless">
										<tr>
											<td><strong>NIM</strong></td>
											<td>:</td>
											<td><?= $peminjaman->nim ?></td>
										</tr>
										<tr>
											<td><strong>Nama Mahasiswa</strong></td>
											<td>:</td>
											<td><?= $peminjaman->nama_pengguna ?></td>
										</tr>
										<tr>
											<td><strong>Waktu Peminjaman</strong></td>
											<td>:</td>
											<td><?= $peminjaman->waktu_pinjam ?></td>
										</tr>
										<tr>
											<td><strong>Waktu Pengembalian</strong></td>
											<td>:</td>
											<td><?= $peminjaman->waktu_kembali ?></td>
										</tr>
										<tr>
											<td><strong>Status</strong></td>
											<td>:</td>
											<td>
												<?php
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
										</tr>
										<?php if ($peminjaman->status == '3') { ?>
											<tr>
												<td><strong>Keterangan</strong></td>
												<td>:</td>
												<td>
													<?= $peminjaman->keterangan ?>
												</td>
											</tr>
										<?php } ?>
									</table>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-12">
									<div class="table-responsive">
										<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
											<thead>
												<tr>
													<td><strong>No</strong></td>
													<td><strong>Nama Barang</strong></td>
													<td><strong>Kode Barang</strong></td>
													<td><strong>Jenis</strong></td>
													<td><strong>Jumlah</strong></td>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($all_detail_peminjaman as $detail_peminjaman): ?>
													<tr>
														<td><?= $no++ ?></td>
														<td><?= $detail_peminjaman->nama_barang ?></td>
														<td><?= $detail_peminjaman->kode_barang ?></td>
														<td><?= $detail_peminjaman->jenis ?></td>
														<td><?= $detail_peminjaman->jumlah ?></td>
													</tr>
												<?php endforeach ?>
											</tbody>
										</table>
									</div>
									<?php if ($this->session->login['role'] == 'teknisi') { ?>
										<?php if ($peminjaman->status == '1') { ?>
											<div style="text-align: center;">
												<a href="<?= base_url('peminjaman/update_status/'.$peminjaman->id.'/2') ?>" class="btn btn-success"><i class="fa fa-check"></i> Setuju</a>
												&nbsp;
												<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('peminjaman/update_status/'.$peminjaman->id.'/5') ?>" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp; Tolak &nbsp;&nbsp;</a>
											</div>
										<?php } ?>
										<?php if ($peminjaman->status == '2') { ?>
											<div style="text-align: center;">
												<a href="<?= base_url('peminjaman/update_status/'.$peminjaman->id.'/4') ?>" class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp; Selesai &nbsp;&nbsp;</a>
												&nbsp;
												<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#tanggunganModal"><i class="fa fa-times"></i> Tanggungan </a>
											</div>
											<div class="modal fade" id="tanggunganModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<form action="<?= base_url('peminjaman/tanggungan') ?>" id="form-filter" method="POST">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">Tanggungan</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																<div class="form-group">
																	<label for="message-text" class="col-form-label">Keterangan Tanggungan:</label>
																	<textarea class="form-control" id="message-text" name="keterangan"></textarea>
																</div>
															</div>
															<input type="hidden" name="status" value="3">
															<input type="hidden" name="id" value="<?php echo $peminjaman->id; ?>">
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																<button type="submit" class="btn btn-primary">Submit</button>
															</div>
														</form>
													</div>
												</div>
											</div>
										<?php } ?>
										<?php if ($peminjaman->status == '3') { ?>
											<div style="text-align: center;">
												<a href="<?= base_url('peminjaman/update_status/'.$peminjaman->id.'/4') ?>" class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp; Selesai &nbsp;&nbsp;</a>
											</div>
										<?php } ?>
									<?php } ?>
								</div>
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