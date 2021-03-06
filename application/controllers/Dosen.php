<?php

use Dompdf\Dompdf;

class Dosen extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'teknisi' && $this->session->login['role'] != 'mahasiswa') redirect();
		$this->data['aktif'] = 'dosen';
		$this->load->model('M_dosen', 'm_dosen');
		$this->load->model('M_mk', 'm_mk');
	}

	public function index(){
		$this->data['title'] = 'Data Dosen';
		$this->data['all_dosen'] = $this->m_dosen->lihat();
		$this->data['no'] = 1;

		$this->load->view('dosen/lihat', $this->data);
	}

	public function tambah(){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk teknisi!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$this->data['title'] = 'Tambah Dosen';
		$this->data['all_mk'] = $this->m_mk->lihat();

		$this->load->view('dosen/tambah', $this->data);
	}

	public function proses_tambah(){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk teknisi!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$data = [
			'kode_dosen' => $this->input->post('kode_dosen'),
			'nama_dosen' => $this->input->post('nama_dosen'),
			'jabatan' => $this->input->post('jabatan'),
		];

		if($this->m_dosen->tambah($data)){
			$this->session->set_flashdata('success', 'Data dosen <strong>Berhasil</strong> Ditambahkan!');
			redirect('dosen');
		} else {
			$this->session->set_flashdata('error', 'Data dosen <strong>Gagal</strong> Ditambahkan!');
			redirect('dosen');
		}
	}

	public function ubah($id){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk teknisi!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$this->data['title'] = 'Ubah Dosen';
		$this->data['dosen'] = $this->m_dosen->lihat_id($id);

		$this->load->view('dosen/ubah', $this->data);
	}

	public function proses_ubah($id){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk teknisi!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$data = [
			'kode_dosen' => $this->input->post('kode_dosen'),
			'nama_dosen' => $this->input->post('nama_dosen'),
			'jabatan' => $this->input->post('jabatan'),
		];

		if($this->m_dosen->ubah($data, $id)){
			$this->session->set_flashdata('success', 'Data dosen <strong>Berhasil</strong> Diubah!');
			redirect('dosen');
		} else {
			$this->session->set_flashdata('error', 'Data dosen <strong>Gagal</strong> Diubah!');
			redirect('dosen');
		}
	}

	public function hapus($id){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Hapus data hanya untuk teknisi!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		if($this->m_dosen->hapus($id)){
			$this->session->set_flashdata('success', 'Data dosen <strong>Berhasil</strong> Dihapus!');
			redirect('dosen');
		} else {
			$this->session->set_flashdata('error', 'Data dosen <strong>Gagal</strong> Dihapus!');
			redirect('dosen');
		}
	}
}