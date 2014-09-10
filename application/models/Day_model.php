<?php
/**
 * Created by PhpStorm.
 * User: DELL-1
 * Date: 14-9-4
 * Time: 下午8:27
 */
class Day_model extends CI_Model{
    public function __construct() {
        parent::__construct ();
        $this->load->database();
        $this->load->library('session');
    }

    //插入日期信息
    public function day_insert($day_detail){
        $this->db->set('day_detail',$day_detail);
        $this->db->insert('t_day_arrange');
    }

    //更新日期信息
    public function day_update($day_detail,$day_id){
        $this->db->set('day_detail',$day_detail);
        $this->db->where('day_id',$day_id);
        $this->db->update('t_day_arrange');
    }

    //删除日期信息
    public function day_delete($day_id){
        $this->db->where('day_id',$day_id);
        $this->db->delete('t_day_arrange');
    }

    //查询日期信息
    public function day_query($currentpage,$pagesize){
        if($currentpage==0){
            $currentpage=1;
        }
        $start_index=($currentpage-1)*$pagesize;
        $this->db->select('day_detail');
        $this->db->orderby('day_id','desc');
        $this->db->limit($start_index,$pagesize);
        $this->db->get('t_day_arrange');
    }

}
?>