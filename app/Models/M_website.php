<?php

namespace App\Models;
use CodeIgniter\Model;

class M_website extends Model
{		
	protected $table      = 'website';
	protected $primaryKey = 'id_website';
	protected $allowedFields = ['nama_website', 'logo_website', 'logo_pdf', 'favicon_website', 'komplek', 'jalan', 'kelurahan', 'kecamatan', 'kota', 'kode_pos'];
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
		->where('website.deleted_at', null)
		->get()
		->getResult();
	}

	//CI4 Model
	public function deletee($id)
	{
		return $this->delete($id);
	}
}