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
						<a href="<?= base_url('peminjaman') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('peminjaman/proses_tambah') ?>" id="form-tambah" method="POST">
									<h5>Data Peminjaman</h5>
									<hr>
									<?php 
									if ($this->session->login['role'] == 'teknisi') {
									?>
									<div class="form-row">
										<div class="form-group col-12">
											<label for="nama_dosen">NIM Mahasiswa</label>
											<select name="id_pengguna" id="id_pengguna" class="form-control" required>
												<option selected disabled>Pilih Mahasiswa</option>
												<?php foreach ($all_pengguna as $pengguna): ?>
													<option value="<?= $pengguna->id ?>"><?= $pengguna->kode_pengguna.' - '.$pengguna->nama_pengguna ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<?php
									}
									 ?>
									<div class="form-row">
										<div class="form-group col-4">
											<label for="nama_dosen">Nama Dosen</label>
											<select name="id_dosen" id="id_dosen" class="form-control" required>
												<option selected disabled>Pilih Dosen</option>
												<?php foreach ($all_dosen as $dosen): ?>
													<option value="<?= $dosen->id ?>"><?= $dosen->nama_dosen ?></option>
												<?php endforeach ?>
											</select>
										</div>
										<div class="form-group col-2">
											<label>Tanggal Pinjam</label>
											<input type="date" name="tanggal_pinjam" value="" class="form-control" required>
										</div>
										<div class="form-group col-2">
											<label>Jam Pinjam</label>
											<input type="time" name="jam_pinjam" class="form-control" required>
										</div>
										<div class="form-group col-2">
											<label>Tanggal Kembali</label>
											<input type="date" name="tanggal_kembali" class="form-control" required>
										</div>
										<div class="form-group col-2">
											<label>Jam Kembali</label>
											<input type="time" name="jam_kembali" class="form-control" required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-3">
											<label for="nama_dosen">Mata Kuliah</label>
											<select name="id_mk" id="id_mk" class="form-control" required>
												<option selected disabled>Pilih Mata Kuliah</option>
												<?php foreach ($all_mk as $mk): ?>
													<option value="<?= $mk->id ?>"><?= $mk->nama_mk ?></option>
												<?php endforeach ?>
											</select>
										</div>
										<div class="form-group col-3">
											<label>Kelas</label>
											<input type="text" name="kelas" value="" class="form-control" required>
											<span style="color: red; font-size: 10px;">* Contoh 1D atau 4A</span>
										</div>
										<div class="form-group col-3">
											<label>Semester</label>
											<select name="semester" id="semester" class="form-control" required>
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
										<div class="form-group col-3">
											<label>Timestamp</label>
											<input type="text" name="waktu_diajukan" value="<?= date('Y-m-d H:i:s') ?>" readonly class="form-control">
										</div>
									</div>
									<h5>Data Barang</h5>
									<hr>
									<div class="form-row">
										<div class="form-group col-3">
											<label for="nama_barang">Nama</label>
											<select name="nama_barang" id="nama_barang" class="form-control">
												<option value="">Pilih Barang</option>
												<?php foreach ($all_barang as $barang): ?>
													<option value="<?= $barang->nama_barang ?>"><?= $barang->nama_barang ?></option>
												<?php endforeach ?>
											</select>
										</div>
										<input type="hidden" name="id" value="" readonly>
										<div class="form-group col-2">
											<label>Kode</label>
											<input type="text" name="kode_barang" value="" readonly class="form-control">
										</div>
										<div class="form-group col-2">
											<label>Jenis</label>
											<input type="text" name="jenis" value="" readonly class="form-control">
										</div>
										<div class="form-group col-2">
											<label>Stok</label>
											<input type="text" name="stok" value="" readonly class="form-control">
										</div>
										<div class="form-group col-2">
											<label>Jumlah</label>
											<input type="number" name="jumlah" value="" class="form-control" min='1'>
										</div>
										<div class="form-group col-1">
											<label for="">&nbsp;</label>
											<button disabled type="button" class="btn btn-primary btn-block" id="tambah"><i class="fa fa-plus"></i></button>
										</div>
										<input type="hidden" name="satuan" value="">
									</div>
									<div class="keranjang">
										<h5>Detail Pembelian</h5>
										<hr>
										<table class="table table-bordered" id="keranjang">
											<thead>
												<tr>
													<td width="55%">Nama Barang</td>
													<td width="15%">Jenis</td>
													<td width="15%">Jumlah</td>
													<td width="15%">Aksi</td>
												</tr>
											</thead>
											<tbody>
												
											</tbody>
											<tfoot>
												<tr>
													<td colspan="3" align="right"></td>
													<td>
														<input type="hidden" name="total_hidden" value="">
														<input type="hidden" name="max_hidden" value="">
														<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
													</td>
												</tr>
											</tfoot>
										</table>
									</div>
								</form>
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
	<script>
		$(document).ready(function(){
			$('tfoot').hide()

			$(document).keypress(function(event){
		    	if (event.which == '13') {
		      		event.preventDefault();
			   	}
			})

			$('#nama_barang').on('change', function(){

				if($(this).val() == '') reset()
				else {
					const url_get_all_barang = $('#content').data('url') + '/get_all_barang'
					$.ajax({
						url: url_get_all_barang,
						type: 'POST',
						dataType: 'json',
						data: {nama_barang: $(this).val()},
						success: function(data){
							$('input[name="id"]').val(data.id)
							$('input[name="kode_barang"]').val(data.kode_barang)
							$('input[name="jumlah"]').val(1)
							$('input[name="jenis"]').val(data.jenis)
							$('input[name="stok"]').val(data.stok)
							$('input[name="max_hidden"]').val(data.stok)
							$('input[name="jumlah"]').prop('readonly', false)
							$('button#tambah').prop('disabled', false)
							
							$('input[name="jumlah"]').on('keydown keyup change blur', function(){
								$('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
							})
						}
					})
				}
			})

			$(document).on('click', '#tambah', function(e){
				const url_keranjang_barang = $('#content').data('url') + '/keranjang_barang'
				const data_keranjang = {
					nama_barang: $('select[name="nama_barang"]').val(),
					jenis: $('input[name="jenis"]').val(),
					jumlah: $('input[name="jumlah"]').val(),
					id: $('input[name="id"]').val(),
				}

				if(parseInt($('input[name="max_hidden"]').val()) <= parseInt(data_keranjang.jumlah)) {
					alert('stok tidak tersedia! stok tersedia : ' + parseInt($('input[name="max_hidden"]').val()))	
				} else {
					$.ajax({
						url: url_keranjang_barang,
						type: 'POST',
						data: data_keranjang,
						success: function(data){
							if($('select[name="nama_barang"]').val() == data_keranjang.nama_barang) $('option[value="' + data_keranjang.nama_barang + '"]').hide()
							reset()

							$('table#keranjang tbody').append(data)
							$('tfoot').show()

							$('#total').html('<strong>' + hitung_total() + '</strong>')
							$('input[name="total_hidden"]').val(hitung_total())
						}
					})
				}

			})


			$(document).on('click', '#tombol-hapus', function(){
				$(this).closest('.row-keranjang').remove()

				$('option[value="' + $(this).data('nama-barang') + '"]').show()

				if($('tbody').children().length == 0) $('tfoot').hide()
			})

			$('button[type="submit"]').on('click', function(){
				$('input[name="kode_barang"]').prop('disabled', true)
				$('select[name="nama_barang"]').prop('disabled', true)
				$('input[name="jenis"]').prop('disabled', true)
				$('input[name="jumlah"]').prop('disabled', true)
				$('input[name="stok"]').prop('disabled', true)
				$('input[name="id"]').prop('disabled', true)
			})

			function hitung_total(){
				let total = 0;
				$('.sub_total').each(function(){
					total += parseInt($(this).text())
				})

				return total;
			}

			function reset(){
				$('#nama_barang').val('')
				$('input[name="kode_barang"]').val('')
				$('input[name="jenis"]').val('')
				$('input[name="jumlah"]').val('')
				$('input[name="stok"]').val('')
				$('input[name="jumlah"]').prop('readonly', true)
				$('button#tambah').prop('disabled', true)
			}
		})
	</script>
</body>
</html>