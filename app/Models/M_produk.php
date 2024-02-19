<?php

namespace App\Models;
use CodeIgniter\Model;

class M_produk extends Model
{		
	protected $table      = 'produk';
	protected $primaryKey = 'ProdukID';
	protected $allowedFields = ['NamaProduk', 'Harga', 'Stok'];
	protected $useSoftDeletes = true;
	protected $useTimestamps = true;

	public function tampil($table1)	
	{
		return $this->db->table($table1)->where('deleted_at', null)->get()->getResult();
	}
	public function tampilProduk($table1)	
	{
		return $this->db->table($table1)
		->where('deleted_at', null)
        ->where('Stok >', 0) // Memastikan stok minimal 1
        ->get()
        ->getResult();
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
        ->where("buku.kategori_buku !=", 10) // Menambahkan kondisi kategori_buku != 10
        ->get()
        ->getResult();
    }
    public function join2digital($table1, $table2, $on)
    {
    	return $this->db->table($table1)
    	->join($table2, $on, 'left')
    	->where("$table1.deleted_at", null)
    	->where("$table2.deleted_at", null)
        ->where("buku.kategori_buku =", 10) // Menambahkan kondisi kategori_buku != 10
        ->get()
        ->getResult();
    }
    public function hitungsemua()
    {
    	return $this->where('deleted_at', null)->countAllResults();
    }

    // ----------------------------------- STOK PRODUK MASUK -------------------------------------

    public function getProdukMasukById($id)
    {
    	return $this->db->table('produk_masuk')
    	->select('produk_masuk.*, produk.*, user.*' )
    	->select('produk_masuk.created_at AS created_at_produk_masuk')  
    	->join('produk', 'produk.ProdukID = produk_masuk.ProdukID')
    	->join('user', 'user.id_user = produk_masuk.user')
    	->where('produk.ProdukID', $id)
    	->orderBy('produk_masuk.created_at', 'DESC')
    	->get()
    	->getResult();
    }


    public function getProdukMasukByIdProdukMasuk($id)
    {
    	$query = $this->db->table('produk_masuk')
    	->where('ProdukMasukID', $id)
    	->get();
    	return $query->getRow();
    }

	// ------------------------------------- KASIR ---------------------------------------------
    

	//CI4 Model
    public function deletee($id)
    {
    	return $this->delete($id);
    }
}