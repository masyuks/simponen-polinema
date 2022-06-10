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
		$this->data['jumlah_barang'] = $this->m_barang->jumlah();
		$this->data['jumlah_teknisi'] = $this->m_teknisi->jumlah();
		$this->data['jumlah_peminjaman'] = $this->m_peminjaman->jumlah();
		$this->data['jumlah_tanggungan'] = $this->m_peminjaman->jumlah_tanggungan();
		$this->data['jumlah_pengajuan'] = $this->m_peminjaman->jumlah_pengajuan();
		$this->data['jumlah_diterima'] = $this->m_peminjaman->jumlah_diterima();
		$this->data['jumlah_pengguna'] = $this->m_pengguna->jumlah();
		$this->load->view('dashboard', $this->data);
	}

	public function mahasiswa(){
		$this->data['title'] = 'Halaman Dashboard';
		$this->data['jumlah_barang'] = $this->m_barang->jumlah();
		$this->data['jumlah_teknisi'] = $this->m_teknisi->jumlah();
		$this->data['jumlah_peminjaman'] = $this->m_peminjaman->jumlah();
		$this->data['jumlah_tanggungan'] = $this->m_peminjaman->jumlah_tanggungan();
		$this->data['jumlah_pengajuan'] = $this->m_peminjaman->jumlah_pengajuan();
		$this->data['jumlah_pengguna'] = $this->m_pengguna->jumlah();
		$this->load->view('dashboard', $this->data);
	}
}