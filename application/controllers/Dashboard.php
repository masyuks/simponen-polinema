<?php

class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'teknisi' && $this->session->login['role'] != 'mahasiswa') redirect();
		$this->data['aktif'] = 'dashboard';
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_teknisi', 'm_teknisi');
		$this->load->model('M_peminjaman', 'm_peminjaman');
		$this->load->model('M_pengguna', 'm_pengguna');
		$this->alert();
	}
	public function index(){
		$this->data['title'] = 'Halaman Dashboard';
		if ($this->session->login['role'] == 'teknisi') {
			$this->data['jumlah_barang'] = $this->m_barang->jumlah();
			$this->data['jumlah_teknisi'] = $this->m_teknisi->jumlah();
			$this->data['jumlah_peminjaman'] = $this->m_peminjaman->jumlah();
			$this->data['jumlah_tanggungan'] = $this->m_peminjaman->jumlah_tanggungan();
			$this->data['jumlah_pengajuan'] = $this->m_peminjaman->jumlah_pengajuan();
			$this->data['jumlah_diterima'] = $this->m_peminjaman->jumlah_diterima();
			$this->data['jumlah_pengguna'] = $this->m_pengguna->jumlah();
			$this->load->view('dashboard', $this->data);
		} else {
			$this->data['all_peminjaman'] = $this->m_peminjaman->lihat_join_mahasiswa();
			$this->data['jumlah_peminjaman'] = $this->m_peminjaman->jumlah_mahasiswa();
			$this->data['jumlah_tanggungan'] = $this->m_peminjaman->jumlah_tanggungan_mahasiswa();
			$this->data['jumlah_pengajuan'] = $this->m_peminjaman->jumlah_pengajuan_mahasiswa();
			$this->data['jumlah_diterima'] = $this->m_peminjaman->jumlah_diterima_mahasiswa();
			$this->data['jumlah_ditolak'] = $this->m_peminjaman->jumlah_ditolak_mahasiswa();
			$this->data['jumlah_selesai'] = $this->m_peminjaman->jumlah_selesai_mahasiswa();
			$this->load->view('dashboard-mahasiswa', $this->data);
		}
	}

	public function cek(){
		$this->data['aktif'] = 'cek-bebas';
		$this->data['title'] = 'Cek Bebas Pinjaman';
		if ($this->session->login['role'] == 'teknisi') {
			$kode_pengguna = $this->input->post('kode_pengguna');
		} else {
			$kode_pengguna = $this->session->login['kode'];
		}
		$this->data['jumlah_pengguna'] = $this->m_pengguna->lihat_jumlah_kode($kode_pengguna);
		if ($this->data['jumlah_pengguna'] > 0) {
			$this->data['data_pengguna'] = $this->m_pengguna->lihat_data_by_kode($kode_pengguna);
		}
		$this->data['kode_pengguna'] = $kode_pengguna;
		$this->data['jumlah_tanggungan'] = $this->m_peminjaman->cek_jumlah_tanggungan($kode_pengguna);
		$this->data['all_peminjaman'] = $this->m_peminjaman->cek_data_tanggungan($kode_pengguna);
		$this->load->view('cek-bebas-pinjaman', $this->data);
	}

	public function alert(){
		$all_peminjaman = $this->m_peminjaman->lihat();
		foreach ($all_peminjaman as $peminjaman):
			$id = $peminjaman->id;
			$status = $peminjaman->status;
			$waktu_kembali = $peminjaman->waktu_kembali;
			$email_push = $peminjaman->email_push;

			if ($status == '2' AND $email_push == NULL) {
				date_default_timezone_set("Asia/Bangkok");
				$time_alert = strtotime(date('Y-m-d H:i:s', strtotime("-5 minute", strtotime($waktu_kembali))));
				$now = strtotime(date('Y-m-d H:i:s'));
				if ($now >= $time_alert) {
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
					$this->email->subject('Pengingat Batas Peminjaman Alat & Komponen');
					// Isi email
					$this->email->message("<h3 style='color: black;'> Pengingat Batas Peminjaman </h3> 
						<span style='color: black;'>
						Notifikasi peringatan batas peminjaman bahwa peminjaman yang <b>akan segera selesai</b> dengan data sebagai berikut : <br><br>
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
						Silahkan selesaikan peminjaman dengan melakukan pengembalian alat atau komponen. <br> Terima Kasih. </span>");

					if ($this->email->send()) {
						$this->session->set_flashdata('success', 'Beberapa pengingat batas peminjaman telah dikirimkan melalui email');
						$data = [
							'email_push' => date('Y-m-d H:i:s'),
						];
						$this->m_peminjaman->ubah($data, $id);
					} else {
						$this->session->set_flashdata('error', 'Terdapat email yang gagal terkirim');
					}
		    	}
		    }
    	endforeach;
	}
}