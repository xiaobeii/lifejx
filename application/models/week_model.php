<?php
/**
 * Created by PhpStorm.
 * User: DELL-1
 * Date: 14-9-4
 * Time: 下午8:18
 */
class Week_model extends CI_Model{
    public function __construct() {
        parent::__construct ();
        $this->load->database();
        $this->load->library('session');
    }

    //掺入星期信息
    public function week_insert($week_name){
        $this->db->set('week_name',$week_name);
        $this->db->insert('t_bsa_week');
    }

    //更新星期信息
    public function week_update($week_name,$week_id){
        $this->db->set('week_name',$week_name);
        $this->db->where('week_id',$week_id);
        $this->db->update('t_bas_week');
    }

    //删除星期信息
    public function week_delete($week_id){
        $this->db->where('week_id',$week_id);
        $this->db->delete('t_bas_week');
    }

    //查询星期信息
    public function week_query($currentpage,$pagesize){
        if($currentpage==0){
            $currentpage=1;
        }
        $start_index=($currentpage-1)*$pagesize;
        $this->db->select('week_name');
        $this->db->orderby('week_id','desc');
        $this->db->limit($start_index,$pagesize);
        $this->db->get('t_bas_week');
    }
}
?>