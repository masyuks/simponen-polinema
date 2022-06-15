<?php

use Dompdf\Dompdf;

class Pengguna extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'teknisi' && $this->session->login['role'] != 'mahasiswa') redirect();
		$this->data['aktif'] = 'pengguna';
		$this->load->model('M_pengguna', 'm_pengguna');
	}

	public function index(){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Managemen Pengguna hanya untuk teknisi!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$this->data['title'] = 'Data Pengguna';
		$this->data['all_pengguna'] = $this->m_pengguna->lihat();
		$this->data['no'] = 1;

		$this->load->view('pengguna/lihat', $this->data);
	}

	public function tambah(){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk teknisi!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$this->data['title'] = 'Tambah Pengguna';

		$this->load->view('pengguna/tambah', $this->data);
	}

	public function proses_tambah(){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk teknisi!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$data = [
			'kode_pengguna' => $this->input->post('kode_pengguna'),
			'nama_pengguna' => $this->input->post('nama_pengguna'),
			'username_pengguna' => $this->input->post('username_pengguna'),
			'password_pengguna' => md5($this->input->post('password_pengguna')),
			'email_pengguna' => $this->input->post('email_pengguna'),
			'jurusan_pengguna' => $this->input->post('jurusan_pengguna'),
		];

		if($this->m_pengguna->tambah($data)){
			$this->session->set_flashdata('success', 'Data Pengguna <strong>Berhasil</strong> Ditambahkan!');
			redirect('pengguna');
		} else {
			$this->session->set_flashdata('error', 'Data Pengguna <strong>Gagal</strong> Ditambahkan!');
			redirect('pengguna');
		}
	}

	public function ubah($id){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk teknisi!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$this->data['title'] = 'Ubah Pengguna';
		$this->data['pengguna'] = $this->m_pengguna->lihat_id($id);

		$this->load->view('pengguna/ubah', $this->data);
	}

	public function proses_ubah($id){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk teknisi!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$password_pengguna = $this->input->post('password_pengguna');

		if ($password_pengguna != '') {
			$data = [
				'kode_pengguna' => $this->input->post('kode_pengguna'),
				'nama_pengguna' => $this->input->post('nama_pengguna'),
				'username_pengguna' => $this->input->post('username_pengguna'),
				'password_pengguna' => md5($this->input->post('password_pengguna')),
				'email_pengguna' => $this->input->post('email_pengguna'),
				'jurusan_pengguna' => $this->input->post('jurusan_pengguna'),
			];
		} else {
			$data = [
				'kode_pengguna' => $this->input->post('kode_pengguna'),
				'nama_pengguna' => $this->input->post('nama_pengguna'),
				'username_pengguna' => $this->input->post('username_pengguna'),
				'email_pengguna' => $this->input->post('email_pengguna'),
				'jurusan_pengguna' => $this->input->post('jurusan_pengguna'),
			];
		}

		if($this->m_pengguna->ubah($data, $id)){
			$this->session->set_flashdata('success', 'Data Pengguna <strong>Berhasil</strong> Diubah!');
			redirect('pengguna');
		} else {
			$this->session->set_flashdata('error', 'Data Pengguna <strong>Gagal</strong> Diubah!');
			redirect('pengguna');
		}
	}

	public function hapus($id){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk teknisi!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		if($this->m_pengguna->hapus($id)){
			$this->session->set_flashdata('success', 'Data Pengguna <strong>Berhasil</strong> Dihapus!');
			redirect('pengguna');
		} else {
			$this->session->set_flashdata('error', 'Data Pengguna <strong>Gagal</strong> Dihapus!');
			redirect('pengguna');
		}
	}
}