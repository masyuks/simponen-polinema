<?php

use Dompdf\Dompdf;

class Barang extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'teknisi' && $this->session->login['role'] != 'mahasiswa') redirect();
		$this->data['aktif'] = 'barang';
		$this->load->model('M_barang', 'm_barang');
	}

	public function index(){
		$this->data['title'] = 'Data Barang';
		$this->data['all_barang'] = $this->m_barang->lihat();
		$this->data['no'] = 1;

		$this->load->view('barang/lihat', $this->data);
	}

	public function tambah(){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$this->data['title'] = 'Tambah Barang';

		$this->load->view('barang/tambah', $this->data);
	}

	public function proses_tambah(){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$cek_kode = $this->m_barang->cek_kode($this->input->post('kode_barang'));
		if ($cek_kode > 0) {
			$this->session->set_flashdata('error', 'Kode Barang <strong>Telah</strong> Digunakan!');
			redirect('barang');
		} else {
			if (!empty($_FILES["image"]["name"])) {
				$config['upload_path']          = './assets/barang';
				$config['allowed_types']        = 'jpg|png';
				$config['file_name']            =  $this->input->post('kode_barang');
				$config['overwrite']			= true;
				$config['max_size']             = 5120; // 5MB
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$data = [
						'kode_barang' => $this->input->post('kode_barang'),
						'nama_barang' => $this->input->post('nama_barang'),
						'harga' => $this->input->post('harga'),
						'stok' => $this->input->post('stok'),
						'jenis' => $this->input->post('jenis'),
						'path' => $this->upload->data('file_name'),
					];	
				} else {
					$data = [
						'kode_barang' => $this->input->post('kode_barang'),
						'nama_barang' => $this->input->post('nama_barang'),
						'harga' => $this->input->post('harga'),
						'stok' => $this->input->post('stok'),
						'jenis' => $this->input->post('jenis'),
						'path' => 'not_found.png',
					];	
				}	
			} else {
				$data = [
					'kode_barang' => $this->input->post('kode_barang'),
					'nama_barang' => $this->input->post('nama_barang'),
					'harga' => $this->input->post('harga'),
					'stok' => $this->input->post('stok'),
					'jenis' => $this->input->post('jenis'),
					'path' => 'not_found.png',
				];	
			}

			if($this->m_barang->tambah($data)){
				$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Ditambahkan!');
				redirect('barang');
			} else {
				$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Ditambahkan!');
				redirect('barang');
			}
		}
	}

	public function ubah($kode_barang){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$this->data['title'] = 'Ubah Barang';
		$this->data['barang'] = $this->m_barang->lihat_id($kode_barang);

		$this->load->view('barang/ubah', $this->data);
	}

	public function proses_ubah($kode_barang){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect($_SERVER['HTTP_REFERER']);
		}

		// Upload Image
		if (!empty($_FILES["image"]["name"])) {
			// Hapus Image
			$filename = explode(".", $kode_barang)[0];
			array_map('unlink', glob(FCPATH."assets/barang/$filename.*"));
			// Upload Baru
			$config['upload_path']          = './assets/barang';
			$config['allowed_types']        = 'jpg|png';
			$config['file_name']            =  $this->input->post('kode_barang');
			$config['overwrite']			= true;
			$config['max_size']             = 5120; // 5MB
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {
				$data = [
					'nama_barang' => $this->input->post('nama_barang'),
					'harga' => $this->input->post('harga'),
					'stok' => $this->input->post('stok'),
					'jenis' => $this->input->post('jenis'),
					'path' => $this->upload->data('file_name'),
				];	
			} else {
				$data = [
					'nama_barang' => $this->input->post('nama_barang'),
					'harga' => $this->input->post('harga'),
					'stok' => $this->input->post('stok'),
					'jenis' => $this->input->post('jenis'),
					'path' => 'not_found.png',
				];	
			}	
		} else {
			$data = [
				'kode_barang' => $this->input->post('kode_barang'),
				'nama_barang' => $this->input->post('nama_barang'),
				'harga' => $this->input->post('harga'),
				'stok' => $this->input->post('stok'),
				'jenis' => $this->input->post('jenis'),
				'path' => $this->input->post('old_image'),
			];	
		}

		if($this->m_barang->ubah($data, $kode_barang)){
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('barang');
		} else {
			$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Diubah!');
			redirect('barang');
		}
	}

	public function hapus($kode_barang){
		if ($this->session->login['role'] == 'mahasiswa'){
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect($_SERVER['HTTP_REFERER']);
		}
		
		// Hapus Image
		$filename = explode(".", $kode_barang)[0];
		array_map('unlink', glob(FCPATH."assets/barang/$filename.*"));

		if($this->m_barang->hapus($kode_barang)){
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Dihapus!');
			redirect('barang');
		} else {
			$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Dihapus!');
			redirect('barang');
		}
	}
}