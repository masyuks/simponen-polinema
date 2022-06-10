<?php

class Login extends CI_Controller{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		if($this->session->login) redirect('dashboard');
		$this->load->model('M_teknisi', 'm_teknisi');
		$this->load->model('M_pengguna', 'm_pengguna');
	}

	public function index(){
		$this->load->view('login');
	}

	public function proses_login(){
		if($this->input->post('role') === 'teknisi') $this->_proses_login_teknisi($this->input->post('username'));
		elseif($this->input->post('role') === 'mahasiswa') $this->_proses_login_mahasiswa($this->input->post('username'));
		else {
			?>
			<script>
				alert('role tidak tersedia!')
			</script>
			<?php
		}
	}

	protected function _proses_login_teknisi($username){
		$get_teknisi = $this->m_teknisi->lihat_username($username);
		if($get_teknisi){
			if($get_teknisi->password_teknisi == md5($this->input->post('password'))){
				$session = [
					'id' => $get_teknisi->id,
					'kode' => $get_teknisi->kode_teknisi,
					'nama' => $get_teknisi->nama_teknisi,
					'username' => $get_teknisi->username_teknisi,
					'role' => $this->input->post('role'),
					'jam_masuk' => date('H:i:s')
				];

				$this->session->set_userdata('login', $session);
				$this->session->set_flashdata('success', '<strong>Login</strong> Berhasil!');
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('error', 'Password Salah!');
				redirect();
			}
		} else {
			$this->session->set_flashdata('error', 'Username Salah!');
			redirect();
		}
	}

	protected function _proses_login_mahasiswa($username){
		$get_pengguna = $this->m_pengguna->lihat_kode($username);
		if($get_pengguna){
			if($get_pengguna->password_pengguna == md5($this->input->post('password'))){
				$session = [
					'id' => $get_pengguna->id,
					'kode' => $get_pengguna->kode_pengguna,
					'nama' => $get_pengguna->nama_pengguna,
					'username' => $get_pengguna->username_pengguna,
					'role' => $this->input->post('role'),
					'jam_masuk' => date('H:i:s')
				];

				$this->session->set_userdata('login', $session);
				$this->session->set_flashdata('success', '<strong>Login</strong> Berhasil!');
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('error', 'Password Salah!');
				redirect();
			}
		} else {
			$this->session->set_flashdata('error', 'Username Salah!');
			redirect();
		}
	}
}