<?php

class M_dosen extends CI_Model{
	protected $_table = 'dosen';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function lihat_join_mk(){
		$this->db->select('dosen.*, mk.nama_mk');
		$this->db->join('mk','dosen.id_mk=mk.id');
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_id($id){
		$query = $this->db->get_where($this->_table, ['id' => $id]);
		return $query->row();
	}

	public function lihat_id_join_mk($id){
		$this->db->select('dosen.*, mk.nama_mk');
		$this->db->join('mk','dosen.id_mk=mk.id');
		$query = $this->db->get_where($this->_table, ['dosen.id' => $id]);
		return $query->row();
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