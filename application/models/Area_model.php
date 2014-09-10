<?php
/**
 * Created by PhpStorm.
 * User: DELL-1
 * Date: 14-9-3
 * Time: 下午8:40
 */
class Area_model extends CI_Model{
    public function __construct() {
        parent::__construct ();
        $this->load->database();
        $this->load->library('session');
    }

    //插入区域信息
    public function area_insert($area_name){
        $this->db->set('area_name',$area_name);
        $this->db->insert('t_bas_area');
    }

    //更新区域信息
    public function area_update($area_name,$area_id){
        $this->db->set('area_name',$area_name);
        $this->db->where('area_id',$area_id);
        $this->db->update('t_bas_area');
    }

    //删除区域信息
    public  function area_delete($area_id){
        $this->db->where('area_id',$area_id);
        $this->db->delete('t_bas_area');
    }

    //区域信息查询
    public function area_query($currentpage,$pagesize){
        if($currentpage==0){
            $currentpage=1;
        }
        $start_index=($currentpage-1)*$pagesize;
        $this->db->select('area_name');
        $this->db->orderby('area_id','desc');
        $this->db->limit($start_index,$pagesize);
        $this->db->get('t_bas_area');
    }

}

?>