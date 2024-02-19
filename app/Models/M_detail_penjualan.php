<?php

namespace App\Models;
use CodeIgniter\Model;

class M_detail_penjualan extends Model
{		
	protected $table      = 'detailpenjualan';
	protected $primaryKey = 'DetailID';
	protected $allowedFields = ['PenjualanID', 'ProdukID', 'JumlahProduk', 'Subtotal'];
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
		->get()
		->getResult();
	}

	public function join3id($table1, $table2, $table3, $on, $on2, $id)
	{
		return $this->db->table($table1)
		->join($table2, $on, 'left')
		->join($table3, $on2, 'left')
		->where("$table1.deleted_at", null)
		->where("$table2.deleted_at", null)
		// ->where("$table3.deleted_at", null)
		->where('penjualan.PenjualanID', $id)
		->get()
		->getResult();
	}
	public function hitungSemuaBulanIni()
{
    $bulanIni = date('Y-m-01'); // Mengambil tanggal awal bulan ini
    $bulanDepan = date('Y-m-01', strtotime('+1 month')); // Mengambil tanggal awal bulan depan

    return $this->where('deleted_at', null)
                ->where('created_at >=', $bulanIni)
                ->where('created_at <', $bulanDepan)
                ->countAllResults();
}


	//CI4 Model
	public function deletee($id)
	{
		return $this->delete($id);
	}
}