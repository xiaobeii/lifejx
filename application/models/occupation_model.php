<?php
/**
 * Created by PhpStorm.
 * User: DELL-1
 * Date: 14-9-4
 * Time: 下午7:38
 */
class Occupation_model extends CI_Model{
    public function __construct() {
        parent::__construct ();
        $this->load->database();
        $this->load->library('session');
    }

    //插入职业数据
    public function  occupation_insert($occupation_name){
        $this->db->set('occupation_name',$occupation_name);
        $this->db->insert('t_bas_occupation');
    }

    //更新职业数据
    public function occupation_update($occupation_name,$occupation_id){
        $this->db->set('$occupation_name',$occupation_name);
        $this->db->where('$occupation_id',$occupation_id);
        $this->db->update("t_bas_occupation");
    }

    //删除职业信息
    public function occupation_delete($occupation_id){
        $this->db->where('occupation_id',$occupation_id);
        $this->db->delete('t_bas_occupation');
    }

    //查询职业信息
    public function occupation_query($currentpage,$pagesize){
        if($currentpage==0){
            $currentpage=1;
        }
        $start_index=($currentpage-1)*$pagesize;
        $this->db->select('occupation_name');
        $this->db->orderby("occupation_id",'desc');
        $this->db->limit($start_index,$pagesize);
        $this->db->get('t_bas_occupation');
    }
}
?>