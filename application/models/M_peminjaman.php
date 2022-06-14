<?php

class M_peminjaman extends CI_Model {
	protected $_table = 'peminjaman';

	public function lihat(){
		return $this->db->get($this->_table)->result();
	}

	public function lihat_join(){
		$this->db->select('peminjaman.*, teknisi.nama_teknisi, pengguna.nama_pengguna, pengguna.kode_pengguna AS nim, dosen.nama_dosen');
		$this->db->join('pengguna','peminjaman.id_pengguna=pengguna.id');
		$this->db->join('dosen','peminjaman.id_dosen=dosen.id');
		$this->db->join('teknisi','peminjaman.id_teknisi=teknisi.id', 'left');
		return $this->db->get($this->_table)->result();
	} 

	public function lihat_join_today(){
		$this->db->select('peminjaman.*, teknisi.nama_teknisi, pengguna.nama_pengguna, pengguna.kode_pengguna AS nim, dosen.nama_dosen');
		$this->db->join('pengguna','peminjaman.id_pengguna=pengguna.id');
		$this->db->join('dosen','peminjaman.id_dosen=dosen.id');
		$this->db->join('teknisi','peminjaman.id_teknisi=teknisi.id', 'left');
		$this->db->where('waktu_pinjam>=', date('Y-m-d').' 00:00:00');
		return $this->db->get($this->_table)->result();
	} 

	public function lihat_join_filter($tanggal_awal, $tanggal_akhir){
		$this->db->select('peminjaman.*, teknisi.nama_teknisi, pengguna.nama_pengguna, pengguna.kode_pengguna AS nim, dosen.nama_dosen');
		$this->db->join('pengguna','peminjaman.id_pengguna=pengguna.id');
		$this->db->join('dosen','peminjaman.id_dosen=dosen.id');
		$this->db->join('teknisi','peminjaman.id_teknisi=teknisi.id', 'left');
		$this->db->where('waktu_pinjam>=', $tanggal_awal.' 00:00:00');
		$this->db->where('waktu_pinjam<=', $tanggal_akhir.' 23:59:00');
		return $this->db->get($this->_table)->result();
	} 

	public function lihat_join_full(){
		$this->db->select('peminjaman.*, teknisi.nama_teknisi, pengguna.nama_pengguna, pengguna.kode_pengguna AS nim, pengguna.username_pengguna, dosen.nama_dosen, barang.nama_barang, barang.kode_barang, detail_peminjaman.jumlah, detail_peminjaman.keterangan, mk.nama_mk');
		$this->db->join('pengguna','peminjaman.id_pengguna=pengguna.id');
		$this->db->join('dosen','peminjaman.id_dosen=dosen.id');
		$this->db->join('mk','peminjaman.id_mk=mk.id');
		$this->db->join('detail_peminjaman','peminjaman.id=detail_peminjaman.id_peminjaman');
		$this->db->join('barang','detail_peminjaman.id_barang=barang.id');
		$this->db->join('teknisi','peminjaman.id_teknisi=teknisi.id', 'left');
		return $this->db->get($this->_table)->result();
	} 

	public function lihat_join_full_filter($tanggal_awal, $tanggal_akhir){
		$this->db->select('peminjaman.*, teknisi.nama_teknisi, pengguna.nama_pengguna, pengguna.kode_pengguna AS nim, pengguna.username_pengguna, dosen.nama_dosen, barang.nama_barang, barang.kode_barang, detail_peminjaman.jumlah, detail_peminjaman.keterangan, mk.nama_mk');
		$this->db->join('pengguna','peminjaman.id_pengguna=pengguna.id');
		$this->db->join('dosen','peminjaman.id_dosen=dosen.id');
		$this->db->join('mk','peminjaman.id_mk=mk.id');
		$this->db->join('detail_peminjaman','peminjaman.id=detail_peminjaman.id_peminjaman');
		$this->db->join('barang','detail_peminjaman.id_barang=barang.id');
		$this->db->join('teknisi','peminjaman.id_teknisi=teknisi.id', 'left');
		$this->db->where('waktu_pinjam>=', $tanggal_awal.' 00:00:00');
		$this->db->where('waktu_pinjam<=', $tanggal_akhir.' 23:59:00');
		return $this->db->get($this->_table)->result();
	} 

	public function lihat_join_full_filter_all_parameter($tanggal_awal, $tanggal_akhir, $kelas, $semester, $id_dosen, $id_mk, $id_pengguna, $status){
		$this->db->select('peminjaman.*, teknisi.nama_teknisi, pengguna.nama_pengguna, pengguna.kode_pengguna AS nim, pengguna.username_pengguna, dosen.nama_dosen, barang.nama_barang, barang.kode_barang, detail_peminjaman.jumlah, detail_peminjaman.keterangan, mk.nama_mk');
		$this->db->join('pengguna','peminjaman.id_pengguna=pengguna.id');
		$this->db->join('dosen','peminjaman.id_dosen=dosen.id');
		$this->db->join('mk','peminjaman.id_mk=mk.id');
		$this->db->join('detail_peminjaman','peminjaman.id=detail_peminjaman.id_peminjaman');
		$this->db->join('barang','detail_peminjaman.id_barang=barang.id');
		$this->db->join('teknisi','peminjaman.id_teknisi=teknisi.id', 'left');
		if ($tanggal_awal != '') {
			$this->db->where('waktu_pinjam>=', $tanggal_awal.' 00:00:00');
		}
		if ($tanggal_akhir != '') {
			$this->db->where('waktu_pinjam<=', $tanggal_akhir.' 23:59:00');
		}
		if ($kelas != '') {
			$this->db->where('kelas', $kelas);
		}
		if ($semester != '') {
			$this->db->where('semester', $semester);
		}
		if ($id_dosen != '') {
			$this->db->where('dosen.id', $id_dosen);
		}
		if ($id_mk != '') {
			$this->db->where('mk.id', $id_mk);
		}
		if ($id_pengguna != '') {
			$this->db->where('pengguna.id', $id_pengguna);
		}
		if ($status != '') {
			$this->db->where('status', $status);
		}
		return $this->db->get($this->_table)->result();
	}

	public function lihat_join_mahasiswa(){
		$this->db->select('peminjaman.*, teknisi.nama_teknisi, pengguna.nama_pengguna, pengguna.kode_pengguna AS nim, dosen.nama_dosen');
		$this->db->join('pengguna','peminjaman.id_pengguna=pengguna.id');
		$this->db->join('dosen','peminjaman.id_dosen=dosen.id');
		$this->db->join('teknisi','peminjaman.id_teknisi=teknisi.id', 'left');
		$this->db->where('id_pengguna', $this->session->login['id']);
		return $this->db->get($this->_table)->result();
	} 

	public function lihat_join_today_mahasiswa(){
		$this->db->select('peminjaman.*, teknisi.nama_teknisi, pengguna.nama_pengguna, pengguna.kode_pengguna AS nim, dosen.nama_dosen');
		$this->db->join('pengguna','peminjaman.id_pengguna=pengguna.id');
		$this->db->join('dosen','peminjaman.id_dosen=dosen.id');
		$this->db->join('teknisi','peminjaman.id_teknisi=teknisi.id', 'left');
		$this->db->where('waktu_pinjam>=', date('Y-m-d').' 00:00:00');
		$this->db->where('id_pengguna', $this->session->login['id']);
		return $this->db->get($this->_table)->result();
	} 

	public function lihat_join_filter_mahasiswa($tanggal_awal, $tanggal_akhir){
		$this->db->select('peminjaman.*, teknisi.nama_teknisi, pengguna.nama_pengguna, pengguna.kode_pengguna AS nim, dosen.nama_dosen');
		$this->db->join('pengguna','peminjaman.id_pengguna=pengguna.id');
		$this->db->join('dosen','peminjaman.id_dosen=dosen.id');
		$this->db->join('teknisi','peminjaman.id_teknisi=teknisi.id', 'left');
		$this->db->where('waktu_pinjam>=', $tanggal_awal.' 00:00:00');
		$this->db->where('waktu_pinjam<=', $tanggal_akhir.' 23:59:00');
		$this->db->where('id_pengguna', $this->session->login['id']);
		return $this->db->get($this->_table)->result();
	} 

	public function lihat_join_full_mahasiswa(){
		$this->db->select('peminjaman.*, teknisi.nama_teknisi, pengguna.nama_pengguna, pengguna.kode_pengguna AS nim, pengguna.username_pengguna, dosen.nama_dosen, barang.nama_barang, barang.kode_barang, detail_peminjaman.jumlah, detail_peminjaman.keterangan, mk.nama_mk');
		$this->db->join('pengguna','peminjaman.id_pengguna=pengguna.id');
		$this->db->join('dosen','peminjaman.id_dosen=dosen.id');
		$this->db->join('mk','peminjaman.id_mk=mk.id');
		$this->db->join('detail_peminjaman','peminjaman.id=detail_peminjaman.id_peminjaman');
		$this->db->join('barang','detail_peminjaman.id_barang=barang.id');
		$this->db->join('teknisi','peminjaman.id_teknisi=teknisi.id', 'left');
		$this->db->where('id_pengguna', $this->session->login['id']);
		return $this->db->get($this->_table)->result();
	} 

	public function lihat_join_full_filter_mahasiswa($tanggal_awal, $tanggal_akhir){
		$this->db->select('peminjaman.*, teknisi.nama_teknisi, pengguna.nama_pengguna, pengguna.kode_pengguna AS nim, pengguna.username_pengguna, dosen.nama_dosen, barang.nama_barang, barang.kode_barang, detail_peminjaman.jumlah, detail_peminjaman.keterangan, mk.nama_mk');
		$this->db->join('pengguna','peminjaman.id_pengguna=pengguna.id');
		$this->db->join('dosen','peminjaman.id_dosen=dosen.id');
		$this->db->join('mk','peminjaman.id_mk=mk.id');
		$this->db->join('detail_peminjaman','peminjaman.id=detail_peminjaman.id_peminjaman');
		$this->db->join('barang','detail_peminjaman.id_barang=barang.id');
		$this->db->join('teknisi','peminjaman.id_teknisi=teknisi.id', 'left');
		$this->db->where('waktu_pinjam>=', $tanggal_awal.' 00:00:00');
		$this->db->where('waktu_pinjam<=', $tanggal_akhir.' 23:59:00');
		$this->db->where('id_pengguna', $this->session->login['id']);
		return $this->db->get($this->_table)->result();
	}

	public function lihat_join_full_mahasiswa_request_kode($kode_pengguna){
		$this->db->select('peminjaman.*, teknisi.nama_teknisi, pengguna.nama_pengguna, pengguna.kode_pengguna AS nim, pengguna.username_pengguna, dosen.nama_dosen, barang.nama_barang, barang.kode_barang, detail_peminjaman.jumlah, detail_peminjaman.keterangan, mk.nama_mk');
		$this->db->join('pengguna','peminjaman.id_pengguna=pengguna.id');
		$this->db->join('dosen','peminjaman.id_dosen=dosen.id');
		$this->db->join('mk','peminjaman.id_mk=mk.id');
		$this->db->join('detail_peminjaman','peminjaman.id=detail_peminjaman.id_peminjaman');
		$this->db->join('barang','detail_peminjaman.id_barang=barang.id');
		$this->db->join('teknisi','peminjaman.id_teknisi=teknisi.id', 'left');
		$this->db->where('kode_pengguna', $kode_pengguna);
		return $this->db->get($this->_table)->result();
	} 

	public function kelas(){
		$this->db->group_by('kelas'); 
		$this->db->order_by('kelas', 'asc');
		return $this->db->get($this->_table)->result();
	} 

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function jumlah_tanggungan(){
		$this->db->where('status', '3');
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function jumlah_pengajuan(){
		$this->db->where('status', '1');
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function jumlah_diterima(){
		$this->db->where('status', '2');
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function jumlah_mahasiswa(){
		$this->db->where('id_pengguna', $this->session->login['id']);
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function jumlah_tanggungan_mahasiswa(){
		$this->db->where('status', '3');
		$this->db->where('id_pengguna', $this->session->login['id']);
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function jumlah_pengajuan_mahasiswa(){
		$this->db->where('status', '1');
		$this->db->where('id_pengguna', $this->session->login['id']);
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function jumlah_selesai_mahasiswa(){
		$this->db->where('status', '4');
		$this->db->where('id_pengguna', $this->session->login['id']);
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function jumlah_ditolak_mahasiswa(){
		$this->db->where('status', '5');
		$this->db->where('id_pengguna', $this->session->login['id']);
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function jumlah_diterima_mahasiswa(){
		$this->db->where('status', '2');
		$this->db->where('id_pengguna', $this->session->login['id']);
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function cek_jumlah_tanggungan($kode_pengguna){
		$this->db->select('peminjaman.*, teknisi.nama_teknisi, pengguna.nama_pengguna, pengguna.kode_pengguna AS nim, dosen.nama_dosen');
		$this->db->join('pengguna','peminjaman.id_pengguna=pengguna.id');
		$this->db->join('dosen','peminjaman.id_dosen=dosen.id');
		$this->db->join('teknisi','peminjaman.id_teknisi=teknisi.id', 'left');
		$this->db->where('status', '3');
		$this->db->where('pengguna.kode_pengguna', $kode_pengguna);
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function cek_data_tanggungan($kode_pengguna){
		$this->db->select('peminjaman.*, teknisi.nama_teknisi, pengguna.nama_pengguna, pengguna.kode_pengguna AS nim, dosen.nama_dosen');
		$this->db->join('pengguna','peminjaman.id_pengguna=pengguna.id');
		$this->db->join('dosen','peminjaman.id_dosen=dosen.id');
		$this->db->join('teknisi','peminjaman.id_teknisi=teknisi.id', 'left');
		$this->db->where('pengguna.kode_pengguna', $kode_pengguna);
		return $this->db->get($this->_table)->result();
	}

	public function lihat_id($id){
		return $this->db->get_where($this->_table, ['id' => $id])->row();
	}

	public function lihat_id_join($id){
		$this->db->select('peminjaman.*, teknisi.nama_teknisi, pengguna.nama_pengguna, pengguna.kode_pengguna AS nim, pengguna.email_pengguna, pengguna.username_pengguna, dosen.nama_dosen, mk.nama_mk');
		$this->db->join('pengguna','peminjaman.id_pengguna=pengguna.id');
		$this->db->join('dosen','peminjaman.id_dosen=dosen.id');
		$this->db->join('mk','peminjaman.id_mk=mk.id');
		$this->db->join('teknisi','peminjaman.id_teknisi=teknisi.id', 'left');
		return $this->db->get_where($this->_table, ['peminjaman.id' => $id])->row();
	} 

	public function lihat_waktu_diajukan($waktu_diajukan){
		$this->db->select('id');
		$hasil = $this->db->get_where($this->_table, ['waktu_diajukan' => $waktu_diajukan])->row();
		return $hasil->id;
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function ubah($data, $id){
		$query = $this->db->set($data);
		$query = $this->db->where(['id' => $id]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($id){
		return $this->db->delete($this->_table, ['id' => $id]);
	}
}