<?php

namespace App\Models;
use CodeIgniter\Model;

class M_penjualan extends Model
{		
	protected $table      = 'penjualan';
	protected $primaryKey = 'PenjualanID';
	protected $allowedFields = ['TanggalPenjualan', 'TotalHarga', 'PelangganID'];
	protected $useSoftDeletes = true;
	protected $useTimestamps = true;

	public function tampil($table1)	
	{
		return $this->db->table($table1)->where('deleted_at', null)->get()->getResult();
	}
	public function hapus($table, $where)
	{
		return $this->db->table($table)->delete($where);
	}
	public function simpan($table, $data)
	{
		return $this->db->table($table)->insert($data);
	}
	public function qedit($table, $data, $where)
	{
		return $this->db->table($table)->update($data, $where);
	}
	public function getWhere($table, $where)
	{
		return $this->db->table($table)->getWhere($where)->getRow();
	}
	public function getWhere2($table, $where)
	{
		return $this->db->table($table)->getWhere($where)->getRowArray();
	}
	public function join2($table1, $table2, $on)
	{
		return $this->db->table($table1)
		->join($table2, $on, 'left')
		->where("$table1.deleted_at", null)
		->where("$table2.deleted_at", null)
		->where("buku.kategori_buku !=", 10)
		->orderBy('produk_masuk.created_at', 'DESC')
		->get()
		->getResult();
	}

	public function join3($table1, $table2, $table3, $on, $on2)
	{
		return $this->db->table($table1)
		->join($table2, $on, 'left')
		->join($table3, $on2, 'left')
		->where("$table1.deleted_at", null)
		->where("$table2.deleted_at", null)
		->where("$table3.deleted_at", null)
		->orderBy('penjualan.created_at', 'DESC')
		->get()
		->getResult();
	}

	// ---------------------------------------- PRINT LAPORAN ----------------------------------------

	public function getAllPenjualanPeriode($tanggal_awal, $tanggal_akhir)
	{
		return $this->db->table('detailpenjualan')
		->select('detailpenjualan.*, penjualan.*, produk.*, user.*') 
    	->select('detailpenjualan.created_at AS created_at_detailpenjualan')
		->join('penjualan', 'detailpenjualan.PenjualanID = penjualan.PenjualanID')
		->join('produk', 'detailpenjualan.ProdukID = produk.ProdukID')
		->join('user', 'penjualan.user = user.id_user')
		->where('detailpenjualan.created_at >=', $tanggal_awal)
		->where('detailpenjualan.created_at <=', $tanggal_akhir)
		->where('detailpenjualan.deleted_at', null)
		->orderBy('detailpenjualan.created_at', 'DESC')
		->get()
		->getResult();
	}

	public function getAllPenjualanPerHari($tanggal)
	{
		return $this->db->table('detailpenjualan')
		->select('detailpenjualan.*, penjualan.*, produk.*, user.*')
		->select('detailpenjualan.created_at AS created_at_detailpenjualan') 
		->join('penjualan', 'detailpenjualan.PenjualanID = penjualan.PenjualanID')
		->join('produk', 'detailpenjualan.ProdukID = produk.ProdukID')
		->join('user', 'penjualan.user = user.id_user')
		->where('DATE(detailpenjualan.created_at)', $tanggal)
		->where('detailpenjualan.deleted_at', null)
		->orderBy('detailpenjualan.created_at', 'DESC')
		->get()
		->getResult();
	}



	//CI4 Model
	public function deletee($id)
	{
		return $this->delete($id);
	}
}