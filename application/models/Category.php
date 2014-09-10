<?php
/**
 * Created by PhpStorm.
 * User: DELL-1
 * Date: 14-9-3
 * Time: 下午9:00
 */
class Category_model extends CI_Model{
    public function __construct() {
        parent::__construct ();
        $this->load->database();
        $this->load->library('session');
    }

    //插入大类信息
    public function ctg_insert($ctg_name){
        $this->db->set('ctg_name',$ctg_name);
        $this->db->insert('t_bas_category');
    }

    //更新大类信息
    public function ctg_update($ctg_id,$ctg_name){
        $this->db->set('ctg_name',$ctg_name);
        $this->db->where('ctg_id',$ctg_id);
        $this->db->update('t_bas_category');
    }

    //删除大类信息
    public function ctg_delete($ctg_id){
        $this->db->where('ctg_id',$ctg_id);
        $this->db->delete('t_bas_category');
    }

    //查询大类信息
    public function ctg_query($currentpage,$pagesize){
        if($currentpage==0){
            $currentpage=1;
        }
        $start_index=($currentpage-1)*$pagesize;
        $this->db->select('ctg_name');
        $this->db->orderby('ctg_id','desc');
        $this->db->limit($start_index,$pagesize);
        $this->db->get('t_bas_category');
    }

}
?>