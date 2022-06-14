<?php

class M_detail_peminjaman extends CI_Model {
	protected $_table = 'detail_peminjaman';

	public function tambah($data){
		return $this->db->insert_batch($this->_table, $data);
	}

	public function lihat_id_peminjaman($id_peminjaman){
		return $this->db->get_where($this->_table, ['id_peminjaman' => $id_peminjaman])->result();
	}

	public function lihat_id_peminjaman_join($id_peminjaman){
		$this->db->join('barang','detail_peminjaman.id_barang=barang.id');
		return $this->db->get_where($this->_table, ['id_peminjaman' => $id_peminjaman])->result();
	}

	public function lihat_id_peminjaman_join_tanggungan($id_peminjaman){
		$this->db->select('detail_peminjaman.*');
		$this->db->join('barang','detail_peminjaman.id_barang=barang.id');
		return $this->db->get_where($this->_table, ['id_peminjaman' => $id_peminjaman])->result();
	}

	public function ubah($data, $id){
		$query = $this->db->set($data);
		$query = $this->db->where(['id' => $id]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($id_peminjaman){
		return $this->db->delete($this->_table, ['id_peminjaman' => $id_peminjaman]);
	}
}