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
}