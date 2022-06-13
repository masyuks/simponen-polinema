<?php

use Dompdf\Dompdf;

class mk extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'teknisi' && $this->session->login['role'] != 'mahasiswa') redirect();
		$this->data['aktif'] = 'mk';
		$this->load->model('M_mk', 'm_mk');
	}

	public function index(){
		$this->data['title'] = 'Data Mata Kuliah';
		$this->data['all_mk'] = $this->m_mk->lihat();
		$this->data['no'] = 1;

		$this->load->view('mk/lihat', $this->data);
	}

	public function tambah(){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk teknisi!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$this->data['title'] = 'Tambah Mata Kuliah';

		$this->load->view('mk/tambah', $this->data);
	}

	public function proses_tambah(){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk teknisi!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$data = [
			'kode_mk' => $this->input->post('kode_mk'),
			'nama_mk' => $this->input->post('nama_mk'),
		];

		if($this->m_mk->tambah($data)){
			$this->session->set_flashdata('success', 'Data Mata Kuliah <strong>Berhasil</strong> Ditambahkan!');
			redirect('mk');
		} else {
			$this->session->set_flashdata('error', 'Data Mata Kuliah <strong>Gagal</strong> Ditambahkan!');
			redirect('mk');
		}
	}

	public function ubah($id){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk teknisi!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$this->data['title'] = 'Ubah Mata Kuliah';
		$this->data['mk'] = $this->m_mk->lihat_id($id);

		$this->load->view('mk/ubah', $this->data);
	}

	public function proses_ubah($id){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk teknisi!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$data = [
			'kode_mk' => $this->input->post('kode_mk'),
			'nama_mk' => $this->input->post('nama_mk'),
		];

		if($this->m_mk->ubah($data, $id)){
			$this->session->set_flashdata('success', 'Data Mata Kuliah <strong>Berhasil</strong> Diubah!');
			redirect('mk');
		} else {
			$this->session->set_flashdata('error', 'Data Mata Kuliah <strong>Gagal</strong> Diubah!');
			redirect('mk');
		}
	}

	public function hapus($id){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Hapus data hanya untuk teknisi!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		if($this->m_mk->hapus($id)){
			$this->session->set_flashdata('success', 'Data Mata Kuliah <strong>Berhasil</strong> Dihapus!');
			redirect('mk');
		} else {
			$this->session->set_flashdata('error', 'Data Mata Kuliah <strong>Gagal</strong> Dihapus!');
			redirect('mk');
		}
	}
}