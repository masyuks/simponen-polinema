<?php

use Dompdf\Dompdf;

class Teknisi extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'teknisi' && $this->session->login['role'] != 'mahasiswa') redirect();
		$this->data['aktif'] = 'teknisi';
		$this->load->model('M_teknisi', 'm_teknisi');
	}

	public function index(){
		$this->data['title'] = 'Data Teknisi';
		$this->data['all_teknisi'] = $this->m_teknisi->lihat();
		$this->data['no'] = 1;

		$this->load->view('teknisi/lihat', $this->data);
	}

	public function tambah(){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk teknisi!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$this->data['title'] = 'Tambah Teknisi';

		$this->load->view('teknisi/tambah', $this->data);
	}

	public function proses_tambah(){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk teknisi!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$data = [
			'kode_teknisi' => $this->input->post('kode_teknisi'),
			'nama_teknisi' => $this->input->post('nama_teknisi'),
			'username_teknisi' => $this->input->post('username_teknisi'),
			'password_teknisi' => md5($this->input->post('password_teknisi')),
		];

		if($this->m_teknisi->tambah($data)){
			$this->session->set_flashdata('success', 'Data teknisi <strong>Berhasil</strong> Ditambahkan!');
			redirect('teknisi');
		} else {
			$this->session->set_flashdata('error', 'Data teknisi <strong>Gagal</strong> Ditambahkan!');
			redirect('teknisi');
		}
	}

	public function ubah($id){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk teknisi!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$this->data['title'] = 'Ubah Teknisi';
		$this->data['teknisi'] = $this->m_teknisi->lihat_id($id);

		$this->load->view('teknisi/ubah', $this->data);
	}

	public function proses_ubah($id){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk teknisi!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$password_teknisi = $this->input->post('password_teknisi');
		if ($password_teknisi != '') {
			$data = [
				'kode_teknisi' => $this->input->post('kode_teknisi'),
				'nama_teknisi' => $this->input->post('nama_teknisi'),
				'username_teknisi' => $this->input->post('username_teknisi'),
				'password_teknisi' => $this->input->post('password_teknisi'),
			];
		} else {
			$data = [
				'kode_teknisi' => $this->input->post('kode_teknisi'),
				'nama_teknisi' => $this->input->post('nama_teknisi'),
				'username_teknisi' => $this->input->post('username_teknisi'),
			];
		}

		if($this->m_teknisi->ubah($data, $id)){
			$this->session->set_flashdata('success', 'Data teknisi <strong>Berhasil</strong> Diubah!');
			redirect('teknisi');
		} else {
			$this->session->set_flashdata('error', 'Data teknisi <strong>Gagal</strong> Diubah!');
			redirect('teknisi');
		}
	}

	public function hapus($id){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Hapus data hanya untuk teknisi!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		if($this->m_teknisi->hapus($id)){
			$this->session->set_flashdata('success', 'Data teknisi <strong>Berhasil</strong> Dihapus!');
			redirect('teknisi');
		} else {
			$this->session->set_flashdata('error', 'Data teknisi <strong>Gagal</strong> Dihapus!');
			redirect('teknisi');
		}
	}
}