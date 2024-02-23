<?php

namespace App\Models;
use CodeIgniter\Model;

class M_transaksi extends Model
{		
	protected $table      = 'transaksi';
	protected $primaryKey = 'id_transaksi';
	protected $allowedFields = ['pelanggan_id', 'tanggal_transaksi', 'total_harga', 'user'];
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
		->orderBy('transaksi.created_at', 'DESC')
		->get()
		->getResult();
	}

	public function join2aktivitas($table1, $table2, $on)
	{
		return $this->db->table($table1)
		->join($table2, $on, 'left')
		->orderBy('transaksi.created_at', 'DESC')
		->get()
		->getResult();
	}

	public function join3aktivitas($table1, $table2, $table3, $on, $on2)
	{
		return $this->db->table($table1)
		->join($table2, $on, 'left')
		->join($table3, $on2, 'left')
		->orderBy('transaksi.created_at', 'DESC')
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

	public function join3id($table1, $table2, $table3, $on, $on2, $id)
	{
		return $this->db->table($table1)
		->join($table2, $on, 'left')
		->join($table3, $on2, 'left')
		->where("$table1.deleted_at", null)
		->where("$table2.deleted_at", null)
		->where("$table3.deleted_at", null)
		->where('transaksi.id_transaksi', $id)
		->get()
		->getResult();
	}


	public function hitungSemuaHariIni()
	{
	    $hariIni = date('Y-m-d'); // Mengambil tanggal hari ini
	    $besok = date('Y-m-d', strtotime('+1 day')); // Mengambil tanggal besok

	    return $this->where('deleted_at', null)
	    ->where('created_at >=', $hariIni)
	    ->where('created_at <', $besok)
	    ->countAllResults();
	}

	// --------------------------------------- REFRESH OTOMATIS --------------------------------------

	public function getWaktuTerakhir()
    {
        return $this->db->table('transaksi')->selectMax('created_at')->get()->getRow()->created_at;
    }

	public function hitungDataBaruSejakPermintaanSebelumnya($timestamp_terakhir)
	{
    // Lakukan penghitungan jumlah data baru berdasarkan timestamp terakhir
		return $this->db->table('transaksi')
		->where('deleted_at', null)
		->where('created_at >', $timestamp_terakhir)
		->countAllResults();
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