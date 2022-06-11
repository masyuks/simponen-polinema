<?php

class Cek extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_teknisi', 'm_teknisi');
		$this->load->model('M_peminjaman', 'm_peminjaman');
		$this->load->model('M_pengguna', 'm_pengguna');
	}
	public function index(){
		$this->data['aktif'] = 'cek-bebas';
		$this->data['title'] = 'Cek Bebas Pinjaman';
		$kode_pengguna = $this->input->post('kode_pengguna');
		$this->data['jumlah_pengguna'] = $this->m_pengguna->lihat_jumlah_kode($kode_pengguna);
		if ($this->data['jumlah_pengguna'] > 0) {
			$this->data['data_pengguna'] = $this->m_pengguna->lihat_data_by_kode($kode_pengguna);
		}
		$this->data['kode_pengguna'] = $kode_pengguna;
		$this->data['jumlah_tanggungan'] = $this->m_peminjaman->cek_jumlah_tanggungan($kode_pengguna);
		$this->data['all_peminjaman'] = $this->m_peminjaman->cek_data_tanggungan($kode_pengguna);
		$this->load->view('cek-bebas-pinjaman-nonlogin', $this->data);
	}
}