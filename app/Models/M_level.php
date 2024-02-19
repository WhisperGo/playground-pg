<?php

namespace App\Models;
use CodeIgniter\Model;

class M_level extends Model
{		
	protected $table      = 'level';
	protected $primaryKey = 'id_level';
	protected $allowedFields = ['nama_level'];
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

	//CI4 Model
    public function insertt($data)
    {
        return $this->insert($data);
    }
    
    public function deletee($id)
    {
    	return $this->delete($id);
    }
}