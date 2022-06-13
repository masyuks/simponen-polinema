<?php

use Dompdf\Dompdf;

class Peminjaman extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'teknisi' && $this->session->login['role'] != 'mahasiswa') redirect();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_dosen', 'm_dosen');
		$this->load->model('M_pengguna', 'm_pengguna');
		$this->load->model('M_peminjaman', 'm_peminjaman');
		$this->load->model('M_detail_peminjaman', 'm_detail_peminjaman');
		$this->data['aktif'] = 'peminjaman';
	}

	public function index(){
		$this->data['title'] = 'Data peminjaman';
		if ($this->session->login['role'] == 'teknisi') {
			$this->data['all_peminjaman'] = $this->m_peminjaman->lihat_join_today();
		} else {
			$this->data['all_peminjaman'] = $this->m_peminjaman->lihat_join_today_mahasiswa();
		}
		$this->load->view('peminjaman/lihat', $this->data);
	}

	public function filter(){
		$this->data['title'] = 'Data peminjaman';
		if ($this->session->login['role'] == 'teknisi') {
			$this->data['all_peminjaman'] = $this->m_peminjaman->lihat_join_filter($this->input->post('tanggal_awal'), $this->input->post('tanggal_akhir'));
		} else {
			$this->data['all_peminjaman'] = $this->m_peminjaman->lihat_join_filter_mahasiswa($this->input->post('tanggal_awal'), $this->input->post('tanggal_akhir'));
		}
		$this->load->view('peminjaman/lihat', $this->data);
	}

	public function rekap(){
		$this->data['aktif'] = 'rekap';
		$this->data['title'] = 'Rekap peminjaman Barang';
		if ($this->session->login['role'] == 'teknisi') {
			$this->data['all_peminjaman'] = $this->m_peminjaman->lihat_join_full();
		} else {
			$this->data['all_peminjaman'] = $this->m_peminjaman->lihat_join_full_mahasiswa();
		}
		$this->load->view('peminjaman/rekap', $this->data);
	}

	public function filterRekap(){
		$this->data['aktif'] = 'rekap';
		$this->data['title'] = 'Rekap peminjaman Barang';
		if ($this->session->login['role'] == 'teknisi') {
			$this->data['all_peminjaman'] = $this->m_peminjaman->lihat_join_full_filter($this->input->post('tanggal_awal'), $this->input->post('tanggal_akhir'));
		} else {
			$this->data['all_peminjaman'] = $this->m_peminjaman->lihat_join_full_filter_mahasiswa($this->input->post('tanggal_awal'), $this->input->post('tanggal_akhir'));
		}
		$this->load->view('peminjaman/rekap', $this->data);
	}

	public function tambah(){
		$this->data['title'] = 'Tambah peminjaman';
		$this->data['all_barang'] = $this->m_barang->lihat_stok();
		$this->data['all_dosen'] = $this->m_dosen->lihat_join_mk();
		$this->data['all_pengguna'] = $this->m_pengguna->lihat();

		$this->load->view('peminjaman/tambah', $this->data);
	}

	public function proses_tambah(){
		$jumlah_barang_dibeli = count($this->input->post('nama_barang_hidden'));
		
		if ($this->session->login['role'] != 'teknisi') {
		$data_peminjaman = [
			'waktu_pinjam' => $this->input->post('tanggal_pinjam').' '.$this->input->post('jam_pinjam'),
			'waktu_kembali' => $this->input->post('tanggal_kembali').' '.$this->input->post('jam_kembali'),
			'id_dosen' => $this->input->post('id_dosen'),
			'waktu_diajukan' => $this->input->post('waktu_diajukan'),
			'status' => '1',
			'id_pengguna' => $this->session->login['id'],
		];
	} else {
		$data_peminjaman = [
			'waktu_pinjam' => $this->input->post('tanggal_pinjam').' '.$this->input->post('jam_pinjam'),
			'waktu_kembali' => $this->input->post('tanggal_kembali').' '.$this->input->post('jam_kembali'),
			'id_dosen' => $this->input->post('id_dosen'),
			'waktu_diajukan' => $this->input->post('waktu_diajukan'),
			'status' => '1',
			'id_pengguna' => $this->input->post('id_pengguna'),
		];
	}

		if ($this->m_peminjaman->tambah($data_peminjaman)) {
			$id_peminjaman = $this->m_peminjaman->lihat_waktu_diajukan($this->input->post('waktu_diajukan'));
			$data_detail_peminjaman = [];

			for ($i=0; $i < $jumlah_barang_dibeli ; $i++) { 
				array_push($data_detail_peminjaman, ['id_barang' => $this->input->post('id_hidden')[$i]]);
				$data_detail_peminjaman[$i]['id_peminjaman'] = $id_peminjaman;
				$data_detail_peminjaman[$i]['jumlah'] = $this->input->post('jumlah_hidden')[$i];
			}

			if($this->m_detail_peminjaman->tambah($data_detail_peminjaman)){
				for ($i=0; $i < $jumlah_barang_dibeli ; $i++) { 
					$this->m_barang->min_stok($data_detail_peminjaman[$i]['jumlah'], $data_detail_peminjaman[$i]['id_barang']) or die('gagal min stok');
				}
				$this->session->set_flashdata('success', 'Data <strong>peminjaman</strong> Berhasil Dibuat!');
				redirect('peminjaman');
			} else {
				$this->session->set_flashdata('success', 'Data <strong>peminjaman</strong> Berhasil Dibuat!');
				redirect('peminjaman');
			}
		} else {
			$this->session->set_flashdata('success', 'Data <strong>peminjaman</strong> Berhasil Dibuat!');
			redirect('peminjaman');
		}
	}

	public function detail($id){
		$this->data['title'] = 'Detail peminjaman';
		$this->data['peminjaman'] = $this->m_peminjaman->lihat_id_join($id);
		$this->data['all_detail_peminjaman'] = $this->m_detail_peminjaman->lihat_id_peminjaman_join($id);
		$this->data['no'] = 1;

		$this->load->view('peminjaman/detail', $this->data);
	}

	public function hapus($id){
		$all_detail_peminjaman = $this->m_detail_peminjaman->lihat_id_peminjaman_join($id);
		foreach ($all_detail_peminjaman as $detail_peminjaman):
			$id_barang = $detail_peminjaman->id_barang;
			$jumlah = $detail_peminjaman->jumlah;
			$this->m_barang->plus_stok($jumlah, $id_barang) or die('gagal plus stok');
		endforeach;
		if($this->m_peminjaman->hapus($id) && $this->m_detail_peminjaman->hapus($id)){
			$this->session->set_flashdata('success', 'Data peminjaman <strong>Berhasil</strong> Dihapus!');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$this->session->set_flashdata('error', 'Data peminjaman <strong>Gagal</strong> Dihapus!');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function update_status($id, $status){
		if ($status == 5 || $status == 4) {
			$all_detail_peminjaman = $this->m_detail_peminjaman->lihat_id_peminjaman_join($id);
			foreach ($all_detail_peminjaman as $detail_peminjaman):
				$id_barang = $detail_peminjaman->id_barang;
				$jumlah = $detail_peminjaman->jumlah;
				$this->m_barang->plus_stok($jumlah, $id_barang) or die('gagal plus stok');
			endforeach;
		}

		if ($status == 2) {
			$data = [
				'id_teknisi' => $this->session->login['id'],
				'status' => $status,
			];
		} else {
			$data = [
				'status' => $status,
			];
		}

		if($this->m_peminjaman->ubah($data, $id)){
			$this->session->set_flashdata('success', 'Status peminjaman <strong>Berhasil</strong> Diperbarui!');
			if ($status == 2) {
				$peminjaman = $this->m_peminjaman->lihat_id_join($id);
				$this->load->library('email');
				$config = array();
				$config['charset']='utf-8';
				$config['useragent']='Codeigniter';
				$config['protocol']="smtp";
				$config['mailtype']="html";
				$config['smtp_host']="ssl://smtp.gmail.com";
				$config['smtp_port']="465";
				$config['smtp_timeout']="400";
				$config['smtp_user']="1841160077@student.polinema.ac.id";
				$config['smtp_pass']="cindpuspita";
				$config['crlf']="\r\n";
				$config['newline']="\r\n";
				$config['wordwrap']=TRUE;

				//memanggil library email dan set konfigurasi untuk pengiriman email	
				$this->email->initialize($config);
				// Email dan nama pengirim
				$this->email->from('no-reply@polinema.ac.id', 'Lab AI Polinema');
				// Email penerima
				$this->email->to($peminjaman->email_pengguna); // Ganti dengan email tujuan
				// Subject email
				$this->email->subject('Notifikasi Penerimaan Pengajuan Peminjaman Alat & Komponen');
				// Isi email
				$this->email->message("<h3 style='color: black;'> Penerimaan Pengajuan Peminjaman Alat & Komponen</h3> 
					<span style='color: black;'>
					Notifikasi penerimaan pengajuan peminjaman alat & komponen bahwa pengajuan pinjaman <b>telah disetujui</b> dengan data sebagai berikut : <br><br>
					<b> Nama </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 
					$peminjaman->nama_pengguna <br>
					<b> Dosen </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 
					$peminjaman->nama_dosen<br>
					<b> Mata Kuliah </b> &nbsp;&nbsp;&nbsp;&nbsp; : 
					$peminjaman->nama_mk <br>
					<b> Waktu Pinjam </b> &nbsp; : 
					$peminjaman->waktu_pinjam <br>
					<b> Waktu Kembali </b> : 
					$peminjaman->waktu_kembali <br><br>
					Silahkan melakukan peminjaman alat atau komponen ke Laboratorium Gedung AI Polinema untuk mengambil alat atau komponen yang akan dipinjam. <br> Terima Kasih. </span>");
				if ($this->email->send()) {
					$this->session->set_flashdata('success', 'Status peminjaman <strong>Berhasil</strong> Diperbarui. Pemberitahuan email telah dikirimkan');
				} 
			}
			redirect('peminjaman');
		} else {
			$this->session->set_flashdata('error', 'Status peminjaman <strong>Gagal</strong> Diperbarui!');
			redirect('peminjaman');
		}
	}

	public function tanggungan(){

		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$keterangan = $this->input->post('keterangan');

		$data = [
			'keterangan' => $keterangan,
		];

		if($this->m_peminjaman->ubah($data, $id)){
			$this->update_status($id, $status);
		}
	}


	public function get_all_barang(){
		$data = $this->m_barang->lihat_nama_barang($_POST['nama_barang']);
		echo json_encode($data);
	}

	public function keranjang_barang(){
		$this->load->view('peminjaman/keranjang');
	}

	public function export_rekap(){
		$data['all_peminjaman'] = $this->m_peminjaman->lihat_join_full();
		$data['title'] = 'Rekap Riwayat Transaksi Peminjaman';
		$data['no'] = 1;

		$this->load->library('pdf');
		$this->pdf->set_option('isRemoteEnabled', true);
	    $this->pdf->setPaper('A4', 'potrait');
	    $this->pdf->filename = 'Riwayat Transaksi Peminjaman ('.date('d-M-Y').').pdf';
	    $this->pdf->load_view('peminjaman/rekap_pdf', $data);
	}

	public function export_rekap_filter(){
		$data['all_peminjaman'] = $this->m_peminjaman->lihat_join_full_filter($this->input->post('tanggal_awal'), $this->input->post('tanggal_akhir'));
		$data['title'] = 'Rekap Riwayat Transaksi Peminjaman';
		if ($this->input->post('tanggal_awal') == $this->input->post('tanggal_akhir')) {
			$data['periode'] = $this->input->post('tanggal_awal');
		} else {
			$data['periode'] = $this->input->post('tanggal_awal').' sampai '.$this->input->post('tanggal_akhir');
		}
		$data['no'] = 1;

		$this->load->library('pdf');
		$this->pdf->set_option('isRemoteEnabled', true);
	    $this->pdf->setPaper('A4', 'potrait');
	    $this->pdf->filename = 'Riwayat Transaksi Peminjaman Periode'.$data['periode'].' ('.date('d-M-Y').').pdf';
	    $this->pdf->load_view('peminjaman/rekap_pdf', $data);
	}
}